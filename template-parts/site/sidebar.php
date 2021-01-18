<?php
/**
 * The template for displaying Sidebar.
 *
 * This template can be overridden by copying it to
 * your-child-theme/template-parts/site/sidebar.php.
 *
 * @package MadeByAura\Prime
 * @author  MadeByAura.com
 *
 * @param array $args
 */

namespace MadeByAura\Prime;

use MadeByAura\Prime\Modules\Sidebar;

defined( 'ABSPATH' ) || die();

// Don't proceed if the sidebar is disabled.
if ( false === Sidebar::get_status() ) {
	return;
}

do_action( 'aura_theme_sidebar_open' );
do_action( 'aura_theme_sidebar' );
do_action( 'aura_theme_sidebar_close' );
