<?php
/**
 * The template for displaying Footer.
 *
 * This template can be overridden by copying it to
 * your-child-theme/template-parts/site/footer.php.
 *
 * @package MadeByAura\Prime
 * @author  MadeByAura.com
 *
 * @param array $args
 */

namespace MadeByAura\Prime;

defined( 'ABSPATH' ) || die();

if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) {
	do_action( 'aura_theme_footer_open' );
	do_action( 'aura_theme_footer' );
	do_action( 'aura_theme_footer_close' );
}
