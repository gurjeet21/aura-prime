<?php
/**
 * The template for displaying Hamburger.
 *
 * This template can be overridden by copying it to
 * your-child-theme/template-parts/hamburger.php.
 *
 * @package MadeByAura\Prime
 * @author  MadeByAura.com
 *
 * @param array $args
 */

namespace MadeByAura\Prime;

defined( 'ABSPATH' ) || die();

use MadeByAura\WPTools\Markup;

// Merge incoming `$args` with defaults.
$args = array_replace_recursive( [
	'wrapper'       => '',
	'attrs'         => [],
	'tag'           => 'a',
	'text'          => __( 'Menu', 'aura-prime' ),
	'text_hidden'   => true,
	'initial_state' => 'disabled',
], $args );

// Conditional early exit.
if ( ! $args['tag'] ) {
	get_template_part( 'template-parts/message', null, [
		'text' => __( '<var>tag</var> is required to display <em>Hamburger</em>.', 'aura-prime' ),
	] );

	return;
}

// Attributes.
$attrs = [];

// Classes.
$classes[] = 'aura-hamburger';

// Anchor tag attributes.
if ( 'a' === $args['tag'] && empty( $attrs['href'] ) ) {
	$attrs['href'] = '#';
}

// State attributes.
if ( 'enabled' === $args['initial_state'] ) {
	$attrs['data-aura-enabled'] = true;
}

// Merge attributes with explicit attributes.
if ( is_array( $args['attrs'] ) ) {
	$attrs = array_merge_recursive( $attrs, $args['attrs'] );
}

// Merge implicit classes with explicit classes.
if ( ! empty( $attrs['class'] ) ) {
	$classes = Markup::merge_classes( $classes, $attrs['class'] );
}

// Add merged classes to attributes.
$attrs['class'] = $classes;
?>

<<?php tag_escape( $args['tag'] ); ?> <?php Markup::echo_attrs( $attrs ); ?>>
	<div class="aura-hamburger__bars">
		<div class="aura-hamburger__bar aura-hamburger__bar-top"></div>
		<div class="aura-hamburger__bar aura-hamburger__bar-middle"></div>
		<div class="aura-hamburger__bar aura-hamburger__bar-middle"></div>
	</div><!-- .aura-hamburger__bars -->

	<div class="aura-hamburger__label screen-reader-text">
		<?php echo esc_html( $args['text'] ); ?>
	</div><!-- .aura-hamburger__label -->
</<?php tag_escape( $args['tag'] ); ?>>
