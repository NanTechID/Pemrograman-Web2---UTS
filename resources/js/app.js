import './bootstrap';

import Alpine from 'alpinejs';

const root = document.documentElement;
root.classList.remove('dark');
root.setAttribute('data-theme', 'modern');

window.Alpine = Alpine;

Alpine.start();
