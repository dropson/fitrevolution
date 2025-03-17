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
        ],
    });

    const flash = {
        success: document.body.dataset.success || "",
    };

    if (flash.success && flash.success.length > 0) {
        notyf.open({
            type: "primary",
            message: flash.success,
        });
    }
};

document.addEventListener("DOMContentLoaded", initNotyf);

export default initNotyf;