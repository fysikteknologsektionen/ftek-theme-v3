<?php
/**
 * Customize control for selecting multiple images
 *
 * @package ftek\theme
 */

namespace Ftek\Theme;

/**
 * Customize control for selecting multiple images
 */
class Slideshow_Image_Selector extends \WP_Customize_Control {

	/**
	 * Enqueue control related scripts/styles.
	 */
	public function enqueue(): void {
		enqueue_entrypoint_script( 'ftek-theme-slideshow-image-selector', 'slideshow-image-selector.tsx' );
	}

	/**
	 * Render the control's content.
	 */
	public function render_content(): void {
		?>
		<div class="ftek-theme-slideshow-image-selector">
			<input type="hidden" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />
		</div>
		<?php
	}
}
?>
