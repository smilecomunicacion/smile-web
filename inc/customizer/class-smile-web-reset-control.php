<?php
/**
 * Customizer reset control class.
 *
 * @package smile-web
 */

/**
 * Provides a custom reset control for color management.
 *
 * @since 6.0.7
 *
 * @package smile-web
 */
class Smile_Web_Reset_Control extends WP_Customize_Control {
	/**
	 * Control type identifier.
	 *
	 * @since 6.0.7
	 *
	 * @var string
	 */
	public $type = 'reset';

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
		<button type="button" class="button smile-v6-reset-colors">
			<?php esc_html_e( 'Reset All Colors', 'smile-web' ); ?>
		</button>
		<div class="smile-v6-reset-status smile-v6-status"></div>
		<?php
	}
}
