<?php
/**
 * Customizer import control class.
 *
 * @package smile-web
 */

/**
 * Provides a custom import control for color management.
 *
 * @since 6.0.7
 *
 * @package smile-web
 */
if ( ! class_exists( 'WP_Customize_Control' ) ) {
	require_once ABSPATH . 'wp-includes/class-wp-customize-control.php';
}

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'Smile_Web_Import_Control' ) ) {
	class Smile_Web_Import_Control extends WP_Customize_Control {
		/**
		 * Control type identifier.
		 *
		 * @since 6.0.7
		 *
		 * @var string
		 */
		public $type = 'import';

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
			<input type="hidden" <?php $this->link(); ?> value="" />
			<input type="file" class="smile-v6-import-file" accept=".json" />
			<button type="button" class="button smile-v6-import-colors" disabled>
				<?php esc_html_e( 'Import Colors', 'smile-web' ); ?>
			</button>
			<div class="smile-v6-import-status smile-v6-status"></div>
			<?php
		}
	}
}
