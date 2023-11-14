/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.sass';

import { Tooltip, Toast, Popover } from 'bootstrap';
// start the Stimulus application
import './bootstrap';

// galerie sur l'index qui fait défiler les images
document.addEventListener('DOMContentLoaded', function () {
    const galleryContainer = document.querySelector('.gallery-container');

    function rotateGallery() {
        const firstImage = galleryContainer.firstElementChild;
        galleryContainer.style.transition = 'transform 0.5s ease-in-out';
        galleryContainer.style.transform = 'translateX(-' + firstImage.clientWidth + 'px)';
        setTimeout(() => {
            galleryContainer.appendChild(firstImage);
            galleryContainer.style.transition = 'none';
            galleryContainer.style.transform = 'translateX(0)';
        }, 500);
    }

    setInterval(rotateGallery, 3000);
});