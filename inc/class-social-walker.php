<?php
/**
 * Social_Walker Class.
 *
 * Custom walker for social menus.
 * Agrega atributos de seguridad y accesibilidad a los enlaces de redes sociales.
 *
 * @package smile-web
 */

if ( ! class_exists( 'Social_Walker' ) ) :

	/**
	 * Class Social_Walker.
	 */
	class Social_Walker extends Walker_Nav_Menu {

		/**
		 * Inicia el elemento de salida.
		 *
		 * @param string   &$output Contiene el contenido HTML generado.
		 * @param WP_Post  $item    Objeto que contiene los datos del elemento del menú.
		 * @param int      $depth   Profundidad del elemento del menú.
		 * @param stdClass $args    Argumentos pasados a wp_nav_menu().
		 * @param int      $id      ID del elemento actual.
		 * @return void
		 */
		public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
			$attributes = '';

			// Comprueba si la URL del elemento no está vacía.
			if ( '' !== $item->url ) {
				$attributes .= ' href="' . esc_url( $item->url ) . '"';
			}
			// Comprueba si el título del elemento no está vacío.
			if ( '' !== $item->title ) {
				$attributes .= ' aria-label="' . esc_attr( $item->title ) . '"';
			} else {
				$attributes .= ' aria-label="' . esc_attr__( 'Social media link', 'smile-web' ) . '"';
			}

			// Abre el enlace en una nueva pestaña y agrega atributos de seguridad.
			$attributes .= ' target="_blank"';
			$attributes .= ' rel="noopener noreferrer"';

			// Genera la salida del elemento de menú.
			$output .= sprintf(
				'<li id="menu-item-%s" class="%s"><a%s>%s</a></li>',
				esc_attr( $item->ID ),
				esc_attr( implode( ' ', $item->classes ) ),
				$attributes,
				$args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after
			);
		}
	}

endif;
