const modal = document.querySelector(".galery__modal");
const galeryImages = document.querySelectorAll(".galery__image");

if (galeryImages) {
  document.addEventListener("click", (e) => {
    galeryImages.forEach((img) => {
      if (e.target.attributes.src === img.attributes.src) {
        modal.classList.toggle("modal__show");

        const modalImage = document.createElement("IMG");
        modalImage.src = img.attributes.src.value;
        modalImage.alt = "Imagen Galería";

        modal.appendChild(modalImage);
      }
    });
    if (e.target.classList.contains("galery__modal")) {
      modal.replaceChildren();
      modal.classList.toggle("modal__show");
    }
  });
}
