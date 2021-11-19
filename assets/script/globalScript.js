import './change-profil-pic-on-click/changeProfilPicOnClick';
import './carousel-active/carouselActive';
import './login-popup/loginPopup';
import './signup-popup/signupPopup';
import './apply-bootstrap-class-on-register-form/applyBootstrapClassOnRegisterForm';
import './actu-popup/actuPopup';
import './carousel-shop/carouselShop';
import './nav-submenu-not-hoverable-when-nav-not-active/navSubmenuNotHoverableWhenNavNotActive';
import './carousel-shop/carouselShopMobile';
import './rock-paper-scissors/rockPaperScissorsBot';

const routes = require('../../public/js/fos_js_routes.json');
import Routing from '../../vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router.min.js';

Routing.setRoutingData(routes);