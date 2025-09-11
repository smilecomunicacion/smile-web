<?php
/**
 * Enqueues scripts and styles for SMiLE Web Theme.
 *
 * Este archivo se encarga de encolar los archivos CSS y JavaScript del tema.
 * Además, añade los estilos dinámicos en línea que antes se generaban en el header,
 * utilizando wp_add_inline_style() para centralizar la lógica y seguir las buenas prácticas.
 *
 * @package smile-web
 */

/**
 * Enqueues front-end styles and scripts.
 *
 * Encola el stylesheet principal, un stylesheet adicional, y los scripts necesarios.
 * También genera dinámicamente los estilos en línea según el tipo de página.
 *
 * @return void
 */
function smile_v6_enqueue_scripts() {

	// Encolar el stylesheet principal.
	wp_enqueue_style(
		'smile-web-style',
		get_stylesheet_uri(),
		array(),
		defined( '_S_VERSION' ) ? _S_VERSION : '1.0.0'
	);

	// Encolar un stylesheet adicional para estilos personalizados.
	wp_enqueue_style(
		'smile-web-main',
		get_template_directory_uri() . '/assets/css/main.css',
		array(),
		defined( '_S_VERSION' ) ? _S_VERSION : '1.0.0'
	);

	// Agregar soporte RTL si es necesario.
	wp_style_add_data( 'smile-web-style', 'rtl', 'replace' );

	// Encolar script de navegación (vanilla JS).
	wp_enqueue_script(
		'smile-web-navigation',
		get_template_directory_uri() . '/assets/js/navigation.js',
		array(),
		defined( '_S_VERSION' ) ? _S_VERSION : '1.0.0',
		true
	);

	// Encolar el script principal (vanilla JS).
	wp_enqueue_script(
		'smile-web-main-js',
		get_template_directory_uri() . '/assets/js/main.js',
		array(),
		defined( '_S_VERSION' ) ? _S_VERSION : '1.0.0',
		true
	);

	/**
	 * Generación de estilos dinámicos en línea.
	 *
	 * Los estilos que antes se definían en $style_home en el header ahora se generan
	 * aquí y se añaden al stylesheet principal utilizando wp_add_inline_style().
	 */
	$dynamic_css = '
:root {
    --font-family: "Roboto Regular", sans-serif;
    --font-family-bold: "Roboto Bold", sans-serif;
    --font-family-black: "Roboto Black", sans-serif;
}
#topBar .container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}
@media (min-width: 768px) {
    #topBar .container {
        justify-content: space-between;
    }
}
#topBar a {
    text-decoration: none;
}
.menu-social-menu-container ul {
    display: flex;
    flex-wrap: wrap;
    /* justify-content: center; */
    align-items: center;
    margin: 0;
    padding: 0;
}
.menu-social-menu-container ul li {
    list-style: none;
    margin: 2px;
    padding: 2px;
}
#topBar .container .social-links {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: center;
}
.btn-featured {
    border: 1px solid var(--link);
    color: var(--link);
    padding: 2px 5px;
    margin: 0;
    border-radius: 5px;
    font-size: 14px;
    font-weight: 600;
    text-transform: uppercase;
    transition: all 0.3s ease-in-out;
    cursor: pointer;
    text-decoration: none;
}
.btn-featured:hover {
    background: var(--link);
    color: var(--color-white);
}
.bar1,
.bar2,
.bar3 {
    width: 35px;
    height: 5px;
    background-color: var(--masthead-link);
    margin: 6px 0;
    transition: 0.4s;
}
#nav-toggle:hover .bar1,
#nav-toggle:hover .bar2,
#nav-toggle:hover .bar3 {
    background-color: var(--masthead-link-hover);
}
.menu-bar-change .bar1 {
    -webkit-transform: rotate(-45deg) translate(-9px, 6px);
    transform: rotate(-45deg) translate(-9px, 6px);
}
.menu-bar-change .bar2 {
    opacity: 0;
}
.menu-bar-change .bar3 {
    -webkit-transform: rotate(45deg) translate(-8px, -8px);
    transform: rotate(45deg) translate(-8px, -8px);
}
#intro-carousel {
    display: none;
}
	';

	// Si no existe logo personalizado, agregar estilos para el título.
	if ( ! has_custom_logo() ) {
		$dynamic_css .= '
#logo h3 a {
    text-decoration: none;
    font-size: 30px;
}
		';
	}

	// Estilos según el tipo de página.
	if ( is_front_page() ) {
		$dynamic_css .= '
#intro {
    background-color: var(--accent-secondary-dark);
    color: var(--color-white);
    position: relative;
    z-index: 0;
    display: flex;
    min-height: 450px;
}
#intro h1 {
    margin: 0;
    color: var(--accent-primary-light);
    width: 100%;
}
#intro .row {
    padding-top: 50px;
    align-items: center !important;
    margin: 0 0 30px;
}
@media (min-width:768px) {
    #intro .row {
        margin: 10px 0;
    }
}
#intro .intro-image-margin-bottom {
    width: 100%;
    min-height: 500px;
    position: relative;
    overflow: hidden;
    top: 0;
    left: 0;
    z-index: 10;
    margin: 0;
}
#intro .intro-image-margin-bottom img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    position: absolute;
    top: -50%;
    left: -50%;
    --0-transform: translate(50%, 50%);
    --webkit-transform: translate(50%, 50%);
    transform: translate(50%, 50%);
}
@media (min-width:768px) {
    /* SOLO para la home */
    .intro-margin-bottom {
        margin-top: -10px;
        margin-bottom: 100px;
    }
    #intro .intro-image-margin-bottom {
        margin: 0 0 -100px;
    }
    #intro-carousel {
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        z-index: -1;
        height: 100%;
        margin: 0;
        overflow: hidden;
        background-color: var(--accent-secondary-dark);
    }
    #intro-carousel img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        position: absolute;
        top: -50%;
        left: -50%;
        --0-transform: translate(50%, 50%);
        --webkit-transform: translate(50%, 50%);
        transform: translate(50%, 50%);
        opacity: .6;
    }
    #intro .row {
        display: flex;
        justify-content: space-between;
    }
}
		';
	} elseif ( is_page() ) {
               $dynamic_css .= '
#intro {
        background-color: var(--page-intro-bg);
    color: var(--color-white);
    position: relative;
    z-index: 0;
    margin-bottom: -10px;
    min-height: 300px;
}
    #intro h1 {
    color: var(--page-intro-heading);
    width: 100%;
}
.entry-header {
    margin: 0 auto;
    text-align: center;
    width: 100%;
}
#breadcrumbs {
    position: relative;
    padding: 0;
    line-height: 2em;
}
#breadcrumbs li:not(:first-child)::before {
    content: var(--breadcrumb-separator);
    float: left;
    padding-right: 0.5rem;
    color: var(--text-muted);
}
.breadcrumb {
    display: flex;
    flex-wrap: wrap;
    padding: 0 0;
    margin-bottom: 1rem;
    list-style: none;
}
.post-categories {
    display: inline-flex;
    list-style: none;
    padding: 0;
    margin: 0;
}
@media (min-width:768px) {
    #intro-carousel {
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        z-index: -1;
        height: 100%;
        margin: 0;
        overflow: hidden;
        background-color: var(--page-intro-bg);
    }
    #intro-carousel img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        position: absolute;
        top: -50%;
        left: -50%;
        --0-transform: translate(50%, 50%);
        --webkit-transform: translate(50%, 50%);
        transform: translate(50%, 50%);
        opacity: .3;
    }
    #intro .row {
        display: flex;
        justify-content: space-between;
    }
}
		';
	} else {
               $dynamic_css .= '
#intro {
    background-color: var(--single-intro-bg);
    color: var(--color-white);
    position: relative;
    z-index: 0;
    margin-bottom: -10px;
}
    #intro h1 {
    color: var(--single-intro-heading);
    width: 100%;
}
.entry-header {
    margin: 0 auto;
    text-align: center;
    width: 100%;
}
#breadcrumbs {
    position: relative;
    padding: 0;
    line-height: 2em;
}
#breadcrumbs li:not(:first-child)::before {
    content: var(--breadcrumb-separator);
    float: left;
    padding-right: 0.5rem;
    color: var(--text-muted);
}
.breadcrumb {
    display: flex;
    flex-wrap: wrap;
    padding: 0 0;
    margin-bottom: 1rem;
    list-style: none;
}
.post-categories {
    display: inline-flex;
    list-style: none;
    padding: 0;
    margin: 0;
}
		';
	}

	// Agregar el CSS en línea al stylesheet principal.
	wp_add_inline_style( 'smile-web-style', $dynamic_css );

	// Encolar el script de comentarios para respuestas en hilos si es necesario.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'smile_v6_enqueue_scripts' );

/**
 * Enqueues footer scripts.
 *
 * Encola los scripts que se cargarán en el footer y localiza variables de JavaScript.
 *
 * @return void
 */
function smile_web_enqueue_footer_scripts() {
	wp_enqueue_script(
		'smile-web-footer-script',
		get_template_directory_uri() . '/assets/js/footer.js',
		array(),
		'1.0.0',
		true
	);
	wp_localize_script(
		'smile-web-footer-script',
		'smileWebVars',
		array(
			'socialLinkAriaLabel' => esc_html__( 'Social link', 'smile-web' ),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'smile_web_enqueue_footer_scripts' );

/*
* ------------------------------------------------------------------
* Enqueue Dashicons on the frontend
* ------------------------------------------------------------------
*/

/**
 * Load Dashicons in the frontend if needed.
 *
 * @package smile-web
 */
function smile_v6_enqueue_dashicons_frontend() {
	if ( ! is_admin() ) {
		wp_enqueue_style( 'dashicons' );
	}
}
add_action( 'wp_enqueue_scripts', 'smile_v6_enqueue_dashicons_frontend' );
