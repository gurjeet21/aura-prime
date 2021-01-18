<?php
/**
 * Setup.
 *
 * @package MadeByAura\Prime\PluginInstaller\Hooks
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\PluginInstaller\Hooks;

defined( 'ABSPATH' ) || die();

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
	protected static function add_hooks() {
		// Add plugins.
		add_action( 'tgmpa_register', [ __CLASS__, 'register_plugins' ], 20 );
	}

	/**
	 * Register plugins.
	 *
	 * @return void
	 */
	public static function register_plugins() {
		$config = apply_filters( 'aura_theme_tgmpa_config', [
			'id'           => get_template(),
			'default_path' => '',
			'menu'         => 'tgmpa-install-plugins',
			'parent_slug'  => 'themes.php',
			'capability'   => 'edit_theme_options',
			'has_notices'  => true,
			'dismissable'  => true,
			'dismiss_msg'  => '',
			'is_automatic' => true,
			'message'      => '',
		] );

		$plugins = apply_filters( 'aura_theme_tgmpa_plugins', [
			[
				'name'     => esc_html__( 'Kirki', 'aura-prime' ),
				'slug'     => 'kirki',
				'required' => true,
			],
		] );

		tgmpa( $plugins, $config );
	}
}
