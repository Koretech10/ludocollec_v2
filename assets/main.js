import "./style/main.scss";
import { Tooltip, Toast } from "bootstrap";

function initializeTooltip(event) {
    const target = event.target.closest('[data-bs-toggle="tooltip"]');

    if (target && !Tooltip.getInstance(target)) {
        const tooltip = new Tooltip(target);
        tooltip.show();
    }
}

function initializeFlashToasts() {
    const flashToastElements = document.querySelectorAll(".toast-flash");

    [...flashToastElements].map((flashToastElement) => {
        const flashToast = new Toast(flashToastElement);
        flashToast.show();
    });
}

// Initialise le tooltip survolé/cliqué
document.addEventListener("mouseover", initializeTooltip);
document.addEventListener("focusin", initializeTooltip);

// Initialise les Toast des Flash
document.addEventListener("DOMContentLoaded", initializeFlashToasts);
