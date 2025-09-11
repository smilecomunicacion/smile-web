<?php
/**
 * Main template file.
 *
 * Este archivo se utiliza para mostrar las entradas del blog cuando no existe una plantilla más específica.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package smile-web
 */

get_header();

// Obtener el ID de la página de entradas.
$page_for_posts_id = get_option( 'page_for_posts' );

// Verificar si existe la página de entradas utilizando condición Yoda.
$page_title = ( false !== $page_for_posts_id ) ? get_the_title( $page_for_posts_id ) : __( 'Blog', 'smile-web' );
$page_slug  = ( false !== $page_for_posts_id ) ? get_post_field( 'post_name', $page_for_posts_id ) : 'blog';
?>
<div id="intro">
	<div class="text-center py-5">
                <h1 class="text-heading"><?php echo esc_html( $page_title ); ?></h1>
		<p class="text-center mt-4">
			<a href="#contact" class="btn-cta" rel="nofollow noreferrer">
                               <?php esc_html_e( 'Contact us', 'smile-web' ); ?>
			</a>
		</p>
	</div>
</div>

<main id="main" class="blog-page area-padding bg-primary">
	<div id="page">
		<div class="container">
			<div id="breadcrumbs">
				<nav aria-label="<?php esc_attr_e( 'breadcrumb', 'smile-web' ); ?>">
                                        <ol itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumb" style="background-color: var(--breadcrumb-bg);">
						<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="breadcrumb-item">
							<img class="mx-2"
								src="<?php echo esc_url( get_template_directory_uri() . '/lib/fontawesome-free/svgs/solid/home.svg' ); ?>"
								alt="<?php esc_attr_e( 'home', 'smile-web' ); ?>"
								title="<?php esc_attr_e( 'Home', 'smile-web' ); ?>"
								width="20px"
								height="20px">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"
								rel="home"
								title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
								<span><?php esc_html_e( 'Home', 'smile-web' ); ?></span>
							</a>
							<meta itemprop="position" content="1" />
						</li>
						<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="breadcrumb-item">
							<a itemprop="item"
								title="<?php echo esc_attr( get_bloginfo( 'description' ) ); ?>"
								href="<?php echo esc_url( home_url( '/' . $page_slug . '/' ) ); ?>">
								<span itemprop="name"><?php echo esc_html( $page_title ); ?></span>
							</a>
							<meta itemprop="position" content="2" />
						</li>
					</ol>
				</nav>
			</div>

			<div>
				<?php
				// Mostrar el contenido de la página de entradas si existe.
				if ( false !== $page_for_posts_id ) :
					$page_content = get_post( $page_for_posts_id );
					echo wp_kses_post( $page_content->post_content );
				endif;
				?>
			</div>
			<hr>
			<p><?php esc_html_e( 'Listings of the latest articles of interest:', 'smile-web' ); ?></p>

			<div class="row">
				<div class="col-md-8 col-sm-8 col-12 mb-5 p-0">
					<?php
					// Configuración de consulta personalizada con soporte de caché.
					// Se utiliza $current_page para evitar sobreescribir la variable global $paged.
					$current_page = max( 1, get_query_var( 'paged' ) );
					$args         = array(
						'posts_per_page' => get_option( 'posts_per_page' ),
						'orderby'        => 'date',
						'order'          => 'DESC',
						'post_status'    => 'publish',
						'paged'          => $current_page,
					);

					// Definir la clave de caché para la consulta.
					$cache_key = 'smile_web_recent_posts_' . $current_page;

					// Intentar obtener los posts desde el caché.
					$recent_posts = wp_cache_get( $cache_key );

					if ( false === $recent_posts ) {
						// Ejecutar la consulta si no se encuentra en caché.
						$recent_posts = new WP_Query( $args );
						// Guardar el resultado en caché.
						wp_cache_set( $cache_key, $recent_posts );
					}

					if ( true === $recent_posts->have_posts() ) :
						?>
						<section id="posts-relacionados" class="p-0">
							<div class="row m-0">
								<?php
								// Iterar sobre los posts obtenidos.
								while ( $recent_posts->have_posts() ) :
									$recent_posts->the_post();
									?>
                                                                        <article class="blog-col col-md-6 mb-4 mx-0">
                                                                                <div class="category">
                                                                                        <?php
                                                                                        $categories = get_the_category();
                                                                                        if ( $categories ) {
                                                                                                foreach ( $categories as $category ) {
                                                                                                        printf(
                                                                                                                '<a href="%1$s">%2$s</a>',
                                                                                                                esc_url( get_category_link( $category->term_id ) ),
                                                                                                                esc_html( $category->name )
                                                                                                        );
                                                                                                }
                                                                                        }
                                                                                        ?>
                                                                                </div>
                                                                                <figure class="shadow">
                                                                                        <a href="<?php the_permalink(); ?>"
                                                                                                title="<?php echo esc_attr( get_the_title() ); ?>"
                                                                                                rel="nofollow">
                                                                                                <?php
                                                                                                // Obtener la imagen configurada en el Customizer.
                                                                                                $blog_default_image = get_theme_mod( 'blog_default_image' );

                                                                                                // Si la opción está vacía, se asigna la ruta por defecto.
                                                                                                if ( empty( $blog_default_image ) ) {
                                                                                                        $blog_default_image = get_template_directory_uri() . '/assets/img/thumbnail-header.jpg';
                                                                                                }

                                                                                                $thumb_url = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'full' ) : $blog_default_image;
                                                                                                $thumb_id  = get_post_thumbnail_id();
                                                                                                $thumb_alt = $thumb_id ? get_post_meta( $thumb_id, '_wp_attachment_image_alt', true ) : '';
                                                                                                if ( empty( $thumb_alt ) ) {
                                                                                                        $thumb_alt = get_the_title();
                                                                                                }
                                                                                                ?>

                                                                                                <img class="img-fluid"
                                                                                                        src="<?php echo esc_url( $thumb_url ); ?>"
                                                                                                        alt="<?php echo esc_attr( $thumb_alt ); ?>"
                                                                                                        title="<?php echo esc_attr( get_the_title() ); ?>"
                                                                                                        width="600"
                                                                                                        height="400">
                                                                                        </a>
                                                                                        <figcaption class="bg-white px-4">
                                                                                                <p class="text-emphasis">
                                                                                                        <a href="<?php the_permalink(); ?>"
                                                                                                                rel="bookmark"
                                                                                                                title="<?php echo esc_attr( get_the_title() ); ?>">
														<?php echo esc_html( get_the_title() ); ?>
													</a>
												</p>
												<p>
													<?php echo esc_html( wp_trim_words( get_the_excerpt(), 25, '...' ) ); ?>
												</p>
												<p class="border-top pt-3">
													<span>
														<i class="fa fa-calendar"></i>
														<?php
														if ( get_the_modified_date( 'j F, Y' ) === get_the_date( 'j F, Y' ) ) :
															?>
															<b><?php esc_html_e( 'Publicado', 'smile-web' ); ?></b>: <?php echo esc_html( get_the_modified_date( 'j F, Y' ) ); ?>.
															<?php
														else :
															?>
															<b><?php esc_html_e( 'Actualizado', 'smile-web' ); ?></b>: <?php echo esc_html( get_the_modified_date( 'j F, Y' ) ); ?>.
															<?php
														endif;
														?>
													</span>
												</p>
											</figcaption>
										</figure>
									</article>
								<?php endwhile; ?>
							</div>
						</section>
						<?php
					else :
						?>
						<p><?php esc_html_e( 'There are no articles to show at this time.', 'smile-web' ); ?></p>
					<?php endif; ?>

					<?php
					// Restaurar consulta global.
					wp_reset_postdata();
					?>
				</div>

				<aside id="secondary" class="col-md-4 col-sm-4 col-12">
					<?php get_sidebar(); ?>
				</aside>
			</div>
		</div>
	</div>
</main>
<?php get_footer(); ?>
