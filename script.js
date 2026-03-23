document.addEventListener("DOMContentLoaded", () => {

  /* =========================
     MOBILE MENU
  ========================= */

  const hamburger = document.getElementById("hamburger");
  const mobileMenu = document.getElementById("mobileMenu");

  if (hamburger && mobileMenu) {
    hamburger.addEventListener("click", () => {
      hamburger.classList.toggle("active");
      mobileMenu.classList.toggle("open");
    });
  }

  /* =========================
     DARK MODE TOGGLE
  ========================= */

  const toggle = document.querySelector(".theme-toggle");

  if (!toggle) {
    console.error("Theme toggle button not found");
    return;
  }

  function setTheme(mode) {
    if (mode === "dark") {
      document.body.classList.add("dark");
      toggle.innerHTML = '<i data-lucide="sun"></i>';
    } else {
      document.body.classList.remove("dark");
      toggle.innerHTML = '<i data-lucide="moon"></i>';
    }

    localStorage.setItem("theme", mode);

    if (window.lucide) {
      lucide.createIcons();
    }
  }

  // Load saved theme
  const savedTheme = localStorage.getItem("theme") || "light";
  setTheme(savedTheme);

  // Toggle on click
  toggle.addEventListener("click", () => {
    const newTheme = document.body.classList.contains("dark") ? "light" : "dark";
    setTheme(newTheme);
  });

});

  const year = document.getElementById('year');
  if (year) {
    year.textContent = new Date().getFullYear();
  }
