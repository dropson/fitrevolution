import { HSOverlay } from "flyonui/flyonui";

function showPreview(name, token, id) {
    const modalElement = document.querySelector("#preview-invite-client-modal");
    if (!modalElement) {
        console.error("Modal element #preview-invite-client-modal not found");
        return;
    }

    const modal = new HSOverlay(modalElement, {
        closeOnOverlayClick: false,
    });

    modal.on("open", () => {
        const clientInvite = document.querySelector("#client_token");
        const clientName = document.querySelector("#client_name");
        const clientId = document.querySelector("#client_id");
        clientInvite.textContent = token;
        clientName.textContent = name;
        clientId.value = id;
    });

    modal.open();

    modalElement.addEventListener("click", (event) => {
        if (event.target === modalElement) {
            event.stopPropagation();
            event.preventDefault();
        }
    });

    const closeButton = modalElement.querySelector(
        ".preview-invite-client-close"
    );
    closeButton.addEventListener("click", () => {
        modal.close();
    });

    modal.on("close", () => {
        const clientInvite = document.querySelector("#client_token");
        const clientName = document.querySelector("#client_name");
        const clientId = document.querySelector("#client_id");
        clientInvite.textContent = "";
        clientId.value = "";
        clientName.textContent = "";
    });
}

document.addEventListener("DOMContentLoaded", () => {
    const buttons = document.querySelectorAll(".preview-invite-client");

    buttons.forEach((button) => {
        button.addEventListener("click", function () {
            const clientName = this.getAttribute("data-name");
            const clientInvite = this.getAttribute("data-invite");
            const clientIid = this.getAttribute("data-client-id");
            showPreview(clientName, clientInvite,  clientIid);
        });
    });
});
