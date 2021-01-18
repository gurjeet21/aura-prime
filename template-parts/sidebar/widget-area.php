<?php
/**
 * The template for displaying Widget area.
 *
 * This template can be overridden by copying it to
 * your-child-theme/template-parts/sidebar/widget-area.php.
 *
 * @package MadeByAura\Prime
 * @author  MadeByAura.com
 *
 * @param array $args
 */

namespace MadeByAura\Prime;

defined( 'ABSPATH' ) || die();

$sidebar = apply_filters( 'aura_theme_sidebar_widget_area', Base::get_info( 'prefix' ) . 'sidebar' );

// Conditional early exit.
if ( ! $sidebar ) {
	return;
}
?>

<div class="aura-content__sidebar-widget-area aura-widget-area">
	<?php
	if ( is_active_sidebar( $sidebar ) ) {
		dynamic_sidebar( $sidebar );
	}
	?>
</div><!-- .aura-content__sidebar-widget-area aura-widget-area -->
