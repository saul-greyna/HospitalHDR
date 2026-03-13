 document.addEventListener("DOMContentLoaded", () => {
    const toggleButton = document.getElementById("toggle");
    const navbarLinks = document.getElementById("menu");

    toggleButton.addEventListener("click", () => {
      navbarLinks.classList.toggle("hidden");
      navbarLinks.classList.toggle("flex");
    });
  });