// resources/js/notyf.js
import { Notyf } from "notyf";

const initNotyf = () => {
    const notyf = new Notyf({
        duration: 3000,
        position: {
            x: "center",
            y: "top",
        },
        types: [
            {
                type: "primary",
                background: "#7367F0",
                color: "white",
                ripple: true,
                dismissible: true,
            },
            {
                type: "warning",
                background: "#f58d38",
                color: "white",
                ripple: true,
                dismissible: true,
            },
            {
                type: "error",
                background: "#ff4444",
                color: "white",
                ripple: true,
                dismissible: true,
            },
        ],
    });

    const flash = {
        success: document.body.dataset.success || "",
        error: document.body.dataset.error || "",
    };

    if (flash.success && flash.success.length > 0) {
        notyf.open({
            type: "primary",
            message: flash.success,
        });
    }

    if (flash.error && flash.error.length > 0) {
        notyf.open({
            type: "error", // Змінюємо на "error" для помилок
            message: flash.error,
        });
    }
};

document.addEventListener("DOMContentLoaded", initNotyf);

export default initNotyf;