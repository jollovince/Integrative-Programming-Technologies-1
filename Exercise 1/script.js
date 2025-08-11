const mainContent = document.getElementById("mainContent");
const profileCards = document.querySelectorAll(".profile-card");
const modal = document.getElementById("profileModal");
const modalDetails = document.getElementById("modalDetails");
const modalContent = modal.querySelector(".modal-content");
const closeBtn = document.querySelector(".close-btn");

profileCards.forEach(card => {
  card.addEventListener("click", () => {
    
    const bgColor = getComputedStyle(card).backgroundColor;

    
    modalContent.style.background = bgColor;
    modalContent.style.backgroundClip = "padding-box";
    modalContent.style.webkitBackdropFilter = "blur(10px)";
    modalContent.style.backdropFilter = "blur(10px)";

    
    modalDetails.innerHTML = card.innerHTML;

  
    modal.style.display = "flex";
    mainContent.classList.add("blur");
  });
});

closeBtn.addEventListener("click", () => {
  modal.style.display = "none";
  mainContent.classList.remove("blur");
});

window.addEventListener("click", (event) => {
  if (event.target === modal) {
    modal.style.display = "none";
    mainContent.classList.remove("blur");
  }
});