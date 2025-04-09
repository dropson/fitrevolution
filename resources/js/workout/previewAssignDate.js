import { HSOverlay } from "flyonui/flyonui";

function showPreview(id, title) {
    const modalElement = document.querySelector("#preview-assign-date-modal");
    if (!modalElement) {
        console.error("Modal element #preview-assign-date-modal not found");
        return;
    }

    const modal = new HSOverlay(modalElement, {
        closeOnOverlayClick: false,
    });

    modal.on("open", () => {
        const workoutTitle = document.querySelector("#workout_title");
        const workoutId = document.querySelector("#workout_id");

        workoutTitle.textContent = title;
        workoutId.value = id;
    });

    modal.open();

    modalElement.addEventListener("click", (event) => {
        if (event.target === modalElement) {
            event.stopPropagation();
            event.preventDefault();
        }
    });

    const closeButton = modalElement.querySelector(
        ".preview-assign-date-modal-close"
    );
    closeButton.addEventListener("click", () => {
        modal.close();
    });

    modal.on("close", () => {
        const workoutTitle = document.querySelector("#workout-title");
        const workoutId = document.querySelector("#workout_id");
        workoutTitle.textContent = "";
        workoutId.value = "";
    });
}

document.addEventListener("DOMContentLoaded", () => {
    const buttons = document.querySelectorAll(".preview-assign-date");

    buttons.forEach((button) => {
        button.addEventListener("click", function () {
            const workoutId = this.getAttribute("data-id");
            const workoutTitle = this.getAttribute("data-title");
            showPreview(workoutId, workoutTitle);
        });
    });
});
