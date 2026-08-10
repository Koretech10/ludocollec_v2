function handleImagePreview() {
    const imageInput = document.querySelector('[data-ludocollec-target="image-input"]');
    const imagePreview = document.querySelector('[data-ludocollec-target="image-preview"]');

    if (imageInput && imagePreview) {
        previewImage(imageInput, imagePreview);
    }
}

function previewImage(imageInput, imagePreview) {
    const originalSrc = imagePreview.getAttribute("src");
    let objectUrl = null;

    imageInput.addEventListener("change", (event) => {
        const file = event.target.files[0];

        if (objectUrl) {
            URL.revokeObjectURL(objectUrl);
            objectUrl = null;
        }

        if (file) {
            objectUrl = URL.createObjectURL(file);
            imagePreview.src = objectUrl;
        } else {
            imagePreview.src = originalSrc;
        }
    });
}

document.addEventListener("DOMContentLoaded", handleImagePreview);
