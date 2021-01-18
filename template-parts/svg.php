<?php
/**
 * The template for displaying SVG.
 *
 * This template can be overridden by copying it to
 * your-child-theme/template-parts/svg.php.
 *
 * @package MadeByAura\Prime
 * @author  MadeByAura.com
 *
 * @param array $args
 */

namespace MadeByAura\Prime;

defined( 'ABSPATH' ) || die();

use MadeByAura\WPTools\Markup;
use MadeByAura\Prime\Modules\SVG;

// Merge incoming `$args` with defaults.
$args = array_replace_recursive( [
	'id' => '',
], $args );

// Don't proceed if there is no id.
if ( ! $args['id'] ) {
	return;
}

// Classes.
$classes   = [];
$classes[] = 'aura-svg';
$classes[] = 'aura-svg--' . $args['id'];

// URL.
$url = get_template_directory_uri() . '/dist/img/sprite.svg#' . $args['id'];

$data = SVG::get_data();

// Conditional early exit.
if ( ! $data ) {
	get_template_part( 'template-parts/message', null, [
		'text' => __( '<em>SVG data</em> is required to display <em>SVG</em>.', 'aura-prime' ),
	] );

	return;
}

// Conditional early exit.
if ( ! $args['id'] ) {
	get_template_part( 'template-parts/message', null, [
		'text' => __( '<var>id</var> is required to display <em>SVG</em>.', 'aura-prime' ),
	] );

	return;
}

// Conditional early exit.
if ( ! $data || ! array_key_exists( $args['id'], $data ) ) {
	get_template_part( 'template-parts/message', null, [
		// translators: SVG ID.
		'text' => sprintf( __( '<var>%s</var> doesn\'t exists in <em>SVG data</em>.', 'aura-prime' ), $args['id'] ),
	] );

	return;
}
?>

<svg class="<?php Markup::echo_classes( $classes ); ?>" aria-hidden="true" focusable="false">
	<use xlink:href="<?php echo esc_url( $url ); ?>"/>
</svg>
