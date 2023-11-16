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
document.addEventListener("DOMContentLoaded", function () {
    const galleryImages = document.querySelectorAll('.gallery-container img');
    let currentImageIndex = 0;

    function showNextImage() {
        galleryImages[currentImageIndex].classList.remove('visible');
        galleryImages[currentImageIndex].classList.add('invisible');

        currentImageIndex = (currentImageIndex + 1) % galleryImages.length;

        galleryImages[currentImageIndex].classList.remove('invisible');
        galleryImages[currentImageIndex].classList.add('visible');
    }

    // cela change l'image toutes les 10 sec
    setInterval(showNextImage, 10000);

});
console.log('chat');