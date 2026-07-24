import "./style/main.scss";
import { Tooltip } from "bootstrap";

function initializeTooltip(event) {
    const target = event.target.closest('[data-bs-toggle="tooltip"]');

    if (target && !Tooltip.getInstance(target)) {
        const tooltip = new Tooltip(target);
        tooltip.show();
    }
}

// Initialise le tooltip survolé/cliqué
document.addEventListener("mouseover", initializeTooltip);
document.addEventListener("focusin", initializeTooltip);
