document.addEventListener('DOMContentLoaded', function() {
    const faqItems = document.querySelectorAll('.faq-item');
    
    faqItems.forEach(function(item) {
        const questionBtn = item.querySelector('.faq-toggle');
        const answer = item.querySelector('.faq-answer');
        
        if (questionBtn && answer) {
            questionBtn.addEventListener('click', function() {
                const expanded = this.getAttribute('aria-expanded') === 'true';
                
                faqItems.forEach(function(otherItem) {
                    if (otherItem !== item) {
                        const otherBtn = otherItem.querySelector('.faq-toggle');
                        const otherAnswer = otherItem.querySelector('.faq-answer');
                        
                        if (otherBtn && otherAnswer) {
                            otherBtn.setAttribute('aria-expanded', 'false');
                            otherAnswer.setAttribute('aria-hidden', 'true');
                        }
                    }
                });
                
                this.setAttribute('aria-expanded', !expanded);
                answer.setAttribute('aria-hidden', expanded);
            });
        }
    });
});