import "./style/main.scss";
import { Tooltip, Toast } from "bootstrap";

function initializeTooltip(event) {
    const target = event.target.closest('[data-bs-toggle="tooltip"]');

    if (target && !Tooltip.getInstance(target)) {
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
