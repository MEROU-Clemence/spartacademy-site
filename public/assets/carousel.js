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
    setInterval(showNextImage, 5000);

});