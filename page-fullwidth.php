<?php
/**
 * Template Name: Page fullwith
 *
 * @package SMiLE_Web_Theme
 */

get_header();
?>
<div id="intro" class="pt-5 bg-cta">
	<div class="container py-5 text-center">
                <h1 class="text-heading mt-2"><?php the_title(); ?></h1>
		<a href="#main" class="btn-cta" rel="nofollow noopener" aria-label="<?php esc_attr_e( 'Go to main content', 'smile-web' ); ?>">
			<?php esc_html_e( 'See main content', 'smile-web' ); ?>
		</a>
	</div>
</div>

<main id="main" class="blog-page area-padding">
<div class="cpy-2">
	<div class="container">
		<div id="breadcrumbs">
			<nav aria-label="breadcrumb">
                                <ol itemscope itemtype="https://schema.org/BreadcrumbList" class="breadcrumb bg-light">
										<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="breadcrumb-item"><i class="fa fa-home"></i> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="item" title="<?php echo esc_attr( get_bloginfo( 'title' ) ); ?>"><span itemprop="name"><?php esc_html_e( 'Home', 'smile-web' ); ?></span></a><meta itemprop="position" content="1" />
					</li>
					<?php if ( $post->post_parent ) { ?>
					<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="breadcrumb-item">
						<a itemscope itemtype="https://schema.org/WebPage"
						itemprop="item" itemid="<?php echo esc_url( get_permalink( $post->post_parent ) ); ?>" href="<?php echo esc_url( get_permalink( $post->post_parent ) ); ?>">
						<span itemprop="name"><?php echo esc_html( get_the_title( $post->post_parent ) ); ?></span>
					</a><meta itemprop="position" content="2" />
					</li>
					<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="breadcrumb-item"><a itemprop="item" href="<?php the_permalink(); ?>"><span itemprop="name"><?php the_title(); ?></span></a><meta itemprop="position" content="3" />
					</li>
				<?php } else { ?>
					<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="breadcrumb-item"><a itemprop="item" href="<?php the_permalink(); ?>"><span itemprop="name"><?php the_title(); ?></span></a><meta itemprop="position" content="2" />
					</li>
					<?php } ?>
				</ol>
			</nav>
		</div>

	</div>
	<!-- Start single post -->
	<article id="post-<?php the_ID(); ?>" class="entry-content row">
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
						/* translators: %s: Name of current post. Only visible to screen readers */
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
	/* Related Articles */

if ( is_page() && $post->post_parent ) {
	$parent_title = get_the_title( $post->post_parent );
	$category_id  = get_cat_ID( $parent_title );
	$text_related = esc_html__( 'Related Articles with: ', 'smile-web' ) . $parent_title;
} elseif ( get_cat_ID( $post->post_name ) ) {
	$category_id  = get_cat_ID( $post->post_name );
	$text_related = esc_html__( 'Related Articles with: ', 'smile-web' ) . $post->post_name;
} elseif ( get_cat_ID( get_the_title() ) ) {
	$category_id  = get_cat_ID( get_the_title() );
	$text_related = esc_html__( 'Related Articles with: ', 'smile-web' ) . get_the_title();
} else {
	$category_id  = 0;
	$blog_name    = get_bloginfo( 'description' );
	$text_related = esc_html__( 'Latest Articles: ', 'smile-web' ) . '<a href="' . esc_url( home_url( '/blog' ) ) . '">' . $blog_name . '</a>';
}

	$current_post_id = get_the_ID();
	$args            = array(
		'cat'          => $category_id,
		'showposts'    => 12,
		'post__not_in' => array( $current_post_id ),
	);

	if ( 0 !== $cat && get_posts( $args ) ) {
		?>
<section id="posts-relacionados" class="bg-light">
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
				<figure class="mb-0 shadow"><a href="<?php the_permalink(); ?>"  title="<?php echo esc_attr( get_the_title() ); ?>"  rel="nofollow">
							<?php
							if ( has_post_thumbnail() ) {
								$attachment_id = get_post_thumbnail_id( get_the_ID() );
								$metadata      = wp_get_attachment_metadata( $attachment_id );
								$height        = $metadata['height'];
								$width         = $metadata['width'];
								$alt           = trim( wp_strip_all_tags( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ) );
								$image_title   = trim( wp_strip_all_tags( get_post_meta( $attachment_id, '_wp_attachment_image_title', true ) ) );
								$src           = wp_get_attachment_url( $attachment_id );
								echo '
										<img src="' . esc_url( $src ) . '" height="' . esc_attr( $height ) . '" width="' . esc_attr( $width ) . '" alt="' . esc_attr( $alt ) . '" title="' . esc_attr( $image_title ) . '">
									';
							} else {
								?>
								<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/thumbnail-header.jpg" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" width="1000px" height="667px">
								<?php
							}
							?>
							</a>
					<figcaption id="post-<?php the_ID(); ?>" class="p-4"><h4><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( get_the_title() ); ?>"><?php the_title(); ?></a></h4><p><?php the_excerpt(); ?></p><hr>
					<p><?php if ( ( get_the_modified_date( 'j F, Y' ) ) === ( get_the_date( 'j F, Y' ) ) ) { ?>
						<span><b><?php esc_html_e( 'Published', 'smile-web' ); ?></b>: <?php the_modified_date( 'j F, Y' ); ?></span>
					<?php } else { ?>
						<span><b><?php esc_html_e( 'Updated', 'smile-web' ); ?></b>: <?php the_modified_date( 'j F, Y' ); ?></span>
					<?php } ?>
					</p>
					</figcaption>
				</figure>
			</article>
		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>
	</div>
	</div>
</section>
	<?php } ?> <!-- End Related posts -->
</main>
<?php get_footer(); ?>
