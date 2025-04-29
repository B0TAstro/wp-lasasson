// js/burger.js

document.addEventListener('DOMContentLoaded', () => {
  const toggle = document.getElementById('menu-toggle');
  const links = document.querySelectorAll('.nav-wrapper a');

  links.forEach(link => {
    link.addEventListener('click', () => {
      toggle.checked = false;
    });
  });
});
