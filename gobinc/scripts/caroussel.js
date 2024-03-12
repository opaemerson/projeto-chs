const prevButton = document.querySelector('.prev-button');
const nextButton = document.querySelector('.next-button');
const gallery = document.querySelector('.gallery');

let currentIndex = 0;
const images = document.querySelectorAll('.image-x');
const maxIndex = images.length - 1;

function moveGallery(direction) {
    const galleryWidth = gallery.offsetWidth;
    const imageWidth = images[0].offsetWidth;

    if (direction === 'next') {
        currentIndex = (currentIndex < maxIndex) ? currentIndex + 1 : 0;
    } else if (direction === 'prev') {
        currentIndex = (currentIndex > 0) ? currentIndex - 1 : maxIndex;
    }

    images.forEach((image, index) => {
        if (index === currentIndex) {
            image.classList.add('selected');
            image.style.opacity = 1; // Tornar a imagem selecionada totalmente visível
        } else {
            image.classList.remove('selected');
            image.style.opacity = 0.5; // Reduzir a opacidade das outras imagens
        }
    });

    const displacement = -currentIndex * imageWidth;
    gallery.style.transform = `translateX(${displacement}px)`;

    updateButtonVisibility();
}

function updateButtonVisibility() {
    if (maxIndex <= 0) {
        prevButton.style.display = 'none';
        nextButton.style.display = 'none'; // Esconder também o botão "next" se houver apenas um item
    } else {
        prevButton.style.display = 'block';
        nextButton.style.display = 'block'; // Garantir que o botão "next" seja exibido se houver mais de um item
    }

    if (currentIndex === 0) {
        prevButton.style.display = 'none';
    }
}

prevButton.addEventListener('click', () => moveGallery('prev'));
nextButton.addEventListener('click', () => moveGallery('next'));

// Inicializa o carrossel com o primeiro item selecionado
moveGallery('next');
