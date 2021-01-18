<?php
/**
 * The template for displaying Menu.
 *
 * This template can be overridden by copying it to
 * your-child-theme/template-parts/menu.php.
 *
 * @package MadeByAura\Prime
 * @author  MadeByAura.com
 *
 * @param array $args
 */

namespace MadeByAura\Prime;

defined( 'ABSPATH' ) || die();

use MadeByAura\WPTools\Utils;
use MadeByAura\WPTools\Markup;

// Merge incoming `$args` with defaults.
$args = array_replace_recursive( [
	'type'             => 'default',
	'menu_id'          => 0,
	'theme_location'   => '',
	'wp_nav_menu_args' => [
		'container'   => false,
		'items_wrap'  => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'depth'       => 3,
		'fallback_cb' => function( $args ) {
			get_template_part( 'template-parts/menu-fallback', $args );
		},
	],
], $args );

// Add `menu_id` to `wp_nav_menu_args`.
if ( empty( $args['wp_nav_menu_args']['menu'] ) ) {
	$args['wp_nav_menu_args']['menu'] = $args['menu_id'];
}

// Add `theme_location` to `wp_nav_menu_args`.
if ( empty( $args['wp_nav_menu_args']['theme_location'] ) ) {
	$args['wp_nav_menu_args']['theme_location'] = $args['theme_location'];
}

// Conditional early exit.
if ( ! $args['wp_nav_menu_args']['menu'] && ! $args['wp_nav_menu_args']['theme_location'] ) {
	get_template_part( 'template-parts/message', null, [
		'text' => __( 'Either <var>menu_id</var> or <var>theme_location</var> is required to display <em>Menu</em>.', 'aura-prime' ),
	] );

	return;
}

// Classes.
$classes[] = 'aura-menu';

// Type classes.
if ( $args['type'] ) {
	$classes[] = 'aura-menu--type-' . Utils::dashify( $args['type'] );
}
?>

<nav class="<?php Markup::echo_classes( $classes ); ?>">
	<?php wp_nav_menu( $args['wp_nav_menu_args'] ); ?>
</nav><!-- .aura-menu -->
