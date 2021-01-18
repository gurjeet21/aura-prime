<?php
/**
 * Set initial settings for ACF Pro.
 *
 * @package MadeByAura\Prime\Plugins\ACFPro\Hooks
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Plugins\ACFPro\Hooks;

defined( 'ABSPATH' ) || die();

use MadeByAura\WPTools\Utils;
use MadeByAura\Prime\Base;

/**
 * Setup.
 */
class Setup {
	/**
	 * Instance.
	 *
	 * @var object  Class object.
	 */
	private static $instance;

	/**
	 * Instantiator.
	 *
	 * @return object  Class instance.
	 */
	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Constructor.
	 *
	 * @return void
	 */
	protected function __construct() {
		self::add_hooks();
	}

	/**
	 * Add hooks.
	 *
	 * @return void
	 */
	public static function add_hooks() {
		// Conditionally remove ACF's Custom Fields menu item.
		if ( Utils::is_plugin_active( 'kirki/kirki.php' ) && true === Base::get_mod( 'advanced', 'acf_hide_menu_item' ) ) {
			add_filter( 'acf/settings/show_admin', '__return_false' );
			add_filter( 'acf/settings/show_updates', '__return_false' );
		}

		// Disable update Notification.
		add_filter( 'acf/settings/show_updates', '__return_false' );

		// Set json paths.
		add_filter( 'acf/settings/save_json', [ __CLASS__, 'set_save_json_path' ], 20 );
		add_filter( 'acf/settings/load_json', [ __CLASS__, 'set_load_json_path' ], 20 );
	}

	/**
	 * Set json save path. Create directory if the directory mentioned in the path
	 * doesn't exist.
	 *
	 * @link https://www.advancedcustomfields.com/resources/local-json/
	 *
	 * @return string $path  Path.
	 */
	public static function set_save_json_path() {
		$path = wp_normalize_path( get_stylesheet_directory() . '/inc/Plugins/ACFPro/fields-json' );

		if ( ! file_exists( $path ) ) {
			mkdir( $path, 0755, true );
		}

		return $path;
	}

	/**
	 * Set json load path.
	 *
	 * @link https://www.advancedcustomfields.com/resources/local-json/
	 *
	 * @param  array $paths  Paths.
	 * @return array $paths
	 */
	public static function set_load_json_path( $paths ) {
		if ( is_child_theme() ) {
				$paths[] = wp_normalize_path( get_stylesheet_directory() . '/inc/Plugins/ACFPro/fields-json' );

		}

		$paths[] = wp_normalize_path( get_template_directory() . '/inc/Plugins/ACFPro/fields-json' );

		return $paths;
	}
}
