
document.querySelectorAll('.profile-card').forEach(card => {
  card.addEventListener('click', () => {
    card.classList.toggle('expanded');
  });
});