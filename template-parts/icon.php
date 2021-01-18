<?php
/**
 * The template for displaying Icon.
 *
 * This template can be overridden by copying it to
 * your-child-theme/template-parts/icon.php.
 *
 * @package MadeByAura\Prime
 * @author  MadeByAura.com
 *
 * @param array $args
 */

namespace MadeByAura\Prime;

defined( 'ABSPATH' ) || die();

use MadeByAura\WPTools\Utils;

// Merge incoming `$args` with defaults.
$args = array_replace_recursive( [
	'wrapper'    => '',
	'type'       => 'font',
	'font_class' => '',
	'svg_id'     => '',
], $args );

// Conditional early exit.
if ( ! $args['type'] ) {
	get_template_part( 'template-parts/message', null, [
		'text' => __( '<var>type</var> is required to display <em>Icon</em>.', 'aura-prime' ),
	] );

	return;
} elseif ( ! in_array( $args['type'], [ 'font', 'svg' ], true ) ) {
	get_template_part( 'template-parts/message', null, [
		'text' => __( '<var>type</var> of <em>Icon</em> can either be <var>font</var> or <var>svg</var>.', 'aura-prime' ),
	] );

	return;
}

// Conditional early exit.
if ( 'font' === $args['type'] && ! $args['font_class'] ) {
	get_template_part( 'template-parts/message', null, [
		'text' => __( '<var>font_class</var> is required to display <em>Icon</em>.', 'aura-prime' ),
	] );

	return;
} elseif ( 'svg' === $args['type'] && ! $args['svg_id'] ) {
	get_template_part( 'template-parts/message', null, [
		'text' => __( '<var>svg_id</var> is required to display <em>Icon</em>.', 'aura-prime' ),
	] );

	return;
}

// Context.
$classes[] = 'icon';

// Type context.
if ( $args['type'] ) {
	$classes[] = 'icon--type-' . Utils::dashify( $args['type'] );
}
?>

<div class="<?php echo esc_attr( $args['wrapper'] ); ?>">
	<i class="aura-icon <?php echo esc_attr( 'font' === $args['type'] ? $args['font_class'] : false ); ?>">
	<?php
		if ( 'svg' === $args['type'] ) {
			get_template_part( 'template-parts/svg', null, [
				'id' => $args['svg_id'],
			] );
		}
	?>
	</i><!-- .aura-icon -->
</div><!-- .aura-button__icon -->
