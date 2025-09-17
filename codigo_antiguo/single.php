<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package smile-web
 */

get_header();
?>
<div id="intro" class="pt-5" style="background-color: var(--single-intro-bg);">
	<div class="container py-3">
		<div class="row text-center py-2">
			<h1 class="text-heading my-2"><?php the_title(); ?></h1>
			<div class="entry-header d-flex justify-content-center">
				<?php if ( is_single() ) : ?>
				<span>
					<?php
						// Show the date the post was published or updated.
						if ( get_the_modified_date( 'j F, Y' ) === get_the_date( 'j F, Y' ) ) :
							?>
					<b><?php esc_html_e( 'Published', 'smile-web' ); ?></b>: <?php echo get_the_date( 'j F, Y' ); ?> |
					<?php else : ?>
					<b><?php esc_html_e( 'Updated', 'smile-web' ); ?></b>: <?php echo esc_html( get_the_modified_date( 'j F, Y' ) ); ?> |
					<?php endif; ?>
				</span>

				<?php
					// Get the post categories.
					$categories = get_the_category();

					if ( ! empty( $categories ) ) {
						// Filter the categories to exclude the "Uncategorized" category.
						$filtered_categories = array_filter(
							$categories,
							function ( $category ) {
								return 'uncategorized' !== $category->slug;
							}
						);

						if ( ! empty( $filtered_categories ) ) {
							echo '<ul class="post-categories">';
							foreach ( $filtered_categories as $category ) {
								echo '<li>' . esc_html( $category->name ) . '</li>';
							}
							echo '</ul>';
						} else {
							// Show "Uncategorized" if there are no categories.
							echo '<span>' . esc_html__( 'Uncategorized', 'smile-web' ) . '</span>';
						}
					} else {
						// Show "Uncategorized" if there are no categories.
						echo '<span>' . esc_html__( 'Uncategorized', 'smile-web' ) . '</span>';
					}
					?>

				<?php if ( get_comments_number() > 0 ) : ?>
				<span> |
					<?php
							// SVG icon for comments.
														$comment_svg = '
                                                        <svg class="comment-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="20" height="20">
								<path d="M256 32C114.6 32 0 125.1 0 240c0 49.5 21.4 94.9 57.1 131.5-12.2 50.7-54.3 95.3-55 95.9C0 470.8-.5 471.3.3 472.6c.9 1.3 2.1 1.4 3.2 1.4 66.3 0 117.1-31.4 139.8-46.7 33.1 9.4 69 14.7 112.7 14.7 141.4 0 256-93.1 256-208S397.4 32 256 32z"/>
							</svg>';
							echo '<span class="svg-icon">' . wp_kses_post( $comment_svg ) . '</span>';
							esc_html_e( 'Comments', 'smile-web' );
							?>
					<a href="#comments" class="comment-count"><?php echo esc_html( get_comments_number() ); ?></a>
				</span>
				<?php endif; ?>
				<?php endif; ?>
			</div><!-- .entry-header -->
			<?php
			// Obtener el contenido del post.
			$content = get_post_field( 'post_content', get_the_ID() );

			// Contar las palabras del contenido.
						$word_count = str_word_count( wp_strip_all_tags( $content ) );

			// Definir la velocidad de lectura promedio (250 palabras por minuto).
			$reading_speed = 250;

			// Calcular el tiempo estimado de lectura en minutos.
			$reading_time = ceil( $word_count / $reading_speed );

			// Mostrar el tiempo estimado de lectura.
			echo '<p class="reading-time"><b>' . esc_html__( 'Reading time:', 'smile-web' ) . '</b> ' . esc_html( $reading_time ) . ' min</p>';
			?>
		</div>
	</div>
</div><!-- #intro -->
<main id="main" class="blog-page bg-primary">
	<div class="container py-4">
		<div id="breadcrumbs">
			<nav aria-label="breadcrumb" style="background-color: var(--breadcrumb-bg);">
				<ol itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumb">
					<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="breadcrumb-item">
						<img class='mx-2' src="<?php echo esc_url( get_template_directory_uri() ); ?>/lib/fontawesome-free/svgs/solid/home.svg" alt="home" title="<?php esc_attr_e( 'Home', 'smile-web' ); ?>
						" width="20px" height="20px">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"><span><?php esc_html_e( 'Home', 'smile-web' ); ?></span></a>
						<meta itemprop="position" content="1" />
					</li>
					<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="breadcrumb-item">
						<?php
						$categories = get_the_category();
						foreach ( $categories as $category ) {
								echo '<a itemid="' . esc_attr( $category->cat_name ) . '" href="' . esc_url( get_category_link( $category->term_id ) ) . '"><span>' . esc_html( $category->cat_name ) . '</span></a>';
						}
						?>
						<meta itemprop="position" content="2" />
					</li>
					<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="breadcrumb-item"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a>
					</li>
				</ol>
			</nav>
		</div>
		<div class="row">
			<!-- Start single post -->
			<div id="about" class="col-lg-8 col-md-8 pb-4">
				<?php
				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/content', get_post_type() );
					?>
				<br>
				<hr>
				<!--Share Social Media -->
				<div class="share-social-media">
					<p><span><?php esc_html_e( 'Share:', 'smile-web' ); ?></span>
						<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url( get_the_permalink() ); ?>" target="_blank" rel="noopener noreferrer">

							<img class='mx-2' src="<?php echo esc_url( get_template_directory_uri() ); ?>/lib/fontawesome-free/svgs/brands/facebook.svg" alt="<?php esc_attr_e( 'Facebook', 'smile-web' ); ?>" title="<?php esc_attr_e( 'Share on Facebook', 'smile-web' ); ?>" width="20px" height="20px">

						</a> <a href="https://twitter.com/intent/tweet?url=<?php echo esc_url( get_the_permalink() ); ?>" target="_blank" rel="noopener noreferrer">
							<img class='mx-2' src="<?php echo esc_url( get_template_directory_uri() ); ?>/lib/fontawesome-free/svgs/brands/twitter.svg" alt="<?php esc_attr_e( 'Twitter', 'smile-web' ); ?>" title="<?php esc_attr_e( 'Share on Twitter', 'smile-web' ); ?>" width="20px" height="20px">
						</a>
						<a href="https://www.linkedin.com/cws/share?url=<?php echo esc_url( get_the_permalink() ); ?>" target="_blank" rel="noopener noreferrer">
							<img class='mx-2' src="<?php echo esc_url( get_template_directory_uri() ); ?>/lib/fontawesome-free/svgs/brands/linkedin.svg" alt="<?php esc_attr_e( 'LinkedIn', 'smile-web' ); ?>" title="<?php esc_attr_e( 'Share on LinkedIn', 'smile-web' ); ?>" width="20px" height="20px">
						</a>
						<a href="https://pinterest.com/pin/create/button/?url=<?php echo esc_url( get_the_permalink() ); ?>" target="_blank" rel="noopener noreferrer">
							<img class='mx-2' src="<?php echo esc_url( get_template_directory_uri() ); ?>/lib/fontawesome-free/svgs/brands/pinterest.svg" alt="<?php esc_attr_e( 'Pinterest', 'smile-web' ); ?>" title="<?php esc_attr_e( 'Share on Pinterest', 'smile-web' ); ?>" width="20px" height="20px">
						</a>
					</p>
				</div>
				<!--FIN Share Social Media -->
				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
				?>
				<br>
			</div>
			<!-- End Left Article -->
			<aside id="secondary" class="col-lg-4 col-md-4 widget-area">
				<?php get_sidebar(); ?>
			</aside>
		</div>
	</div>
	<?php get_template_part( 'template-parts/cta' ); ?>
	<!-- #call-to-action -->
	<?php
		/* if is sinlge && are posts */

	if ( is_single() ) {
		$categories = get_the_category();
		if ( ! empty( $categories ) ) {
			$category_id = $categories[0]->term_id; // ID first category.
		} else {
			$category_id = 0; // If there are no categories, then the ID is 0.
		}

			$current_post_id = get_the_ID();
			$args            = array(
				'cat'            => $category_id,
				'posts_per_page' => 12, // The number of related posts you want to show.
				'post__not_in'   => array( $current_post_id ),
			);
			?>
	<section id="posts-relacionados" class="bg-secondary">
		<div class="container py-5">
			<p class="text-emphasis col-md-12 mb-5 border-bottom"><?php echo esc_html__( 'Related articles', 'smile-web' ); ?>
				<?php
			$categories = get_the_category();
			foreach ( $categories as $category ) {
				echo '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->cat_name ) . '</a>';}
			?>
			</p>
			<br>
			<div class="row">
				<?php
				$recent = new WP_Query( $args );
				while ( $recent->have_posts() ) :
					$recent->the_post();
					?>
				<article class="blog-col col-md-4 col-sm-6 mb-4 mx-0">
					<figure class="mb-0 shadow">
						<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="nofollow">
							<?php
								if ( has_post_thumbnail() ) {
									$attachment_id = get_post_thumbnail_id( get_the_ID() );
									$metadata      = wp_get_attachment_metadata( $attachment_id );
									$height        = $metadata['height'];
									$width         = $metadata['width'];
									$alt           = trim( wp_strip_all_tags( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ) );
									$image_title   = trim( wp_strip_all_tags( get_post_meta( $attachment_id, '_wp_attachment_image_title', true ) ) );
									$src           = wp_get_attachment_url( $attachment_id );
									echo '<img src="' . esc_url( $src ) . '" height="' . esc_attr( $height ) . '" width="' . esc_attr( $width ) . '" alt="' . esc_attr( $alt ) . '" title="' . esc_attr( $image_title ) . '">';
								} else {
									?>
							<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/thumbnail-article.jpg" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" width="1000px" height="667px">
							<?php
								}
								?>
						</a>
						<figcaption id="post-<?php the_ID(); ?>" class="p-4">
							<h4><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( get_the_title() ); ?>"><?php the_title(); ?></a></h4>
							<p><?php the_excerpt(); ?></p>
							<hr>
							<p>
								<?php if ( get_the_modified_date( 'j F, Y' ) === get_the_date( 'j F, Y' ) ) : ?>
								<span><b><?php esc_html_e( 'Published', 'smile-web' ); ?></b>: <?php the_modified_date( 'j F, Y' ); ?>
								</span>

								<?php else : ?>
								<span><b><?php esc_html_e( 'Updated', 'smile-web' ); ?></b>: <?php the_modified_date( 'j F, Y' ); ?>
								</span>
								<?php endif; ?>
							</p>
						</figcaption>
					</figure>
				</article>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			</div>
		</div>
	</section>
	<?php } ?>
</main>
<?php get_footer(); ?>