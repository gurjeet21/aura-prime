<?php
/**
 * The template for displaying Button.
 *
 * This template can be overridden by copying it to
 * your-child-theme/template-parts/button.php.
 *
 * @package MadeByAura\Prime
 * @author  MadeByAura.com
 *
 * @param array $args
 */

namespace MadeByAura\Prime;

defined( 'ABSPATH' ) || die();

use MadeByAura\WPTools\Markup;
use MadeByAura\WPTools\Utils;

// Merge incoming `$args` with defaults.
$args = array_replace_recursive( [
	'wrapper'         => '',
	'attrs'           => [],
	'type'            => 'alpha',
	'tag'             => 'a',
	'icon_type'       => 'font',
	'icon_font_class' => '',
	'icon_svg_id'     => '',
	'icon_position'   => 'after_text',
	'text'            => __( 'Button', 'aura-prime' ),
	'text_hidden'     => false,
	'url'             => '#',
	'external'        => false,
	'nofollow'        => false,
], $args );

// Apply filter for default icon.
$args = apply_filters( 'aura/wp-tools/view/button/data', $args );

// Conditional early exit.
if ( ! $args['tag'] || ! $args['text'] ) {
	get_template_part( 'template-parts/message', null, [
		'text' => __( '<var>tag</var> and <var>text</var> are required to display <em>Button</em>.', 'aura-prime' ),
	] );

	return;
}

// Icon enabled?
$icon_enabled = false;
if ( $args['icon_type'] ) {
	if ( 'font' === $args['icon_type'] && $args['icon_font_class'] ) {
		$icon_enabled = true;
	} elseif ( 'svg' === $args['icon_type'] && $args['icon_svg_id'] ) {
		$icon_enabled = true;
	}
}

// Context.
$classes[] = 'aura-button';

// Type classes.
if ( $args['type'] ) {
	$classes[] = $args['type'] ? 'aura-button--type-' . Utils::dashify( $args['type'] ) : '';
}

// Icon Type classes.
if ( $icon_enabled ) {
	$classes[] = 'aura-button--icon-type-' . Utils::dashify( $args['icon_type'] );

	// Icon Position classes.
	if ( $args['icon_position'] ) {
		$classes[] = 'aura-button--icon-position-' . Utils::dashify( $args['icon_position'] );
	}
}

// Text Hidden classes.
if ( $args['text_hidden'] ) {
	$classes[] = 'aura-button--text-hidden';
}

// Attributes.
$attrs = [];

// Anchor tag attributes.
if ( 'a' === $args['tag'] ) {
	$attrs['href'] = $args['url'];

	if ( true === $args['external'] ) {
		$attrs['target'] = '_blank';
	}

	if ( true === $args['nofollow'] ) {
		$attrs['rel'] = 'nofollow';
	}
}

// Merge implicit classes with explicit classes.
if ( ! empty( $attrs['class'] ) ) {
	$classes = Markup::merge_classes( $classes, $attrs['class'] );
}

// Add merged classes to attributes.
$attrs['class'] = $classes;
?>

<<?php echo tag_escape( $args['tag'] ); ?> <?php Markup::echo_attrs( $attrs ); ?>>
	<div class="aura-button__inner">
		<div class="aura-button__text <?php echo esc_attr( ( true === $args['text_hidden'] ) ? 'screen-reader-text' : '' ); ?>">
			<?php echo esc_html( $args['text'] ); ?>
		</div><!-- .aura-button__text -->

		<?php if ( $icon_enabled ) : ?>
			<?php
			get_template_part( 'template-parts/icon', null, [
				'wrapper'    => 'aura-button__icon',
				'type'       => $args['icon_type'],
				'font_class' => $args['icon_font_class'],
				'svg_id'     => $args['icon_svg_id'],
			] );
			?>
		<?php endif; ?>
	</div><!-- .aura-button__inner -->
</<?php echo tag_escape( $args['tag'] ); ?>><!-- .aura-button -->
