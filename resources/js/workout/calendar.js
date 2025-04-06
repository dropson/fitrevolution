import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';
import interactionPlugin from '@fullcalendar/interaction';


document.addEventListener("DOMContentLoaded", () => {


    const calendarContainer = document.querySelector(`#${'calendar-container'}`);
    if (!calendarContainer) {
        console.error(`Container with ID ${containerId} not found.`);
        return;
    }

    const calendar = new Calendar(calendarContainer, {
        plugins: [
            dayGridPlugin,
            timeGridPlugin,
            listPlugin,
            interactionPlugin
        ],
        initialView: 'dayGridMonth', // Початковий вигляд: місяць
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: '' // Прибираємо стандартні кнопки, бо будемо використовувати власне меню
        },
        events: function (fetchInfo, successCallback) {
            fetch('/api/calendar/events')
                .then(response => response.json())
                .then(data => successCallback(data));
        },
        selectable: true, // Дозволяємо виділяти дати
        dateClick: function (info) {
            alert('Ви вибрали дату: ' + info.dateStr);
        },
        
    });

    calendar.render();


});

