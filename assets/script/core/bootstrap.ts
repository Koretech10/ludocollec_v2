import { Tooltip, Toast, Modal } from "bootstrap";

function initializeTooltip(event: Event) {
    const eventTarget = event.target;

    if (!(eventTarget instanceof HTMLElement)) {
        return;
    }

    const target = eventTarget.closest('[data-bs-toggle="tooltip"]');

    if (null !== target && !Tooltip.getInstance(target)) {
        const tooltip = new Tooltip(target);
        tooltip.show();
    }
}

function initializeToasts() {
    const toastElements = document.querySelectorAll(".toast");

    [...toastElements].forEach((toastElement) => {
        const toast = new Toast(toastElement);
        toast.show();
    });
}

function closeModal(event: Event) {
    if (!(event instanceof CustomEvent)) {
        return;
    }

    const modalElement = document.getElementById(event.detail.id);

    if (null === modalElement) {
        return;
    }

    const modal = Modal.getInstance(modalElement);

    if (null === modal) {
        return;
    }

    modal.hide();
}

// Initialise le tooltip survolé/cliqué
document.addEventListener("mouseover", initializeTooltip);
document.addEventListener("focusin", initializeTooltip);

// Initialise les Toasts
document.addEventListener("DOMContentLoaded", initializeToasts);

// Ferme la modal lorsqu'un Live Component émet l'événement `modal:close`
document.addEventListener("modal:close", closeModal);
