<?php
/**
 * Customizer export control class.
 *
 * @package smile-web
 */

/**
 * Provides a custom export control for color management.
 *
 * @since 6.0.7
 *
 * @package smile-web
 */
if ( ! class_exists( 'WP_Customize_Control' ) ) {
	require_once ABSPATH . 'wp-includes/class-wp-customize-control.php';
}

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'Smile_Web_Export_Control' ) ) {
	class Smile_Web_Export_Control extends WP_Customize_Control {
		/**
		 * Control type identifier.
		 *
		 * @since 6.0.7
		 *
		 * @var string
		 */
		public $type = 'export';

		/**
		 * Renders the control content.
		 *
		 * @since 6.0.7
		 *
		 * @return void
		 */
		protected function render_content() {
			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php if ( ! empty( $this->description ) ) : ?>
					<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php endif; ?>
			</label>
                        <input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr( $this->value() ); ?>" />
			<button type="button" class="button smile-v6-export-colors">
				<?php esc_html_e( 'Download Colors JSON', 'smile-web' ); ?>
			</button>
			<?php
		}
	}
}
