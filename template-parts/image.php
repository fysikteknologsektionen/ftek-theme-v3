<?php
/**
 * Image with a blurry preview
 *
 * @package ftek\theme
 */

namespace Ftek\Theme;

?>
<div class="h-full w-full relative">
	<?php
	$full_path            = wp_get_original_image_path( $args['id'] );
	$basename             = basename( $full_path );
	$placeholder_basename = basename( wp_get_attachment_image_url( $args['id'], 'ftek-theme-placeholder-size' ) );
	$placeholder_path     = str_replace( $basename, $placeholder_basename, $full_path );
    // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
	$data      = file_get_contents( $placeholder_path );
	$finfo     = new \finfo( FILEINFO_MIME_TYPE );
	$mime_type = $finfo->buffer( $data );
	?>
	<div class="overflow-hidden z-10 w-full h-full bg-gray-400">
		<img class="object-cover w-full h-full blur-lg" src="data:<?php echo esc_attr( $mime_type ); ?>;charset=utf-8;base64,<?php echo esc_attr( base64_encode( $data ) ); ?>" /> <?php // phpcs:ignore WordPress.PHP.DiscouragedPHPFunctions.obfuscation_base64_encode ?>
	</div>
	<img class="object-cover w-full h-full absolute top-0 left-0 opacity-0 transition-opacity" src="<?php echo esc_attr( wp_get_attachment_image_url( $args['id'], 'full' ) ); ?>" onload="this.style.opacity = 1" />
</div>
