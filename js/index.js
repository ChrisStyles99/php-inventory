const burguerIcon = document.querySelector('#burger');
const navMenu = document.querySelector('#nav-links');

burguerIcon.addEventListener('click', () => {
  navMenu.classList.toggle('is-active');
});