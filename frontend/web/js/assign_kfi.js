let currentImageIndex = null;

function updateSlotVisibility() {
    const imageCount = document.getElementById('image-container').getElementsByClassName('image-wrapper').length;
    document.getElementById('image-slot').style.display = imageCount >= 8 ? 'none' : 'inline-flex';
}

document.getElementById('image-container').addEventListener('click', function (event) {
    const openMenus = document.querySelectorAll('.context-menu');
    openMenus.forEach(menu => {
        menu.style.display = 'none';
    });

    if (event.target.nodeName === 'IMG') {
        const modal = document.getElementById('fullscreen-modal');
        const fullImage = document.getElementById('fullscreen-image');
        const images = Array.from(document.getElementById('image-container').getElementsByTagName('img'));

        currentImageIndex = images.indexOf(event.target);

        fullImage.src = event.target.src;
        modal.style.display = 'flex';
    } else if (event.target.classList.contains('image-options')) {
        const menu = event.target.nextSibling;
        menu.style.display = 'block';
    } else if (event.target.innerText === 'Eliminar') {
        const imgWrapper = event.target.closest('.image-wrapper');
        imgWrapper.remove();
        updateSlotVisibility();
    }
});

document.getElementById('prev-image').addEventListener('click', function () {
    const images = Array.from(document.getElementById('image-container').getElementsByTagName('img'));

    if (currentImageIndex > 0) {
        currentImageIndex--;
        document.getElementById('fullscreen-image').src = images[currentImageIndex].src;
    }
});

document.getElementById('next-image').addEventListener('click', function () {
    const images = Array.from(document.getElementById('image-container').getElementsByTagName('img'));

    if (currentImageIndex < images.length - 1) {
        currentImageIndex++;
        document.getElementById('fullscreen-image').src = images[currentImageIndex].src;
    }
});

document.getElementById('close-modal').addEventListener('click', function () {
    document.getElementById('fullscreen-modal').style.display = 'none';
});

document.addEventListener('keydown', function (event) {
    if (document.getElementById('fullscreen-modal').style.display === 'flex') {
        if (event.key === 'ArrowLeft') {
            document.getElementById('prev-image').click();
        } else if (event.key === 'ArrowRight') {
            document.getElementById('next-image').click();
        } else if (event.key === 'Escape') {
            document.getElementById('close-modal').click();
        }
    }
});

document.getElementById('fullscreen-modal').addEventListener('click', function (event) {
    if (event.target === document.getElementById('fullscreen-modal')) {
        document.getElementById('close-modal').click();
    }
});

document.getElementById('image-slot').addEventListener('click', function () {
    document.getElementById('image-upload').click();
});

document.getElementById('image-upload').addEventListener('change', function (event) {
    const files = event.target.files;
    const currentImages = document.getElementById('image-container').getElementsByClassName('image-wrapper').length;
    const allowedUploads = 8 - currentImages;

    if (files.length > allowedUploads) {
        const toast = document.getElementById('toast');
        toast.style.display = 'block';
        setTimeout(() => {
            toast.style.display = 'none';
        }, 3000);
        return;
    }

    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const reader = new FileReader();

        reader.onload = function (e) {
            const imgWrapper = document.createElement('div');
            imgWrapper.classList.add('image-wrapper');

            const img = document.createElement('img');
            img.src = e.target.result;

            const optionsIcon = document.createElement('div');
            optionsIcon.classList.add('image-options');
            optionsIcon.innerHTML = '...';

            const menu = document.createElement('div');
            menu.classList.add('context-menu');
            const deleteButton = document.createElement('button');
            deleteButton.innerText = 'Eliminar';
            deleteButton.addEventListener('click', function () {
                imgWrapper.remove();
                updateSlotVisibility();
                menu.style.display = 'none';
            });
            menu.appendChild(deleteButton);

            imgWrapper.appendChild(img);
            imgWrapper.appendChild(optionsIcon);
            imgWrapper.appendChild(menu);

            const slot = document.getElementById('image-slot');
            document.getElementById('image-container').insertBefore(imgWrapper, slot);

            updateSlotVisibility();
        }

        reader.readAsDataURL(file);
    }
});

const imageContainer = document.getElementById('image-container');
const sortable = new Sortable(imageContainer, {
    animation: 150,
    handle: '.image-wrapper',
    filter: '#image-slot',
    ghostClass: 'sortable-ghost',
    chosenClass: 'sortable-chosen'
});
