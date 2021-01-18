<?php
/**
 * OptionPage.
 *
 * @package MadeByAura\Prime\Plugins\ACFPro\Hooks
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Plugins\ACFPro\Hooks;

defined( 'ABSPATH' ) || die();

/**
 * OptionPage.
 */
class OptionPage {
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
		// Add option page.
		add_action( 'acf/init', [ __CLASS__, 'add_option_page' ], 20 );
	}

	/**
	 * Register Option Pages.
	 *
	 * @link https://www.advancedcustomfields.com/resources/options-page/
	 *
	 * @return void
	 */
	public static function add_option_page() {
		acf_add_options_sub_page( apply_filters( 'aura_theme_acf_options_page_theme_options', [
			'page_title'  => esc_attr__( 'Theme Options', 'aura-prime' ),
			'menu_title'  => esc_attr__( 'Theme Options', 'aura-prime' ),
			'menu_slug'   => 'aura_theme_options',
			'parent_slug' => 'themes.php',
			'capability'  => 'edit_posts',
		] ) );
	}
}
