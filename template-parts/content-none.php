<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package smile-web
 */

?>
<section class="no-results not-found">
<h2 class="display-4"><?php esc_html_e( 'No hay resultados', 'smile-web' ); ?></h2>

	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :
			printf(
				'<p>' . wp_kses(
					/* translators: 1: link to WP admin new post page. */
					__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'smile-web' ),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				) . '</p>',
				esc_url( admin_url( 'post-new.php' ) )
			);

		elseif ( is_search() ) :
			?>
			<div>
				<h3><?php esc_html_e( 'Sorry, but no results match your search terms.', 'smile-web' ); ?></h3>
			</div>
			<br><hr>

		<!-- Related articles -->
			<?php
			$categories = get_the_category(); // Obtains the categories of the current post.
			if ( ! empty( $categories ) ) {
				$category_id = $categories[0]->term_id; // ID of the first category.
			} else {
				$category_id = 0; // If there are no categories, the ID is 0.
			}

			$current_post_id = get_the_ID(); // ID of the current post.
			$args            = array(
				'cat'          => $category_id, // Category ID.
				'post__not_in' => array( $current_post_id ), // Exclude the current post.
			);

			?>
			<?php
			$recent = new WP_Query( $args );
			if ( $recent->have_posts() ) {
				?>
				<div class="my-3">
					<h4><?php esc_html_e( 'Recommended Blog Articles', 'smile-web' ); ?></h4>
				</div>
				<div class="row">
				<?php
			}
			while ( $recent->have_posts() ) :
				$recent->the_post();
				?>
                                <article class="blog-col col-md-6 mb-4 mx-0">
                                        <div class="category shadow rounded">
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
                                                <figcaption id="post-<?php the_ID(); ?>" class="p-4">
							<h4><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( get_the_title() ); ?>"><?php the_title(); ?></a></h4>
							<p><?php the_excerpt(); ?></p>
							<hr>
							<p><?php if ( ( get_the_modified_date( 'j F, Y' ) ) === ( get_the_date( 'j F, Y' ) ) ) { ?>
								<span>
									<i class="fa fa-calendar"> </i>
									<b><?php esc_html_e( 'Published', 'smile-web' ); ?></b>: <?php the_modified_date( 'j F, Y' ); ?>
								</span>
								<?php } else { ?>
									<span>
										<i class="fa fa-calendar"> </i>
										<b><?php esc_html_e( 'Updated', 'smile-web' ); ?></b>: <?php the_modified_date( 'j F, Y' ); ?>
									</span>
								<?php } ?>
							</p>
						</figcaption>
					</figure>

				</article>
			<?php endwhile; ?>

			<?php if ( $recent->have_posts() ) { ?>
		</div>
		<?php } ?>
			<?php wp_reset_postdata(); ?>
		<!-- End related articles -->
			<?php else : ?>
			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'smile-web' ); ?></p>
				<?php
				get_search_form();
		endif;
			?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
