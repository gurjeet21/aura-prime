<?php
/**
 * Setup.
 *
 * @link https://wordpress.org/plugins/kirki/
 *
 * @package MadeByAura\Prime\Plugins\Kirki\Hooks
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Plugins\Kirki\Hooks;

defined( 'ABSPATH' ) || die();

use MadeByAura\Prime\Base;
use MadeByAura\Prime\Plugins\Kirki\Customizer;

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
		// Configure Kirki.
		add_action( 'after_setup_theme', [ __CLASS__, 'configure' ], 900 );

		// Include customizer panels, sections, and fields.
		add_action( 'after_setup_theme', [ __CLASS__, 'include_fields' ], 1000 );
	}

	/**
	 * Configure Kirki.
	 *
	 * @return void
	 */
	public static function configure() {
		Customizer::add_config( Base::get_info( 'prefix' ) . 'config', [
			'capability'  => 'edit_theme_options',
			'option_type' => 'theme_mod',
		] );
	}

	/**
	 * Include customizer panels, sections, and fields.
	 *
	 * @return void
	 */
	public static function include_fields() {
		$files = [
			// General.
			'general/panel.php',
			'general/branding.php',
			'general/colors.php',
			'general/typography.php',
			'general/icons.php',
			'general/buttons.php',
			'general/sidebar.php',
			'general/share-links.php',
			'general/advanced.php',
			// Post Archive.
			'post-archive.php',
			// Single Post.
			'post.php',
			// Pages.
			'page.php',
			// Spacer.
			'spacer.php',
		];

		foreach ( $files as $file ) {
			require_once wp_normalize_path( get_template_directory() . "/inc/Plugins/Kirki/fields/{$file}" );
		}
	}
}
