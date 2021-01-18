<?php
/**
 * Base.
 *
 * @package MadeByAura\Prime
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime;

defined( 'ABSPATH' ) || die();

use MadeByAura\WPTools\ACF;
use MadeByAura\Prime\Plugins\Kirki\Modules\Data as Mods;

/**
 * Base.
 */
class Base {
	/**
	 * Get theme information.
	 *
	 * @param  string $key    Theme information key.
	 * @return mixed  $value
	 */
	public static function get_info( $key ) {
		$value = '';

		static $info;

		if ( ! $info ) {
			$info['prefix']    = 'aura_';
			$info['slug']      = esc_html( get_template() );
			$info['url']       = trailingslashit( get_site_url() );
			$info['dir_url']   = trailingslashit( get_template_directory_uri() );
			$info['dir_path']  = wp_normalize_path( trailingslashit( get_template_directory() ) );
			$info['namespace'] = __NAMESPACE__;

			if ( is_child_theme() ) {
				$info['version'] = wp_get_theme( wp_get_theme()->get( 'Template' ) )->get( 'Version' );
			} else {
				$info['version'] = wp_get_theme()->get( 'Version' );
			}

			// Child theme.
			$info['child_slug']     = esc_html( get_stylesheet() );
			$info['child_dir_url']  = trailingslashit( get_stylesheet_directory_uri() );
			$info['child_dir_path'] = wp_normalize_path( trailingslashit( get_stylesheet_directory() ) );
			$info['child_version']  = wp_get_theme()->get( 'Version' );
		}

		if ( ! empty( $info[ $key ] ) ) {
			$value = $info[ $key ];
		}

		return $value;
	}

	/**
	 * Get choices.
	 *
	 * @param  string $key    Key.
	 * @return array  $value
	 */
	public static function get_choices( $key ) {
		$value = '';
		$value = apply_filters( 'aura_theme_choices', $value, $key );
		$value = apply_filters( "aura_theme_choices_{$key}", $value );

		return $value;
	}

	/**
	 * Proxy function for `get_value()` method of `ACF` class.
	 *
	 * @param  string $group    Group.
	 * @param  string $key      Key.
	 * @param  int    $post_id  Post ID.
	 * @param  mixed  $default  Fallback value.
	 * @return mixed
	 */
	public static function get_acf( $group, $key, $post_id = null, $default = null ) {
		return ACF::get_value( $group, $key, $post_id, $default );
	}

	/**
	 * Proxy function for `get_parsed_link_value()` method of `ACF` class.
	 *
	 * @param  string $group    Group.
	 * @param  string $key      Key.
	 * @param  int    $post_id  Post ID.
	 * @param  mixed  $default  Fallback value.
	 * @return mixed
	 */
	public static function get_acf_parsed_link_value( $group, $key, $post_id = null, $default = null ) {
		return ACF::get_parsed_link_value( $group, $key, $post_id, $default );
	}

	/**
	 * Proxy function for `get()` method of `Mods` class.
	 *
	 * @param  string $group  Group.
	 * @param  string $key    Key.
	 * @return mixed
	 */
	public static function get_mod( $group, $key ) {
		return Mods::get( $group, $key );
	}

	/**
	 * Proxy function for `get_default()` method of `Mods` class.
	 *
	 * @param  string $group  Group.
	 * @param  string $key    Key.
	 * @return mixed
	 */
	public static function get_mod_default( $group, $key ) {
		return Mods::get_default( $group, $key );
	}

	/**
	 * Set default theme mod using a filter.
	 *
	 * @param  string $group  Group.
	 * @param  string $key    Key.
	 * @param  mixed  $value  Value.
	 * @return mixed  $value
	 */
	public static function set_mod_default( $group, $key, $value ) {
		$id = $group . '_' . sanitize_key( $key );

		add_filter( "aura_theme_mods_default_{$id}", function() use ( $value ) {
			return $value;
		}, 20 );

		return $value;
	}
}
