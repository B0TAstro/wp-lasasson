// js/accordeon.js

document.addEventListener('DOMContentLoaded', initAccordeons);

function initAccordeons() {
  const accordeons = document.querySelectorAll('[data-accordion]');
  accordeons.forEach(setupAccordeon);

  if (accordeons.length === 1) {
    const content = accordeons[0].querySelector('.dispositif-contact-info');
    if (content) {
      content.classList.add('open');
    }
  }
}

function setupAccordeon(section) {
  const title = section.querySelector('.dispositif-contact-title');
  const content = section.querySelector('.dispositif-contact-info');

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
  document.querySelectorAll('.dispositif-contact-title.active').forEach(t => {
    t.classList.remove('active');
  });

  document.querySelectorAll('.dispositif-contact-info.open').forEach(c => {
    c.classList.remove('open');
  });
}

function openAccordeon(title, content) {
  title.classList.add('active');
  content.classList.add('open');
}
