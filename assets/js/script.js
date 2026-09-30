const menuButton = document.getElementById('menu-icon');
const navbar = document.getElementById('navbar');
const menuIcon = menuButton ? menuButton.querySelector('i') : null;

if (menuButton && navbar) {
  menuButton.addEventListener('click', () => {
    const isOpen = navbar.classList.toggle('active');
    if (menuIcon) {
      menuIcon.classList.toggle('bx-menu', !isOpen);
      menuIcon.classList.toggle('bx-x', isOpen);
    }
  });
  document.querySelectorAll('.navbar a').forEach((link) => {
    link.addEventListener('click', () => {
      navbar.classList.remove('active');
      if (menuIcon) {
        menuIcon.classList.remove('bx-x');
        menuIcon.classList.add('bx-menu');
      }
    });
  });
}
