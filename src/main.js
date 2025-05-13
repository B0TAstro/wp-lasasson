// Très important pour webpack, sinon le bundle ne fera pas le bon lien entre les assets (mauvaises URLs)
__webpack_public_path__ = window.WP.publicPath;

import './main.scss'
import './js/burger.js'
import './js/home-slider.js'
import './js/magazine-slider.js'
import './js/load-more.js'
import './js/faq.js'
import './js/galerie-noussoutenir.js'
import './js/slider-valeurs.js'
import './js/support-slider.js'
import './js/contact-form.js'
import './js/dispositif-slider.js'
import './js/accordeon.js'
import './js/candidature-form.js'
import './js/job-application-link.js'
import Router from './utils/Router'

// Petit routeur inspiré du framework Sage, qui utilise les classes de body de WordPress
// Peut être une classe ou une simple fonction, une classe peut être appelée dynamiquement, il suffit d'avoir une méthode init 
const routes = {
  common: () => import('./pages/Common'), // nécessite une méthode init dans la classe
  home: () => {
    console.log('init home') // Initialisation de la page d'accueil
  }, 
};

const App = (() => {
  const router = new Router(routes);

  return {
    // Démarre l'application et charge les événements du routeur
    start: () => {
      console.log('Start App');
      router.loadEvents();
    },
    // Arrête l'application et nettoie le routeur
    stop: () => {
      console.log('Stop App');
      router.destroy();
    }
  }
})();

// Gestion du mode HMR (Hot Module Replacement)
if (module.hot) {
  // Nettoie l'application avant de la redémarrer
  module.hot.dispose(() => {
    App.stop();
  });
  // Accepte les mises à jour des modules
  module.hot.accept((err, {moduleId, module}) => {
    console.log(err, {moduleId, module})
  });
}

App.start();