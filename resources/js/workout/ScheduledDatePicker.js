import flatpickr from "flatpickr";

window.addEventListener("load", function () {
    // Basic
    flatpickr("#scheduled_date", {
        monthSelectorType: "static",
        minDate: "today",
        altInput: true,
        altFormat: "l, j F",
    });
});

