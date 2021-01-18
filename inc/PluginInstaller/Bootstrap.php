<?php
/**
 * TGM Plugin Activation.
 *
 * @package MadeByAura\Prime\PluginInstaller
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\PluginInstaller;

defined( 'ABSPATH' ) || die();

/**
 * Bootstrap.
 */
class Bootstrap {
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
		// Include TGM plugin activation class.
		require_once wp_normalize_path( get_template_directory() . '/inc/PluginInstaller/vendor/class-tgm-plugin-activation.php' );

		// Hooks.
		Hooks\Setup::get_instance();
	}
}
