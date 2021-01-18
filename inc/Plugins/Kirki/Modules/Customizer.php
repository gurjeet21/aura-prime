<?php
/**
 * Customizer.
 *
 * @package MadeByAura\Prime\Plugins\Kirki\Modules
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Plugins\Kirki\Modules;

defined( 'ABSPATH' ) || die();

use MadeByAura\Prime\Base;
use MadeByAura\Prime\Plugins\Kirki\Customizer as Kirki;

/**
 * Customizer.
 */
class Customizer {
	/**
	 * Add panel.
	 *
	 * @param  string $group Group.
	 * @param  array  $args  Arguments.
	 * @return void
	 */
	public static function add_panel( $group, $args = [] ) {
		Kirki::add_panel(
			Base::get_info( 'prefix' ) . 'panel_' . $group,
			apply_filters( "aura_theme_mods_panel_{$group}", $args )
		);
	}

	/**
	 * Add section.
	 *
	 * @param  string $group Group.
	 * @param  array  $args  Arguments.
	 * @return void
	 */
	public static function add_section( $group, $args = [] ) {
		Kirki::add_section(
			Base::get_info( 'prefix' ) . 'section_' . $group,
			apply_filters( "aura_theme_mods_section_{$group}", $args )
		);
	}

	/**
	 * Add field.
	 *
	 * @param  string $group     Group.
	 * @param  string $key       Key.
	 * @param  int    $priority  Priority.
	 * @param  array  $args      Arguments.
	 * @return int    $priority
	 */
	public static function add_field( $group, $key, $priority, $args = [] ) {
		$id = $group . '_' . sanitize_key( $key );

		$args = array_replace_recursive( [
			'settings' => Base::get_info( 'prefix' ) . $id,
			'section'  => Base::get_info( 'prefix' ) . 'section_' . $group,
			'priority' => absint( $priority ),
		], $args );

		Kirki::add_field(
			Base::get_info( 'prefix' ) . 'config',
			apply_filters( "aura_theme_mods_field_{$id}", $args )
		);

		return absint( $priority ) + 10;
	}

	/**
	 * Add collapsible.
	 *
	 * @param  string $group     Group.
	 * @param  string $key       Key.
	 * @param  int    $priority  Priority.
	 * @param  array  $args      Arguments.
	 * @return int    $priority
	 */
	public static function add_collapsible( $group, $key, $priority, $args = [] ) {
		$key = sanitize_key( $key ) . '_collapsible_block';

		$args = array_replace_recursive( [
			'title'           => esc_attr__( 'Collapsible', 'aura-prime' ),
			'active_callback' => '',
		], $args );

		return self::add_field( $group, $key, $priority, [
			'type'            => 'custom',
			'default'         => sprintf( '<div class="customize-collapsible"><h3>%s</h3></div>', esc_attr( $args['title'] ) ),
			'active_callback' => $args['active_callback'],
		] );
	}

	/**
	 * Proxy function for `add_fields()` method of `Button` class.
	 *
	 * @param  string $group     Group.
	 * @param  string $type      Type.
	 * @param  int    $priority  Priority.
	 * @return int    $priority
	 */
	public static function add_button_fields( $group, $type, $priority ) {
		return Button::add_fields( $group, $type, $priority );
	}
}
