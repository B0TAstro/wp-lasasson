// js/accordeon.js

document.addEventListener('DOMContentLoaded', initAccordeons);

function initAccordeons() {
  const accordeons = document.querySelectorAll('[data-accordeon]');
  accordeons.forEach(setupAccordeon);
}

function setupAccordeon(section) {
  const title = section.querySelector('.contact-title');
  const content = section.querySelector('.contact-info');

  if (!title || !content) return;

  title.addEventListener('click', () => toggleAccordeon(title, content));
}

function toggleAccordeon(title, content) {
  const isOpen = title.classList.contains('active');

  closeAllAccordeons();

  if (!isOpen) {
    openAccordeon(title, content);
  }
}

function closeAllAccordeons() {
  document.querySelectorAll('.section-contact .contact-title').forEach(t => t.classList.remove('active'));
  document.querySelectorAll('.section-contact .contact-info').forEach(c => c.classList.remove('open'));
}

function openAccordeon(title, content) {
  title.classList.add('active');
  content.classList.add('open');
}