<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up until <div id="page">.
 *
 * @package smile-web
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
        <link rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>">
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="https://smilecomunicacion.com | Comunicación y Programación">
        <meta itemprop="cssSelector" content=".title" />
        <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
        <?php wp_body_open(); ?>
	<a class="skip-link screen-reader-text" href="#page" aria-label="<?php esc_attr_e( 'Skip to main content', 'smile-web' ); ?>">
		<?php esc_html_e( 'Skip to content', 'smile-web' ); ?>
	</a>
	<div id="topBar">
		<div class="container align-center">
			<?php
			/* Customized email in options */
			$topbar_email = get_theme_mod( 'top_bar_email', '' );
			if ( ! empty( $topbar_email ) ) {
				echo '<div class="me-3">';
				if ( function_exists( 'smile_v6_mostrar_correo_ofuscado' ) ) {
					smile_v6_mostrar_correo_ofuscado( $topbar_email );
                               } else {
                                       printf( '<a href="%s">%s</a>', esc_url( sprintf( 'mailto:%s', $topbar_email ) ), esc_html( $topbar_email ) );
                               }
				echo '</div>';
			}

			/* Customized phone in options */
			$topbar_phone  = get_theme_mod( 'top_bar_telephone', '' );
			$topbar_phone2 = preg_replace( '/\s+/', '', $topbar_phone );
			if ( ! empty( $topbar_phone ) ) {
                               echo '<div>';
                               printf( '<i class="fa fa-phone"></i> <a href="%s" class="iterator_TopHeader-Telefono" rel="nofollow noopener noreferrer">%s</a>', esc_url( sprintf( 'tel:%s', $topbar_phone2 ) ), esc_html( $topbar_phone ) );
                               echo '</div>';
			}
			?>
			<div class="social-links" aria-label="<?php esc_attr_e( 'Social media navigation', 'smile-web' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-2',
						'menu_class'     => 'd-flex px-5',
						'link_before'    => '<span class="sr-only">',
						'link_after'     => '</span>',
						'walker'         => new Social_Walker(),
					)
				);
				?>
			</div>
			<div>
				<a id="myBtn" href="#" class="p-2 buscar" aria-label="<?php esc_attr_e( 'Open search box', 'smile-web' ); ?>" itemprop="url" data-bs-toggle="modal" data-bs-target="#searchModal" rel="nofollow noopener noreferrer">
					<span title="<?php esc_attr_e( 'Search in web', 'smile-web' ); ?>" class="buscar p-0" aria-hidden="true">
						<svg width="20" height="20" viewBox="0 0 8 8" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:1.41421;">
							<g transform="matrix(1,0,0,1,-1111.24,-105.745)">
								<g transform="matrix(0.0136842,0,0,0.0136842,1111.24,105.745)">
									<path d="M505,442.7L405.3,343C400.8,338.5 394.7,336 388.3,336L372,336C399.6,300.7 416,256.3 416,208C416,93.1 322.9,0 208,0C93.1,0 0,93.1 0,208C0,322.9 93.1,416 208,416C256.3,416 300.7,399.6 336,372L336,388.3C336,394.7 338.5,400.8 343,405.3L442.7,505C452.1,514.4 467.3,514.4 476.6,505L504.9,476.7C514.3,467.3 514.3,452.1 505,442.7ZM208,336C137.3,336 80,278.8 80,208C80,137.3 137.2,80 208,80C278.7,80 336,137.2 336,208C336,278.7 278.8,336 208,336Z" />
								</g>
							</g>
						</svg>
					</span>
				</a>
			</div>
		</div>
	</div>
	<header id="masthead" role="banner">
		<nav class="container" role="navigation" aria-label="<?php esc_attr_e( 'Main navigation', 'smile-web' ); ?>">
			<figure id="logo" class="py-1">
				<?php
				if ( has_custom_logo() ) {
					$custom_logo_id = get_theme_mod( 'custom_logo' );
					$logo_img       = wp_get_attachment_image_src( $custom_logo_id, 'full' );
					if ( ! empty( $logo_img ) ) {
						?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemid="" itemscope itemtype="http://schema.org/SpeakableSpecification" class="me-auto" aria-current="<?php echo ( is_front_page() ) ? 'page' : ''; ?>">
							<img src="<?php echo esc_url( $logo_img[0] ); ?>" width="150" height="60" alt="<?php echo esc_attr( get_bloginfo( 'name' ) . ' logo' ); ?>">
						</a>
						<?php
					}
				} else {
					?>
					<h3 class="me-auto">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
							<?php bloginfo( 'name' ); ?>
						</a>
					</h3>
					<?php
				}
				?>
			</figure>
			<button id="nav-toggle" aria-label="<?php esc_attr_e( 'Toggle navigation menu', 'smile-web' ); ?>" tabindex="0">
				<div class="bar1"></div>
				<div class="bar2"></div>
				<div class="bar3"></div>
			</button>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'container'      => false,
					'items_wrap'     => '<ul id="nav-menu" role="menubar">%3$s</ul>',
					'menu_class'     => 'menu',
				)
			);
			?>
		</nav>
	</header>
	<div id="page" role="main">
