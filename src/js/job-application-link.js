// js/job-application-link.js

(function(){
    function getUrlParams() {
        const params = {};
        new URLSearchParams(window.location.search).forEach((value, key) => {
            params[key] = value;
        });
        return params;
    }

    function smoothScrollTo(element, offset = 125) {
        if (!element) return;
        const yCoordinate = element.getBoundingClientRect().top + window.pageYOffset;
        window.scrollTo({
            top: yCoordinate - offset,
            behavior: 'smooth'
        });
    }

    function prefillForm() {
        const params = getUrlParams();
        if (!params.poste) return;

        const objetSelect = document.getElementById('objet');
        const offreSelect = document.getElementById('offre_poste');
        const offreSelectRow = document.getElementById('offre-select-row');

        if (objetSelect && offreSelect && offreSelectRow) {
            objetSelect.value = "Offres d'Emplois";
            objetSelect.dispatchEvent(new Event('change', { bubbles: true }));

            offreSelectRow.style.display = "block";
            const decodedPoste = decodeURIComponent(params.poste);
            offreSelect.value = decodedPoste;
        }
    }

    function scrollIfPostePresent() {
        const params = getUrlParams();
        if (params.poste) {
            const form = document.getElementById('candidatureForm');
            if (form) {
                smoothScrollTo(form, 125);
            }
        }
    }

    function observeForm() {
        const observer = new MutationObserver(() => {
            if (document.getElementById('candidatureForm')) {
                prefillForm();
                scrollIfPostePresent();
                observer.disconnect();
            }
        });
        observer.observe(document.body, { childList: true, subtree: true });
    }

    document.addEventListener('DOMContentLoaded', () => {
        prefillForm();
        scrollIfPostePresent();
        observeForm();
    });

    // BONUS: Ajoute support global pour tous les ancres sur la page (comme ton snippet général)
    document.addEventListener("DOMContentLoaded", function() {
        const OFFSET = 125;
        document.querySelectorAll('a[href^="#"]').forEach(link => {
            link.addEventListener("click", function(e) {
                const targetId = this.getAttribute("href").substring(1);
                const targetElement = document.getElementById(targetId);

                if (targetElement) {
                    e.preventDefault();
                    const targetPosition = targetElement.getBoundingClientRect().top + window.scrollY;
                    window.scrollTo({
                        top: targetPosition - OFFSET,
                        behavior: "smooth"
                    });
                }
            });
        });
    });

})();
