<?php
/**
 * SMiLE Web Theme functions and definitions.
 *
 * @package smile-web
 */

if ( ! defined( '_S_VERSION' ) ) {
	define( '_S_VERSION', '6.0.7' );
}

/**
 * Incluye la configuración básica y soporte del tema.
 * Contiene funciones de setup como registro de menús, imágenes destacadas, etc.
 */
require get_template_directory() . '/inc/theme-setup.php';

/**
 * Incluye las opciones del Customizer.
 * Contiene las opciones que se muestran en el personalizador de WordPress.
 */
require get_template_directory() . '/inc/customizer-options.php';

/**
 * Incluye el encolamiento de scripts y estilos.
 * Contiene las funciones para encolar los archivos CSS y JavaScript necesarios.
 */
require get_template_directory() . '/inc/enqueues.php';

/**
 * Incluye los estilos dinámicos del Customizer.
 * Genera reglas CSS dinámicas basadas en las opciones del tema definidas en el Customizer.
 */
require get_template_directory() . '/inc/customizer-dynamic-styles.php';

/**
 * Incluye las etiquetas de plantilla personalizadas.
 * Contiene funciones auxiliares que se pueden utilizar en las plantillas del tema.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Incluye la configuración de widgets.
 * Registra las áreas de widgets y define widgets personalizados.
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Incluye los patrones de bloques.
 * Contiene los patrones para el editor de bloques (Gutenberg).
 */
require get_template_directory() . '/inc/block-patterns.php';

/**
 * Incluye la configuración del encabezado personalizado.
 * Contiene funciones relacionadas con la funcionalidad del encabezado (custom header).
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Incluye funciones adicionales de plantilla.
 * Contiene funciones varias usadas en diferentes partes del tema.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Incluye la compatibilidad con Jetpack.
 * Se carga únicamente si el plugin Jetpack está activo.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Incluye la clase Social_Walker.
 * Esta clase extiende Walker_Nav_Menu para personalizar la salida del menú social,
 * agregando atributos como target="_blank" y rel="noopener noreferrer".
 */
require get_template_directory() . '/inc/class-social-walker.php';
