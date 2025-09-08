<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package smile-web
 */

?>

<footer id="footer" role="contentinfo" itemscope="itemscope" itemtype="https://schema.org/WPFooter">
	<?php
	// Verifica si la sección de contacto está habilitada.
	$show_contact_section = get_theme_mod( 'footer_contact_display', 'yes' );
	if ( 'yes' === $show_contact_section ) {
		?>
		<section id="contact" class="container py-5">
			<div class="header">
				<p class="lh2"><?php echo esc_html( get_theme_mod( 'footer_contact_title', __( 'Contact', 'smile-web' ) ) ); ?></p>
				<p><?php echo esc_html( get_theme_mod( 'footer_contact_description', __( 'Use this form to reach out to us with any questions or comments. We will respond as soon as possible.', 'smile-web' ) ) ); ?></p>
			</div>
			<div id="formulario-footer2" class="row justify-content-center shadow rounded">
				<div class="col-12 col-md-4 col-lg-4 p-0 bg-light2">
					<!-- Customized telephone -->
					<div class="p-2 m-3 border-bottom">
						<?php
						$footer_phone = get_theme_mod( 'footer_telephone', '' );
						if ( ! empty( $footer_phone ) ) :
							?>
                                                        <h4 class="p-0 m-0"><?php esc_html_e( 'Phone', 'smile-web' ); ?></h4>
                                                       <p>
                                                               <a href="<?php echo esc_url( sprintf( 'tel:%s', $footer_phone ) ); ?>" class="h2 iterator_Footer-Telefono" target="_blank" rel="noreferrer nofollow noopener noreferrer">
                                                                       <?php echo esc_html( $footer_phone ); ?>
                                                               </a>
                                                       </p>
                                                <?php endif; ?>
                                        </div>

					<!-- Customized address -->
					<?php
					$street_address   = get_theme_mod( 'footer_address', '' );
					$postal_code      = get_theme_mod( 'footer_postal_code', '' );
					$address_locality = get_theme_mod( 'footer_city', '' );
					$map_link         = get_theme_mod( 'footer_link_to_google_maps', '' );
					if ( ! empty( $street_address ) || ! empty( $postal_code ) || ! empty( $address_locality ) ) :
						?>
						<div class="p-2 m-3 border-bottom">
							<address>
								<h4 class="p-0 m-0"><?php esc_html_e( 'Address', 'smile-web' ); ?></h4>
								<?php if ( ! empty( $street_address ) ) : ?>
									<span itemprop="streetAddress"><?php echo esc_html( $street_address ); ?></span>,
								<?php endif; ?>
								<?php if ( ! empty( $postal_code ) ) : ?>
									<span itemprop="postalCode"><?php echo esc_html( $postal_code ); ?> </span>
								<?php endif; ?>
								<?php if ( ! empty( $address_locality ) ) : ?>
									<span itemprop="addressLocality"><?php echo esc_html( $address_locality ); ?></span>
								<?php endif; ?>
								<p class="iterator_Footer-Direccion">
                                                                        <a class="btn-cta" title="<?php esc_attr_e( 'Open in map', 'smile-web' ); ?>" href="<?php echo esc_url( $map_link ); ?>" target="_blank" rel="noreferrer noopener noreferrer">
                                                                                <?php esc_html_e( 'Open in map', 'smile-web' ); ?>
                                                                        </a>
                                                                </p>
                                                        </address>
                                                </div>
                                        <?php endif; ?>

					<!-- Customized email -->
					<?php
					$footer_email = get_theme_mod( 'footer_email', '' );
					if ( ! empty( $footer_email ) ) {
						?>
						<div class="p-2 m-3">
							<h4 class="p-0 m-0"><?php esc_html_e( 'Email', 'smile-web' ); ?></h4>
							<?php
							if ( function_exists( 'smile_v6_mostrar_correo_ofuscado' ) ) {
								smile_v6_mostrar_correo_ofuscado( $footer_email );
                                                       } else {
                                                               printf( '<a href="%s">%s</a>', esc_url( sprintf( 'mailto:%s', $footer_email ) ), esc_html( $footer_email ) );
                                                       }
							?>
						</div>
						<?php
					}
					?>
				</div>
				<div class="col-12 col-md-8 col-lg-8 p-3 bg-light2">
					<?php
					// Verifica si se definió el shortcode del formulario de contacto.
					$contact_form_shortcode = get_theme_mod( 'footer_contact_shortcode_form', '' );
					if ( ! empty( $contact_form_shortcode ) ) {
						echo do_shortcode( $contact_form_shortcode );
					} else {
						echo '<p>' . esc_html__( 'No contact form available.', 'smile-web' ) . '</p>';
					}
					?>
				</div>
			</div>
		</section> <!-- #contact -->
		<?php
	}
	?>
	<div class="footer-top bg-footer text-white">
		<div class="container border-bottom py-5">
			<div class="row">
				<div class="col-md-6 col-lg-3 p-3">
					<div id="footer-1" class="pt-4 widget-area footer-link-area1">
						<figure id="logo2">
							<?php
							$logo_footer = get_theme_mod( 'footer_logo', '' );
							if ( ! empty( $logo_footer ) ) {
								?>
                                                                <a href="<?php echo esc_url( home_url( '' ) ); ?>">
                                                                        <img class="img-fluid" src="<?php echo esc_url( $logo_footer ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" width="300px" style="max-height:200px;">
                                                                </a>
                                                       <?php } ?>
						</figure>
						<?php dynamic_sidebar( 'footer-1' ); ?>
						<div class="pt-3 social-links">
							<?php
							wp_nav_menu(
								array(
									'theme_location' => 'menu-2',
									'menu_class'     => 'd-flex',
									'walker'         => new Social_Walker(),
								)
							);
							?>
						</div>
					</div>
				</div>
				<div id="footer-2" class="col-md-6 col-lg-3 p-3 footer-link">
					<?php dynamic_sidebar( 'footer-2' ); ?>
				</div>
				<div id="footer-3" class="col-md-6 col-lg-3 p-3 footer-link">
					<?php dynamic_sidebar( 'footer-3' ); ?>
				</div>
				<div id="footer-4" class="col-md-6 col-lg-3 p-3 footer-link">
					<?php dynamic_sidebar( 'footer-4' ); ?>
				</div>
			</div>
		</div>
		<div id="copyright" class="py-3">
			<div class="container">
				<div class="text-white">
					<span>
						<?php echo esc_html( gmdate( 'Y' ) ); ?> • &copy; <?php bloginfo( 'name' ); ?>&nbsp;|&nbsp;
					</span>
					<?php
					if ( has_nav_menu( 'menu-3' ) ) :
						wp_nav_menu(
							array(
								'theme_location' => 'menu-3',
								'menu_id'        => 'menu-legal-menu',
								'menu_class'     => '',
								'container'      => false,
								'depth'          => 1,
							)
						);
					else :
						$privacy_policy_url = get_privacy_policy_url();
						if ( ! empty( $privacy_policy_url ) ) :
							?>
							<a href="<?php echo esc_url( $privacy_policy_url ); ?>" class="text-white">
								<?php esc_html_e( 'Privacy Policy', 'smile-web' ); ?>
							</a>
							<?php
						endif;
					endif;
					?>
				</div>
				<?php
				/* translators: 1: Theme name, 2: Theme author URL. */
                                printf( esc_html__( 'Theme: %1$s by %2$s.', 'smile-web' ), 'SMiLE web', '<a href="' . esc_url( 'https://smilecomunicacion.com/web/wordpress/smile-web/' ) . '" target="_blank" rel="noopener noreferrer">' . esc_html__( 'SMiLE Comunicación', 'smile-web' ) . '</a>' );
                                ?>
                        </div>
                </div>
        </div>
</footer><!-- #footer -->
</div><!-- #page -->

<!-- Modal for the search form. -->
<div id="modalBuscador" class="modal">
	<div class="modal-content2">
		<div class="modal-header">
			<span class="close" tabindex="0">&times;</span>
			<p class="text-center"><?php esc_html_e( 'Search', 'smile-web' ); ?></p>
		</div>
		<div class="modal-body bg-light">
			<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" class="row">
				<input type="text" class="searching_TopHeader-Lupa-Buscador py-2 col-10 col-md-11 form-control" name="s" id="myInput" onkeyup="fetch()" placeholder="<?php esc_attr_e( 'Escribe aquí', 'smile-web' ); ?>">
				<button type="submit" class="col-2">
					<span class="dashicons dashicons-search" aria-hidden="true"></span>
					<span class="screen-reader-text"><?php esc_html_e( 'Buscar', 'smile-web' ); ?></span>
				</button>
				<div id="resultado" class="col-12">
					<!-- Aquí se mostrarán los resultados -->
				</div>
			</form>
			<br>
		</div>
	</div>
</div>

<?php
$whatsapp_number = get_theme_mod( 'whatsapp_telephone', '' );
if ( ! empty( $whatsapp_number ) ) {
        $whatsapp_number = str_replace( '+', '', $whatsapp_number );
        $whatsapp_number = str_replace( ' ', '', $whatsapp_number );
        $whatsapp_text   = get_theme_mod( 'whatsapp_message', '' );
        $whatsapp_url    = add_query_arg(
                array(
                        'phone' => $whatsapp_number,
                        'text'  => $whatsapp_text,
                ),
                'https://api.whatsapp.com/send'
        );
        echo '<a href="' . esc_url( $whatsapp_url ) . '" target="_blank" id="whatsapp" class="iterator_Whatsapp whatsapp-button" rel="nofollow noreferrer noopener noreferrer" title="' . esc_attr__( 'open Whatsapp', 'smile-web' ) . '">';
?>
    <div class="whatsapp-button">
	    <div class="whatsapp-background">
		    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="#fff">
			    <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/>
		    </svg>
	    </div>
    </div>
</a>
<?php
}
?>
<?php wp_footer(); ?>
</body>
</html>
