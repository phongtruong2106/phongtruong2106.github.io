function toggleMenu() {
  const menu = document.querySelector(".menu-links");
  const icon = document.querySelector(".hamburger-icon");
  menu.classList.toggle("open");
  icon.classList.toggle("open");
}

function toggleNightMode() {
  const body = document.body;
  body.classList.toggle('night-mode');
}
// Check if the user has dark mode preference and apply night mode
if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
  toggleNightMode();
}

// Scroll to Top Button
const backToTopButton = document.getElementById("back-to-top-btn");

// Show or hide the button based on scroll position
window.addEventListener("scroll", function () {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    backToTopButton.style.display = "block";
  } else {
    backToTopButton.style.display = "none";
  }
});

// Scroll to top function
function scrollToTop() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE, and Opera
}
