<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#404-not-found
 * @package smile-web
 */

get_header();
?>

<div id="main" class="error-404 not-found">
	<div class="container">
		<div class="row">
			<!-- Main content -->
			<div class="col-md-8 col-sm-8 col-12">
				<div class="error-page text-center py-5">
					<h1 class="display-4">404</h1>
					<h2 class="mb-4"><?php esc_html_e( 'Oops! That page can’t be found.', 'smile-web' ); ?></h2>
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or go back to the homepage.', 'smile-web' ); ?></p>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-cta mt-4"><?php esc_html_e( 'Go to Homepage', 'smile-web' ); ?></a>
				</div>

				<!-- Show latest articles -->
				<?php
				$recent_posts_args = array(
					'posts_per_page' => 12,
					'orderby'        => 'date',
					'order'          => 'DESC',
					'post_status'    => 'publish',
				);

				$recent_posts = new WP_Query( $recent_posts_args );

				if ( $recent_posts->have_posts() ) :
					?>
					<section id="recent-posts" class="mt-5">
						<h3><?php esc_html_e( 'Latest Articles', 'smile-web' ); ?></h3>
						<div class="row">
							<?php
							while ( $recent_posts->have_posts() ) :
								$recent_posts->the_post();
								?>
                                                                <article class="col-md-6 mb-4">
                                                                        <figure class="shadow">
                                                                                <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
                                                                                        <img class="img-fluid" src="<?php echo has_post_thumbnail() ? esc_url( get_the_post_thumbnail_url() ) : esc_url( get_template_directory_uri() . '/assets/img/thumbnail-header.jpg' ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" width="600" height="400">
                                                                                </a>
                                                                                <figcaption class="bg-white px-4">
                                                                                        <p class="lead">
                                                                                                <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( get_the_title() ); ?>"><?php the_title(); ?></a>
                                                                                        </p>
                                                                                        <p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 20, '...' ) ); ?></p>
                                                                                </figcaption>
                                                                        </figure>
                                                                </article>
								<?php
							endwhile;
							?>
						</div>
					</section>
					<?php
				endif;

				// Restaurar la consulta global.
				wp_reset_postdata();
				?>
			</div>

			<!-- Sidebar -->
			<aside id="secondary" class="col-md-4 col-sm-4 col-12">
				<?php get_sidebar(); ?>
			</aside>
		</div>
	</div>
</div>

<?php
get_footer();
?>
