<?php
/**
 * Sidebar.
 *
 * @package MadeByAura\Prime\Modules
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Modules;

defined( 'ABSPATH' ) || die();

use MadeByAura\WPTools\Utils;
use MadeByAura\Prime\Base;

/**
 * Sidebar.
 */
class Sidebar {
	/**
	 * Get sidebar position.
	 *
	 * @return string $position
	 */
	public static function get_position() {
		$position     = Base::get_mod( 'sidebar', 'position' );
		$acf_position = '';
		$mod_position = '';

		if ( is_singular( 'post' ) ) {
			$acf_position = Base::get_acf( 'general', 'sidebar_position' );
			$mod_position = Base::get_mod( 'post', 'sidebar_position' );
		} elseif ( is_home() ) {
			$mod_position = Base::get_mod( 'post_archive', 'sidebar_position' );
		} elseif ( is_singular( 'page' ) ) {
			$acf_position = Base::get_acf( 'general', 'sidebar_position' );
			$mod_position = Base::get_mod( 'page', 'sidebar_position' );
		}

		if ( $acf_position && 'default' !== $acf_position ) {
			$position = $acf_position;
		} elseif ( $mod_position && 'default' !== $mod_position ) {
			$position = $mod_position;
		} elseif ( is_404() || is_page_template( [ 'elementor_canvas', 'elementor_header_footer' ] ) || Utils::is_wc_page( [ 'cart', 'checkout', 'endpoint', 'account' ] ) ) {
			$position = 'disabled';
		}

		return apply_filters( 'aura_theme_sidebar_position', $position );
	}

	/**
	 * Check if sidebar is active.
	 *
	 * @param  string $position  Sidebar position.
	 * @return string $position
	 */
	public static function is_enabled( $position = '' ) {
		if ( ! $position ) {
			$position = self::get_position();
		}

		return in_array( $position, [ 'left', 'right' ], true ) ? true : false;
	}

	/**
	 * Get status.
	 *
	 * @return string
	 */
	public static function get_status() {
		$status = 'right';

		if ( is_404() ) {
			$status = false;
		}

		// Make sure that the status is valid.
		$status = ( in_array( $status, [ 'left', 'right' ], true ) ) ? $status : false;

		return $status;
	}

	/**
	 * Get sidebar sticky position.
	 *
	 * @return string $position
	 */
	public static function get_sticky_method() {
		return apply_filters( 'aura_theme_sidebar_sticky_method', Base::get_mod( 'sidebar', 'sticky_method' ) );
	}
}
