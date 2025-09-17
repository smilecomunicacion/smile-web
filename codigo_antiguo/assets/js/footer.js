/**
 * Theme Name: SMiLE Web
 * Theme URI: https://smilecomunicacion.com/web/wordpress/smile-web/
 * Version: 6.0.0
 * Author: SMiLE Comunicación
 * Author URI: https://www.linkedin.com/in/cesarbla/
 * License: GNU General Public License v2 or later
 * License URI: https://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * Description: Free theme, SEO optimized. Gain visibility and reach the top positions in search engines quickly. Fully configured and very easy to self-manage with the integration of WordPress Guttemberg blocks editor.
 */

// Seleccionar todos los enlaces de redes sociales
const els = document.querySelectorAll('.social-links li a')
for (let i = 0; i < els.length; i++) {
	// Asignar el aria-label traducido
	els[i].setAttribute('aria-label', smileWebVars.socialLinkAriaLabel)
}
