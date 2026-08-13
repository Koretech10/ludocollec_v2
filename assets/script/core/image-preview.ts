function handleImagePreview() {
    const imageInput = document.querySelector('[data-ludocollec-target="image-input"]');
    const imagePreview = document.querySelector('[data-ludocollec-target="image-preview"]');

    if (imageInput instanceof HTMLInputElement && imagePreview instanceof HTMLImageElement) {
        previewImage(imageInput, imagePreview);
    }
}

function previewImage(imageInput: HTMLInputElement, imagePreview: HTMLImageElement): void {
    const originalSrc = imagePreview.getAttribute("src");

    if (null === originalSrc) {
        return;
    }

    let objectUrl: string | null = null;

    imageInput.addEventListener("change", (event: Event): void => {
        const eventTarget = event.target;

        if (!(eventTarget instanceof HTMLInputElement)) {
            return;
        }

        const fileList = eventTarget.files;

        if (null !== objectUrl) {
            URL.revokeObjectURL(objectUrl);
            objectUrl = null;
        }

        if (null === fileList || fileList.length === 0) {
            imagePreview.src = originalSrc;

            return;
        }

        const file = fileList[0];

        objectUrl = URL.createObjectURL(file);
        imagePreview.src = objectUrl;
    });
}

document.addEventListener("DOMContentLoaded", handleImagePreview);
