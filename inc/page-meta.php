<?php
/**
 * Page meta boxes.
 *
 * @package smile-web
 */

defined( 'ABSPATH' ) || exit;

/**
 * Registers the meta box to customize the intro skip link text.
 *
 * @since 1.0.0
 * @return void
 * @package smile-web
 */
function smile_v6_register_skip_link_text_meta_box() {
        add_meta_box(
                'smile-v6-skip-link-text',
                esc_html__( 'Intro button text', 'smile-web' ),
                'smile_v6_render_skip_link_text_meta_box',
                'page',
                'side',
                'default'
        );
}
add_action( 'add_meta_boxes_page', 'smile_v6_register_skip_link_text_meta_box' );

/**
 * Renders the skip link text meta box.
 *
 * @since 1.0.0
 * @param WP_Post $post Post object.
 * @return void
 * @package smile-web
 */
function smile_v6_render_skip_link_text_meta_box( $post ) {
        wp_nonce_field( 'smile_v6_save_skip_link_text', 'smile_v6_skip_link_text_nonce' );

        $skip_link_text = get_post_meta( $post->ID, 'smile_v6_skip_link_text', true );
        ?>
        <p>
                <label for="smile_v6_skip_link_text" class="screen-reader-text"><?php esc_html_e( 'Intro button text', 'smile-web' ); ?></label>
                <input type="text" id="smile_v6_skip_link_text" name="smile_v6_skip_link_text" class="widefat" value="<?php echo esc_attr( $skip_link_text ); ?>" />
        </p>
        <p class="description">
                <?php esc_html_e( 'Change the text displayed on the "See main content" button for this page.', 'smile-web' ); ?>
        </p>
        <?php
}

/**
 * Saves the skip link text meta box value.
 *
 * @since 1.0.0
 * @param int $post_id Post ID.
 * @return void
 * @package smile-web
 */
function smile_v6_save_skip_link_text_meta_box( $post_id ) {
        if ( ! isset( $_POST['smile_v6_skip_link_text_nonce'] ) ) {
                return;
        }

        $nonce = sanitize_text_field( wp_unslash( $_POST['smile_v6_skip_link_text_nonce'] ) );

        if ( ! wp_verify_nonce( $nonce, 'smile_v6_save_skip_link_text' ) ) {
                return;
        }

        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
                return;
        }

        if ( isset( $_POST['post_type'] ) && 'page' !== sanitize_text_field( wp_unslash( $_POST['post_type'] ) ) ) {
                return;
        }

        if ( ! current_user_can( 'edit_page', $post_id ) ) {
                return;
        }

        if ( ! isset( $_POST['smile_v6_skip_link_text'] ) ) {
                return;
        }

        $skip_link_text = sanitize_text_field( wp_unslash( $_POST['smile_v6_skip_link_text'] ) );

        if ( '' !== $skip_link_text ) {
                update_post_meta( $post_id, 'smile_v6_skip_link_text', $skip_link_text );
        } else {
                delete_post_meta( $post_id, 'smile_v6_skip_link_text' );
        }
}
add_action( 'save_post_page', 'smile_v6_save_skip_link_text_meta_box' );

/**
 * Retrieves the skip link text for the current page.
 *
 * @since 1.0.0
 * @param int $post_id Optional. Post ID. Default 0 (current post).
 * @return string Skip link text.
 * @package smile-web
 */
function smile_v6_get_skip_link_text( $post_id = 0 ) {
        if ( 0 === $post_id ) {
                $post_id = get_the_ID();
        }

        $post_id = absint( $post_id );

        if ( ! $post_id ) {
                return esc_html__( 'See main content', 'smile-web' );
        }

        $skip_link_text = get_post_meta( $post_id, 'smile_v6_skip_link_text', true );

        if ( '' === $skip_link_text ) {
                return esc_html__( 'See main content', 'smile-web' );
        }

        return $skip_link_text;
}
