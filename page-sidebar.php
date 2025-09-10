<?php
/** Template Name: Page sidebar
 *
 * @package SMiLE_Web_Theme
 */

get_header();
?>
<div id="intro" class="carousel slide height-archive">
</div><!-- #intro -->
<main id="main" class="blog-page area-padding bg-light2">
	<div class="container">
		<div class="row">
			<div id="breadcrumbs">
				<nav aria-label="breadcrumb">
                                                                               <ol itemscope itemtype="https://schema.org/BreadcrumbList" class="breadcrumb bg-light2">
												<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="breadcrumb-item"><i class="fa fa-home"></i><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="item" title="<?php echo esc_attr( get_bloginfo( 'title' ) ); ?>"><span itemprop="name"><?php esc_html_e( 'Home', 'smile-web' ); ?></span></a>
							<meta itemprop="position" content="1" />
						</li>
						<?php if ( $post->post_parent ) { ?>
							<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="breadcrumb-item">
								<a itemscope itemtype="https://schema.org/WebPage" itemprop="item" itemid="<?php echo esc_url( get_permalink( $post->post_parent ) ); ?>" href="<?php echo esc_url( get_permalink( $post->post_parent ) ); ?>">
									<span itemprop="name"><?php echo esc_html( get_the_title( $post->post_parent ) ); ?></span>
								</a>
								<meta itemprop="position" content="2" />
							</li>
							<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="breadcrumb-item"><a itemprop="item" href="<?php the_permalink(); ?>"><span itemprop="name"><?php the_title(); ?></span></a>
								<meta itemprop="position" content="3" />
							</li>
						<?php } else { ?>
							<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="breadcrumb-item"><a itemprop="item" href="<?php the_permalink(); ?>"><span itemprop="name"><?php the_title(); ?></span></a>
								<meta itemprop="position" content="2" />
							</li>
						<?php } ?>
					</ol>
				</nav>
			</div>
		</div>
		<div class="row">
			<!-- Start single post -->
			<article id="post-<?php the_ID(); ?>" class="entry-content col-md-8">
                                <h1 class="text-heading"><?php the_title(); ?></h1>
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

			<!-- End Left Article -->
			<aside id="secondary" class="col-lg-4 col-md-4 col-sm-12 col-xs-12 widget-area">
				<?php get_sidebar(); ?>
			</aside>

			<?php the_post_navigation(); ?>

			<?php if ( get_edit_post_link() ) : ?>
				<div class="entry-footer col-md-12">
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
		</div> <!-- END .row -->
	</div> <!--  END .container -->

	<!-- Related posts -->
	<?php
	if ( is_page() && $post->post_parent ) {
		$parent_title  = get_the_title( $post->post_parent );
		$parent_cat_id = get_cat_ID( $parent_title );
		// translators: %s: Parent title.
		$text_related = sprintf( esc_html__( 'Articles related with parent: %s', 'smile-web' ), $parent_title );

	} elseif ( get_cat_ID( $post->post_name ) ) {
		$page_cat_id = get_cat_ID( $post->post_name );
		// translators: %s: Post name.
		$text_related = sprintf( esc_html__( 'Articles related with post name: %s', 'smile-web' ), $post->post_name );
	} elseif ( get_cat_ID( get_the_title() ) ) {
		$title_cat_id = get_cat_ID( get_the_title() );
				// translators: %s: Title of the current post.
				$text_related = sprintf( esc_html__( 'Articles related with title: %s', 'smile-web' ), get_the_title() );
	} else {
		$categories = get_the_category();
		if ( ! empty( $categories ) ) {
			$first_cat_id = $categories[0]->term_id;
		} else {
			$default_cat = 0;
		}
		$blog_name    = get_bloginfo( 'description' );
		$text_related = sprintf(
			// translators: %s: Last articles.
			esc_html__( 'Last articles: %s', 'smile-web' ),
			'<a href="' . esc_url( home_url( '/blog' ) ) . '">' . esc_html( $blog_name ) . '</a>'
		);
	}

	$current_post_id = get_the_ID();
	$args            = array(
		'cat'            => isset( $parent_cat_id ) ? $parent_cat_id : ( isset( $page_cat_id ) ? $page_cat_id : ( isset( $title_cat_id ) ? $title_cat_id : ( isset( $first_cat_id ) ? $first_cat_id : 0 ) ) ),
		'posts_per_page' => 12, // Number of posts to display.
		'post__not_in'   => array( $current_post_id ), // Exclude current post.
	);
	?>
	<section id="posts-relacionados">
		<div class="container py-5">
			<div class="row">
				<h4><?php echo esc_html( $text_related ); ?></h4>
				<hr>
				<?php
				$recent = new WP_Query( $args );
				while ( $recent->have_posts() ) :
					$recent->the_post();
					?>
					<article class="blog-col col-md-4 col-sm-6 mb-4 mx-0">
												<figure class="mb-0 shadow"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="nofollow">
														<?php
														$thumb_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
														$thumb_id  = get_post_thumbnail_id();
														$thumb_alt = $thumb_id ? get_post_meta( $thumb_id, '_wp_attachment_image_alt', true ) : '';
														if ( empty( $thumb_alt ) ) {
																$thumb_alt = get_the_title();
														}
														?>
														<img class="img-fluid" src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php echo esc_attr( $thumb_alt ); ?>">
												</a>
                                                                                                <figcaption id="post-<?php the_ID(); ?>" class="p-4 figcaption-text">
														<h4><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( get_the_title() ); ?>"><?php the_title(); ?></a></h4>
														<p><?php the_excerpt(); ?></p>
														<hr>
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
	</section><!-- End Related posts -->
</main>
<?php get_footer(); ?>
