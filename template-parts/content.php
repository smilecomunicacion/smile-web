<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package smile-web
 */

?>
<!-- Post Social Share -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div>
        <?php
	if ( is_single() ) :
		?>
        <?php
	elseif ( is_home() ) :
		smile_v5_post_thumbnail();

			the_title( '<h2><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		else :
			?>
        <article class="blog-col col-lg-6 mb-4 mx-0">
            <figure class="mb-0 shadow"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"
                    rel="nofollow"><img class="img-fluid" src="<?php the_post_thumbnail_url(); ?>"
                        alt="<?php $thumb_alt; ?>"></a>
                <figcaption id="post-<?php the_ID(); ?>" class="p-4">
                    <h4><a href="<?php the_permalink(); ?>" rel="bookmark"
                            title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
                    <p><?php the_excerpt(); ?></p>
                    <hr>
                    <p><?php if ( ( get_the_modified_date( 'j F, Y' ) ) === ( get_the_date( 'j F, Y' ) ) ) { ?>
                        <span><i class="fa fa-calendar"> </i> <b><?php esc_html_e( 'Published', 'smile-web' ); ?></b>:
                            <?php the_modified_date( 'j F, Y' ); ?></span>
                        <?php } else { ?>
                        <span><i class="fa fa-calendar"> </i> <b><?php esc_html_e( 'Updated', 'smile-web' ); ?></b>:
                            <?php the_modified_date( 'j F, Y' ); ?></span>
                        <?php } ?>
                    </p>
                </figcaption>
            </figure>

        </article>


        <?php endif; ?>
    </div><!-- .entry-header -->

    <div class="entry-content row">

        <?php
	// funcion que muestra el contenido del post .. excerpt para index y todo para single(singular).
	the_content(
		sprintf(
			wp_kses(
			/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'smile-web' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		)
	);

	wp_link_pages(
		array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'smile-web' ),
			'after'  => '</div>',
		)
	);
	?>
    </div><!-- .entry-content -->
</article>