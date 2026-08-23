import { startStimulusApp } from "vite-plugin-symfony/stimulus/helpers";

// Va charger tous les contrôleurs Stimulus dans le fichier controllers.json
// @see https://symfony-vite.pentatrion.com/stimulus/reference.html#startstimulusapp
export const app = startStimulusApp();
