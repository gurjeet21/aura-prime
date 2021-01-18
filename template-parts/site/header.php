<?php
/**
 * The template for displaying Header.
 *
 * This template can be overridden by copying it to
 * your-child-theme/template-parts/site/header.php.
 *
 * @package MadeByAura\Prime
 * @author  MadeByAura.com
 *
 * @param array $args
 */

namespace MadeByAura\Prime;

defined( 'ABSPATH' ) || die();

if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) {
	do_action( 'aura_theme_header_open' );
	do_action( 'aura_theme_header' );
	do_action( 'aura_theme_header_close' );
}
