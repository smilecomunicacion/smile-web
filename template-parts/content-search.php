<?php
/**
 * Template part for displaying results in search pages.
 *
 * This template displays each search result item with a featured image.
 * If a post does not have a featured image, it falls back to the Customizer option
 * 'blog_default_image'. If that option is empty, it uses the default image located in /assets/img/thumbnail-header.jpg.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package smile-web
 */

?>

<article id="post-<?php the_ID(); ?>" class="row bg-white shadow mx-0 mb-4">
	<figure class="fit-figure p-0 m-0 col-md-4">
		<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="nofollow">
			<?php
			if ( has_post_thumbnail() ) : // Check if the post has a featured image.
				$attachment_id = get_post_thumbnail_id( get_the_ID() );
				$metadata      = wp_get_attachment_metadata( $attachment_id );
				// Ensure metadata is available; otherwise, assign empty values.
				if ( is_array( $metadata ) && ! empty( $metadata ) ) :
					$height = ! empty( $metadata['height'] ) ? $metadata['height'] : '';
					$width  = ! empty( $metadata['width'] ) ? $metadata['width'] : '';
				else :
					$height = $width = '';
				endif;
				$alt         = trim( wp_strip_all_tags( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ) );
				$image_title = trim( wp_strip_all_tags( get_post_meta( $attachment_id, '_wp_attachment_image_title', true ) ) );
				$src         = wp_get_attachment_url( $attachment_id );
				$class       = 'attachment-' . $attachment_id;

				echo '<img src="' . esc_url( $src ) . '" height="' . esc_attr( $height ) . '" width="' . esc_attr( $width ) . '" alt="' . esc_attr( $alt ) . '" title="' . esc_attr( $image_title ) . '" class="img-fluid ' . esc_attr( $class ) . '">';
			else :
				// Get the default blog image from the Customizer.
				$blog_default_image = get_theme_mod( 'blog_default_image' );
				// Check using Yoda condition; if the image from the Customizer is not empty, use it. Otherwise, use the fallback image.
				$fallback_image = '' !== $blog_default_image ? $blog_default_image : get_template_directory_uri() . '/assets/img/thumbnail-header.jpg';
				?>
				<img class="img-fluid"
					src="<?php echo esc_url( $fallback_image ); ?>"
					alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
					title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
					width="1000"
					height="667">
				<?php
			endif;
			?>
		</a>
	</figure>
	<div id="post-<?php the_ID(); ?>" class="col-md-8 p-4">
		<h3>
			<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( get_the_title() ); ?>">
				<?php the_title(); ?>
			</a>
		</h3>
		<p><?php the_excerpt(); ?></p>
	</div>
</article>
