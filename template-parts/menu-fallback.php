<?php
/**
 * The template for displaying Menu Fallback.
 *
 * This template can be overridden by copying it to
 * your-child-theme/template-parts/menu-fallback.php.
 *
 * @package MadeByAura\Prime
 * @author  MadeByAura.com
 *
 * @param array $args
 */

namespace MadeByAura\Prime;

defined( 'ABSPATH' ) || die();

use MadeByAura\WPTools\Markup;

// Conditional early exit.
if ( ! is_array( $args ) || ! current_user_can( 'manage_options' ) ) {
	return;
}

$theme_location = $args['theme_location'];
$menu_location  = get_registered_nav_menus()[ $theme_location ];

$classes[] = 'aura-nav-fallback';
$classes[] = $theme_location . '-nav-fallback';
?>

<div class="<?php Markup::echo_classes( $classes ); ?>">
	<?php
	echo sprintf( '<a href="%s" target="_blank">', esc_url( admin_url( 'nav-menus.php?action=locations' ) ) );
		// Translators: 1: Menu location.
		echo wp_kses_post( sprintf( __( 'Create or select %1$s', 'aura-prime' ), '<em>' . $menu_location . '</em>' ) );
	echo '</a>';
	?>
</div><!-- .aura-nav-fallback -->
