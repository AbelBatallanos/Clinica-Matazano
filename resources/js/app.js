import {initCitaEvent} from "./events/citaevents.js";

import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


document.addEventListener("DOMContentLoaded", () => {
  initCitaEvent();
});