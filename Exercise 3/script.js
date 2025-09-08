
const flipCards = document.querySelectorAll(".flip-card");

flipCards.forEach(card => {
  card.addEventListener("click", () => {
    const isFlipped = card.classList.contains("flipped");

    // alisin muna lahat ng flipped
    flipCards.forEach(c => c.classList.remove("flipped"));

    // kung hindi pa flipped, i-flip siya
    if (!isFlipped) {
      card.classList.add("flipped");
    }
  });

  const qrLink = card.querySelector(".qr-link");
  if (qrLink) {
    qrLink.addEventListener("click", (e) => {
      e.stopPropagation(); // para clickable padin ang link
    });
  }
});

// ==== DARK MODE TOGGLE (Emoji Switch 🌙 / ☀️) ====
const darkModeToggle = document.getElementById("darkModeToggle");

// load saved preference
window.addEventListener("DOMContentLoaded", () => {
  const savedTheme = localStorage.getItem("theme");
  if (savedTheme === "dark") {
    document.body.classList.add("dark-mode");
    darkModeToggle.textContent = "☀️";
  } else {
    darkModeToggle.textContent = "🌙";
  }
});

// toggle mode
darkModeToggle.addEventListener("click", () => {
  document.body.classList.toggle("dark-mode");

  if (document.body.classList.contains("dark-mode")) {
    darkModeToggle.textContent = "☀️"; // switch to light
    localStorage.setItem("theme", "dark");
  } else {
    darkModeToggle.textContent = "🌙"; // switch to dark
    localStorage.setItem("theme", "light");
  }
});