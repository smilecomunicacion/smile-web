<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package smile-web
 */

if ( ! class_exists( 'Smile_Web_Walker_Comment' ) ) {
        /**
         * Custom comment walker to adjust comment meta layout.
         */
        class Smile_Web_Walker_Comment extends Walker_Comment {
                /**
                 * Outputs a comment in the HTML5 format.
                 *
                 * @param WP_Comment $comment Comment to display.
                 * @param int        $depth   Depth of the current comment.
                 * @param array      $args    An array of arguments.
                 */
                protected function html5_comment( $comment, $depth, $args ) {
                        $tag = ( 'div' === $args['style'] ) ? 'div' : 'li';

                        $commenter          = wp_get_current_commenter();
                        $show_pending_links = ! empty( $commenter['comment_author'] );

                        if ( $commenter['comment_author_email'] ) {
                                $moderation_note = __( 'Your comment is awaiting moderation.', 'smile-web' );
                        } else {
                                $moderation_note = __( 'Your comment is awaiting moderation. This is a preview; your comment will be visible after it has been approved.', 'smile-web' );
                        }
                        ?>
                        <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'parent' : '', $comment ); ?>>
                                <article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
                                        <footer class="comment-meta">
                                                <div class="comment-metadata">
                                                        <?php
                                                        printf(
                                                                '<a href="%s"><time datetime="%s">%s</time></a>',
                                                                esc_url( get_comment_link( $comment, $args ) ),
                                                                get_comment_time( 'c' ),
                                                                sprintf(
                                                                        /* translators: 1: Comment date, 2: Comment time. */
                                                                        __( '%1$s at %2$s', 'smile-web' ),
                                                                        get_comment_date( '', $comment ),
                                                                        get_comment_time()
                                                                )
                                                        );
                                                        ?>
                                                </div><!-- .comment-metadata -->

                                                <div class="comment-author vcard">
                                                        <?php
                                                        if ( 0 !== $args['avatar_size'] ) {
                                                                echo get_avatar( $comment, $args['avatar_size'] );
                                                        }
                                                        ?>
                                                        <?php
                                                        $comment_author = get_comment_author_link( $comment );

                                                        if ( '0' === $comment->comment_approved && ! $show_pending_links ) {
                                                                $comment_author = get_comment_author( $comment );
                                                        }

                                                        printf(
                                                                /* translators: %s: Comment author link. */
                                                                __( '%s <span class="says">says:</span>', 'smile-web' ),
                                                                sprintf( '<b class="fn">%s</b>', $comment_author )
                                                        );
                                                        ?>
                                                </div><!-- .comment-author -->

                                                <?php if ( '0' == $comment->comment_approved ) : ?>
                                                <em class="comment-awaiting-moderation"><?php echo $moderation_note; ?></em>
                                                <?php endif; ?>
                                        </footer><!-- .comment-meta -->

                                        <div class="comment-content">
                                                <?php comment_text(); ?>
                                        </div><!-- .comment-content -->

                                        <?php
                                        $edit_comment_url = get_edit_comment_link( $comment );
                                        $can_display_reply = ( '1' == $comment->comment_approved || $show_pending_links );

                                        if ( $edit_comment_url || $can_display_reply ) :
                                        ?>
                                        <div class="comment-actions">
                                                <?php edit_comment_link( __( 'Edit', 'smile-web' ) ); ?>
                                                <?php
                                                if ( $can_display_reply ) {
                                                        comment_reply_link(
                                                                array_merge(
                                                                        $args,
                                                                        array(
                                                                                'reply_text' => __( 'Responder', 'smile-web' ),
                                                                                'add_below'  => 'div-comment',
                                                                                'depth'      => $depth,
                                                                                'max_depth'  => $args['max_depth'],
                                                                        )
                                                                )
                                                        );
                                                }
                                                ?>
                                        </div><!-- .comment-actions -->
                                        <?php endif; ?>
                                </article><!-- .comment-body -->
                        <?php
                }
        }
}

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>


<div id="comments" class="comments-area container col-12">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		?>
		<h2 class="comments-title">
		<?php
		$smile_v6_comment_count = get_comments_number();
		if ( '1' === $smile_v6_comment_count ) {
			printf(
			// translators: %1$s: post title.
				esc_html__( 'One thought on &ldquo;%1$s&rdquo;', 'smile-web' ),
				'<span>' . wp_kses_post( get_the_title() ) . '</span>'
			);
		} else {
			printf(
			// translators: 1: number of comments, 2: post title.
				esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $smile_v6_comment_count, 'comments title', 'smile-web' ) ),
				esc_html( number_format_i18n( $smile_v6_comment_count ) ),
				'<span>' . wp_kses_post( get_the_title() ) . '</span>'
			);
		}
		?>
		</h2><!-- .comments-title -->

		<?php the_comments_navigation(); ?>

		<ol class="comment-list">
		<?php

                wp_list_comments(
                        array(
                                'style'      => 'ol',
                                'short_ping' => true,
                                'walker'     => new Smile_Web_Walker_Comment(),
                        )
                );
                ?>
		</ol><!-- .comment-list -->

		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'smile-web' ); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().

	comment_form(
		array(
			'class_submit'  => 'btn',
			'submit_button' => '<button name="%1$s" type="submit" id="%2$s" class="%3$s">%4$s</button>',
			'submit_field'  => '<p class="form-submit btn-wrapper">%1$s %2$s</p>',
		)
	);
	?>

</div><!-- #comments -->
