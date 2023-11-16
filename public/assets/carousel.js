
// carousel avec timeur pour les changements plus les clicks
const galleryImages = document.querySelectorAll('.gallery-container img');
let currentImageIndex = 0;
let interval;


const showNextImage = function () {

    galleryImages[currentImageIndex].classList.remove('visible');
    galleryImages[currentImageIndex].classList.add('invisible');

    currentImageIndex = (currentImageIndex + 1) % galleryImages.length;

    galleryImages[currentImageIndex].classList.remove('invisible');
    galleryImages[currentImageIndex].classList.add('visible');

    timingGallery();
}



const showPreviousImage = () => {

    galleryImages[currentImageIndex].classList.remove('visible');
    galleryImages[currentImageIndex].classList.add('invisible');

    currentImageIndex = (currentImageIndex - 1 + galleryImages.length) % galleryImages.length;

    galleryImages[currentImageIndex].classList.remove('invisible');
    galleryImages[currentImageIndex].classList.add('visible');

    timingGallery();
}

const timingGallery = () => {

    clearInterval(interval);
    interval = setInterval(showNextImage, 7000);

}

document.addEventListener("DOMContentLoaded", timingGallery);

