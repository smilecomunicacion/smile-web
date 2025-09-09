<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other 'pages' on your WordPress site may use a different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package smile-web
 */

get_header();
?>
<div id="intro" class="pt-5" style="background-color: var(--cta-bg);">
	<div class="container py-5 text-center">
		<h1 class="title mt-2"><?php the_title(); ?></h1>
		<a href="#main" class="btn-cta" rel="nofollow noopener" aria-label="<?php esc_attr_e( 'Go to main content', 'smile-web' ); ?>">
			<?php esc_html_e( 'See main content', 'smile-web' ); ?>
		</a>
	</div>
	<?php
	// If minimum width is 768px.
	if ( ! wp_is_mobile() ) :
		?>
		<figure id="intro-carousel" class="d-none d-md-block">
			<?php
			if ( has_post_thumbnail() ) :
				$attachment_id = get_post_thumbnail_id( get_the_ID() );
				$metadata      = wp_get_attachment_metadata( $attachment_id );
				$height        = $metadata['height'];
				$width         = $metadata['width'];
				$alt           = trim( wp_strip_all_tags( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ) );
				$image_title   = trim( wp_strip_all_tags( get_post_meta( $attachment_id, '_wp_attachment_image_title', true ) ) );
				$src           = wp_get_attachment_url( $attachment_id );
				$class         = 'attachment-' . $attachment_id;
				?>
				<img src="<?php echo esc_url( $src ); ?>" height="<?php echo esc_attr( $height ); ?>" width="<?php echo esc_attr( $width ); ?>" alt="<?php echo esc_attr( $alt ); ?>" title="<?php echo esc_attr( $image_title ); ?>" class="<?php echo esc_attr( $class ); ?>">
			<?php else : ?>
				<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/thumbnail-header.jpg" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" width="1000" height="667">
			<?php endif; ?>
		</figure>
	<?php endif; // END if minimum width is 768px. ?>
</div>
<main id="main" style="background-color: var(--bg-light);">
	<div class="container py-2">
		<div id="breadcrumbs">
			<nav aria-label="breadcrumb">
								<ol itemscope itemtype="https://schema.org/BreadcrumbList" class="breadcrumb" style="background-color: var(--bg-light);">
										<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="breadcrumb-item"><i class="fa fa-home"></i> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="item" title="<?php echo esc_attr( get_bloginfo( 'title' ) ); ?>"><span itemprop="name"><?php esc_html_e( 'Home', 'smile-web' ); ?></span></a>
						<meta itemprop="position" content="1">
					</li>
					<?php if ( is_page() && 0 < $post->post_parent ) : ?>
						<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="breadcrumb-item">
							<a itemscope itemtype="https://schema.org/WebPage" itemprop="item" itemid="<?php echo esc_url( get_permalink( $post->post_parent ) ); ?>" href="<?php echo esc_url( get_permalink( $post->post_parent ) ); ?>" aria-current="page">
								<span itemprop="name"><?php echo esc_html( get_the_title( $post->post_parent ) ); ?></span>
							</a>
							<meta itemprop="position" content="2">
						</li>
						<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="breadcrumb-item"><a itemprop="item" href="<?php echo esc_url( get_permalink() ); ?>" aria-current="page"><span itemprop="name"><?php the_title(); ?></span></a>
							<meta itemprop="position" content="3">
						</li>
					<?php else : ?>
						<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="breadcrumb-item"><a itemprop="item" href="<?php the_permalink(); ?>" aria-current="page"><span itemprop="name"><?php the_title(); ?></span></a>
							<meta itemprop="position" content="2">
						</li>
					<?php endif; ?>
				</ol>
			</nav>
		</div>
		<!-- Start single post. -->
		<article id="post-<?php the_ID(); ?>" class="entry-content">
			<?php
			the_content();

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'smile-web' ),
					'after'  => '</div>',
				)
			);
			?>
		</article><!-- .entry-content -->
		<?php if ( get_edit_post_link() ) : ?>
			<div class="entry-footer">
				<?php
				edit_post_link(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers. */
							__( 'Edit <span class="screen-reader-text">%s</span>', 'smile-web' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					),
					'<span class="edit-link">',
					'</span>'
				);
				?>
			</div><!-- .entry-footer -->
		<?php endif; ?>
	</div>
	<?php
	/**
	 * Related Articles with the same category or parent category.
	 */
	// Global variables.
	$blog_post_num         = get_theme_mod( 'blog_post_quantity', 3 );
	$blog_post_default_img = get_theme_mod( 'blog_default_image', '' );
	$custom_blog_title     = get_theme_mod( 'blog_title', __( 'Recent Posts', 'smile-web' ) );
	$blog_description      = get_theme_mod( 'blog_description', __( 'Discover the latest articles on our blog.', 'smile-web' ) );

	if ( is_page() && 0 < $post->post_parent ) : // If it is a subpage or child page.
		$parent_title = get_the_title( $post->post_parent );
		$category_id  = get_cat_ID( $parent_title ); // Parent category ID.
		$text_related = esc_html__( 'Related Articles with: ', 'smile-web' ) . $parent_title;
	elseif ( 0 !== get_cat_ID( $post->post_name ) ) : // If exists a category with the same name as the page.
		$category_id  = get_cat_ID( $post->post_name ); // ID of the page-category.
		$text_related = esc_html__( 'Related Articles with: ', 'smile-web' ) . $post->post_name;
	elseif ( 0 !== get_cat_ID( get_the_title() ) ) : // If exists a category with the same title as the page.
		$category_id  = get_cat_ID( get_the_title() ); // ID of the page-category.
		$text_related = esc_html__( 'Related Articles with: ', 'smile-web' ) . get_the_title();
	else :
		$category_id  = 0; // If no category exists. Display all posts.
		$blog_name    = get_bloginfo( 'description' );
		$text_related = esc_html__( 'Latest Articles: ', 'smile-web' ) . '<a href="' . esc_url( home_url( '/blog' ) ) . '">' . $blog_name . '</a>';
	endif;

	$current_post_id = get_the_ID(); // ID of the current post.
	$args            = array(
		'cat'            => $category_id, // Use category_id instead of undefined $parent_cat_id.
		'posts_per_page' => $blog_post_num, // Specify the exact number of posts.
		'post__not_in'   => array( $current_post_id ),
	);
	// If a category exists and posts exist in that category.
	if ( 0 !== $category_id && get_posts( $args ) ) :
		?>
				<section id="posts-relacionados" style="background-color: var(--bg-light);">
			<div class="container py-5">
				<h4><?php echo wp_kses_post( $text_related ); ?></h4>
				<hr>
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
									if ( has_post_thumbnail() ) :
										$attachment_id = get_post_thumbnail_id( get_the_ID() );
										$metadata      = wp_get_attachment_metadata( $attachment_id );
										$height        = $metadata['height'];
										$width         = $metadata['width'];
										$alt           = trim( wp_strip_all_tags( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ) );
										$image_title   = trim( wp_strip_all_tags( get_post_meta( $attachment_id, '_wp_attachment_image_title', true ) ) );
										$src           = wp_get_attachment_url( $attachment_id );
										?>
										<img src="<?php echo esc_url( $src ); ?>" height="<?php echo esc_attr( $height ); ?>" width="<?php echo esc_attr( $width ); ?>" alt="<?php echo esc_attr( $alt ); ?>" title="<?php echo esc_attr( $image_title ); ?>">
									<?php else : ?>
										<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/thumbnail-header.jpg" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" width="1000" height="667">
									<?php endif; ?>
								</a>
								<figcaption id="post-<?php the_ID(); ?>" class="p-4">
									<h4><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( get_the_title() ); ?>"><?php the_title(); ?></a></h4>
									<p><?php the_excerpt(); ?></p>
									<hr>
									<p>
										<?php
										if ( get_the_modified_date( 'j F, Y' ) === get_the_date( 'j F, Y' ) ) :
											?>
											<span><b><?php esc_html_e( 'Published', 'smile-web' ); ?></b>: <?php the_modified_date( 'j F, Y' ); ?></span>
										<?php else : ?>
											<span><b><?php esc_html_e( 'Updated', 'smile-web' ); ?></b>: <?php the_modified_date( 'j F, Y' ); ?></span>
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
	<?php endif; // End Related Articles. ?>
</main>
<?php get_footer(); ?>
