document.addEventListener('DOMContentLoaded', function () {
  const accordeons = document.querySelectorAll('[data-accordeon]');

  accordeons.forEach(section => {
    const title = section.querySelector('.contact-title');
    const content = section.querySelector('.contact-info');

    if (!title || !content) return;

    title.addEventListener('click', function () {
      const isOpen = title.classList.contains('active');

      // Fermer tous
      document.querySelectorAll('.section-contact .contact-title').forEach(t => t.classList.remove('active'));
      document.querySelectorAll('.section-contact .contact-info').forEach(c => c.classList.remove('open'));

      // Ouvrir l'actuel
      if (!isOpen) {
        title.classList.add('active');
        content.classList.add('open');
      }
    });
  });
});