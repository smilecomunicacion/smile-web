<?php
/**
 * The main template file for the front page.
 *
 * Displays the header, content, and footer when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package smile-web
 */

get_header();

// ------------------------------------------------------------------
// Global options.
// ------------------------------------------------------------------
$blog_post_num         = get_theme_mod( 'blog_post_quantity', 3 );
$blog_post_default_img = get_theme_mod( 'blog_default_image', '' );
$custom_blog_title     = get_theme_mod( 'blog_title', __( 'Recent Posts', 'smile-web' ) );
$blog_description      = get_theme_mod( 'blog_description', __( 'Discover the latest articles on our blog.', 'smile-web' ) );

// ------------------------------------------------------------------
// Header image.
// ------------------------------------------------------------------
$show_header_image = get_theme_mod( 'header_image_display', 'yes' );
$header_image      = get_header_image();

$intro_style = '';
if ( 'yes' === $show_header_image && ! empty( $header_image ) ) {
	$intro_style = sprintf(
		'background-image: url(\'%s\'); background-size: cover; background-position: center; background-repeat: no-repeat;',
		esc_url( $header_image )
	);
}
?>

<!-- Intro -------------------------------------------------------- -->
<div id="intro" style="<?php echo esc_attr( $intro_style ); ?>">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h1 class="title"><?php the_title(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h1>
				<?php the_excerpt(); ?>
			</div>
		</div>
	</div>
</div>

<!-- Main Content ------------------------------------------------- -->
<main id="main" class="overflow-hidden">
	<div class="container">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="mb-5">
				<?php
				the_content();

				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'smile-web' ),
						'after'  => '</div>',
					)
				);
				?>
			</div>
		</article>
	</div>

	<?php
	/*
	* ------------------------------------------------------------------
	* Related Posts
	* ------------------------------------------------------------------
	*/
	$args = array(
		'posts_per_page' => $blog_post_num,
		'post_status'    => 'publish',
		'no_found_rows'  => true,
		'post__not_in'   => array( get_the_ID() ),
	);

	$recent_posts = new WP_Query( $args );

	if ( $recent_posts->have_posts() ) :
		?>
		<section id="posts-relacionados" class="bg-light2">
			<div class="container py-5 text-center">
				<p class="lead pb-2 border-bottom">
					<?php echo esc_html( $custom_blog_title ); ?>
				</p>
				<p class="lead">
					<?php echo esc_html( $blog_description ); ?>
				</p>
			</div>

			<div class="container">
				<div class="row">
					<?php
					while ( $recent_posts->have_posts() ) :
						$recent_posts->the_post();
						?>
						<article <?php post_class( 'blog-col col-md-4 mb-4 mx-0' ); ?>>
							<div class="category">
								<?php the_category(); ?>
							</div>

							<figure class="shadow">
								<a
									href="<?php the_permalink(); ?>"
									title="<?php echo esc_attr( get_the_title() ); ?>"
									rel="nofollow"
								>
									<?php
									if ( has_post_thumbnail() ) {
										the_post_thumbnail(
											'medium',
											array(
												'class' => 'img-fluid',
												'alt'   => esc_attr( get_the_title() ),
											)
										);
									} elseif ( ! empty( $blog_post_default_img ) ) {
										// Default image set in the Customizer.
										printf(
											'<img src="%1$s" class="img-fluid" alt="%2$s" width="1000" height="667" />',
											esc_url( $blog_post_default_img ),
											esc_attr( get_bloginfo( 'name' ) )
										);
									} else {
										// Fallback to theme asset.
										printf(
											'<img src="%1$s/assets/img/thumbnail-header.jpg" class="img-fluid" alt="%2$s" width="1000" height="667" />',
											esc_url( get_template_directory_uri() ),
											esc_attr( get_bloginfo( 'name' ) )
										);
									}
									?>
								</a>

								<figcaption class="bg-white px-4">
									<p class="lead">
										<a href="<?php the_permalink(); ?>" rel="bookmark">
											<?php the_title(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
										</a>
									</p>

									<?php the_excerpt(); ?>

									<p class="border-top pt-3">
										<span>
											<?php if ( get_the_modified_date() === get_the_date() ) : ?>
												<b><?php esc_html_e( 'Published:', 'smile-web' ); ?></b>
												<?php echo esc_html( get_the_date( 'j F, Y' ) ); ?>
											<?php else : ?>
												<b><?php esc_html_e( 'Updated:', 'smile-web' ); ?></b>
												<?php echo esc_html( get_the_modified_date( 'j F, Y' ) ); ?>
											<?php endif; ?>
										</span>
									</p>
								</figcaption>
							</figure>
						</article>
					<?php endwhile; ?>
				</div>
			</div>
		</section>
		<?php
		wp_reset_postdata();
	endif;
	?>
</main>

<?php
get_footer();
