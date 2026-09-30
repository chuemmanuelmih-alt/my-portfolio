const toggle = document.getElementById('mobile-toggle');
const sidebar = document.getElementById('sidebar');
if (toggle && sidebar) toggle.addEventListener('click', () => sidebar.classList.toggle('open'));

document.querySelectorAll('[data-confirm]').forEach((link) => {
  link.addEventListener('click', (event) => {
    if (!window.confirm(link.dataset.confirm)) event.preventDefault();
  });
});
