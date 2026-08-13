import { Tooltip, Toast } from "bootstrap";

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

// Initialise le tooltip survolé/cliqué
document.addEventListener("mouseover", initializeTooltip);
document.addEventListener("focusin", initializeTooltip);

// Initialise les Toasts
document.addEventListener("DOMContentLoaded", initializeToasts);
