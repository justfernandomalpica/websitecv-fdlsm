const navbar = document.querySelector(".navbar");
const header = document.querySelector(".header");

const alerts = document.querySelectorAll(".alert");
const alertBtns = document.querySelectorAll(".alert-button");

if (navbar) {
  const navbarObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        navbar.classList.remove("floating");
      } else {
        navbar.classList.add("floating");
      }
    });
  });

  navbarObserver.observe(header);
}

document.addEventListener("DOMContentLoaded", () => {
  document.addEventListener("click", function (e) {
    if (e.target.classList.contains("alert-button")) {
      const alertCard = e.target.closest(".alert");
      alertCard.classList.add("hide");

      setTimeout(() => {
        alertCard.remove();
      }, 300);
    }
  });
});
