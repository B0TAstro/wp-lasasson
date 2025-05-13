// js/accordeon.js

document.addEventListener('DOMContentLoaded', initAccordeons);

function initAccordeons() {
  const accordeons = document.querySelectorAll('[data-accordion]');

  accordeons.forEach((section, index) => {
    const title = section.querySelector('.dispositif-contact-title');
    const content = section.querySelector('.dispositif-contact-info');

    if (!title || !content) return;

    title.addEventListener('click', () => toggleAccordeon(title, content));

    if (index === 0) {
      title.classList.add('active');
      content.classList.add('open');
    }
  });
}

function toggleAccordeon(title, content) {
  const isOpen = content.classList.contains('open');

  title.classList.toggle('active', !isOpen);
  content.classList.toggle('open', !isOpen);
}
