// resources/js/calendar.js
import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import listPlugin from "@fullcalendar/list";
import interactionPlugin from "@fullcalendar/interaction";
import { Notyf } from "notyf";
import "notyf/notyf.min.css";

document.addEventListener("DOMContentLoaded", () => {
    const calendarContainer = document.querySelector("#calendar-container");
    if (!calendarContainer) {
        return;
    }

    const notyf = new Notyf({
        duration: 3000,
        position: { x: "center", y: "top" },
        types: [
            { type: "primary", background: "#7367f0", color: "white", ripple: true, dismissible: true },
            { type: "warning", background: "#f58d38", color: "white", ripple: true, dismissible: true },
        ],
    });

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute("content");
    if (!csrfToken) {
        console.error("CSRF token not found");
        return;
    }

    let eventsData = [];

    const createDropdownMenu = (event, calendar) => {
        const dropdownContainer = document.createElement("div");
        dropdownContainer.className = "dropdown relative inline-flex";

        const dropdownButton = document.createElement("button");
        dropdownButton.id = `dropdown-${event.id}`;
        dropdownButton.type = "button";
        dropdownButton.className = "btn p-1";
        dropdownButton.setAttribute("aria-haspopup", "menu");
        dropdownButton.setAttribute("aria-expanded", "false");
        dropdownButton.setAttribute("aria-label", "Dropdown");
        dropdownButton.innerHTML = `<span class="icon-[tabler--line-dotted]"></span>`;
        dropdownContainer.appendChild(dropdownButton);

        const dropdownMenu = document.createElement("ul");
        dropdownMenu.className = "dropdown-menu dropdown-open:opacity-100 hidden min-w-40";
        dropdownMenu.setAttribute("role", "menu");
        dropdownMenu.setAttribute("aria-orientation", "vertical");
        dropdownMenu.setAttribute("aria-labelledby", `dropdown-${event.id}`);

        const editItem = document.createElement("li");
        const editLink = document.createElement("a");
        editLink.className = "dropdown-item flex items-center gap-2";
        editLink.setAttribute("href", `/fit/workouts/${event.extendedProps.workout_id}`);
        editLink.innerHTML = `<span class="text-blue-500">✎</span> Edit`;
        editItem.appendChild(editLink);
        dropdownMenu.appendChild(editItem);

        const deleteItem = document.createElement("li");
        const deleteButton = document.createElement("button");
        deleteButton.className = "dropdown-item flex items-center gap-2 w-full text-left";
        deleteButton.setAttribute("data-schedule-id", event.id);
        deleteButton.innerHTML = `<span class="text-red-500">🗑️</span> Delete`;
        deleteButton.addEventListener("click", () => {
            if (confirm("Are you sure you want to delete this workout?")) {
                fetch(`/fit/schedule/${event.id}`, {
                    method: "DELETE",
                    headers: {
                        "Content-Type": "application/json",
                        Accept: "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                    },
                })
                    .then((response) => {
                        if (!response.ok) throw new Error("Failed to delete workout");
                        return response.json();
                    })
                    .then((result) => {
                        notyf.open({ type: "primary", message: result.message });
                        calendar.refetchEvents();
                        eventsData = eventsData.filter((e) => e.id !== event.id);
                    })
                    .catch((error) => {
                        notyf.open({ type: "warning", message: "Error deleting workout" });
                        console.error("Error deleting schedule:", error);
                    });
            }
        });
        deleteItem.appendChild(deleteButton);
        dropdownMenu.appendChild(deleteItem);

        const today = new Date().toISOString().split("T")[0];
        const eventDate = event.start.toISOString().split("T")[0];
        const status = event.extendedProps.status;

        if (eventDate <= today) {
            const createStatusAction = (action, label, iconClass, newStatus) => {
                const item = document.createElement("li");
                const button = document.createElement("button");
                button.className = "dropdown-item flex items-center gap-2 w-full text-left";
                button.setAttribute("data-schedule-id", event.id);
                button.innerHTML = `<span class="${iconClass}">${label === "Mark Done" ? "✓" : "✗"}</span> ${label}`;
                button.addEventListener("click", () => {
                    fetch(`/fit/schedule/${event.id}/${action}`, {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            Accept: "application/json",
                            "X-CSRF-TOKEN": csrfToken,
                        },
                    })
                        .then((response) => {
                            if (!response.ok) throw new Error(`Failed to ${action} workout`);
                            return response.json();
                        })
                        .then((result) => {
                            notyf.open({ type: "primary", message: result.message });
                            calendar.refetchEvents();
                            const eventIndex = eventsData.findIndex((e) => e.id === event.id);
                            if (eventIndex !== -1) {
                                eventsData[eventIndex].extendedProps.status = newStatus;
                            }
                        })
                        .catch((error) => {
                            notyf.open({ type: "warning", message: `Error ${action} workout` });
                            console.error(`Error ${action} schedule:`, error);
                        });
                });
                item.appendChild(button);
                return item;
            };

            if (status !== "Done") {
                dropdownMenu.appendChild(
                    createStatusAction("complete", "Mark Done", "text-green-500", "Done")
                );
            }

            if (status !== "Skipped") {
                dropdownMenu.appendChild(
                    createStatusAction("skip", "Mark Skipped", "text-red-500", "Skipped")
                );
            }
        }

        dropdownContainer.appendChild(dropdownMenu);
        return dropdownContainer;
    };

    const calendar = new Calendar(calendarContainer, {
        plugins: [dayGridPlugin, timeGridPlugin, listPlugin, interactionPlugin],
        initialView: "dayGridMonth",
        headerToolbar: {
            left: "prev,next today",
            center: "title",
            right: "",
        },
        eventSources: [
            {
                url: "/fit/calendar/events",
                method: "GET",
                success: (data) => {
                    eventsData = Array.isArray(data) ? data : [];
                },
                failure: (error) => {
                    console.error("Error fetching events:", error);
                    eventsData = [];
                },
            },
        ],
        loading: (isLoading) => {
            if (!isLoading) {
                calendar.render();
            }
        },
        eventContent: (info) => {
            const eventContainer = document.createElement("div");
            eventContainer.className = "workout-event flex justify-between items-center";

            const eventTitle = document.createElement("span");
            eventTitle.textContent = info.event.title;
            eventContainer.appendChild(eventTitle);

            const status = info.event.extendedProps.status;
            if (status === "Done") {
                eventContainer.classList.add("done");
            } else if (status === "Skipped") {
                eventContainer.classList.add("skipped");
            }

            const dropdown = createDropdownMenu(info.event, calendar);
            eventContainer.appendChild(dropdown);

            return { domNodes: [eventContainer] };
        },
        // Додаємо eventDidMount для ініціалізації dropdown
        eventDidMount: (info) => {
            const dropdown = info.el.querySelector('.dropdown');
            if (dropdown) {
                // Ініціалізація dropdown (залежить від бібліотеки)
                // Наприклад, якщо використовується Headless UI або Alpine.js, ініціалізуй тут
                // Якщо це Tailwind CSS із кастомним JS, виклич функцію ініціалізації
                if (typeof initDropdown === 'function') {
                    initDropdown(dropdown);
                }
            }
        },
    });

    calendar.render();
});