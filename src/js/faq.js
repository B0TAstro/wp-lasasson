document.addEventListener('DOMContentLoaded', () => {
    const faqItems = document.querySelectorAll('.faq-item');
  
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        const answer = item.querySelector('.faq-answer');
      
        question.addEventListener('click', () => {
            const isActive = item.classList.contains('active');
          
            // On ferme tous les items actifs
            faqItems.forEach(otherItem => {
                if (otherItem.classList.contains('active')) {
                    const otherAnswer = otherItem.querySelector('.faq-answer');
                    
                    otherAnswer.style.height = otherAnswer.scrollHeight + 'px';
                    setTimeout(() => {
                        otherAnswer.style.height = '0px';
                        otherAnswer.style.padding = '0 30px';
                        otherAnswer.style.opacity = '0';
                    }, 10);
                    
                    setTimeout(() => {
                        otherItem.classList.remove('active');
                    }, 300);
                }
            });
          
            // Si l'item n'était pas actif, on l'active
            if (!isActive) {
                item.classList.add('active');
                
                answer.style.padding = '20px 30px';
                answer.style.opacity = '1';
                
                const answerHeight = answer.scrollHeight;
                answer.style.height = answerHeight + 'px';
            }
        });
    });
});