<?php
/**
 * CSS and JS files.
 *
 * @link https://wordpress.org/plugins/kirki/
 *
 * @package MadeByAura\Prime\Plugins\Kirki\Hooks
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Plugins\Kirki\Hooks;

defined( 'ABSPATH' ) || die();

use MadeByAura\WPTools\Utils;

/**
 * Scripts.
 */
class Scripts {
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
		if ( ! Utils::is_plugin_active( 'kirki/kirki.php' ) ) {
			add_filter( 'aura_theme_styles', [ __CLASS__, 'add_styles' ], 20 );
		}

		// Enqueue customizer styles and scripts.
		add_action( 'customize_controls_print_styles', [ __CLASS__, 'enqueue_customizer_styles' ], 100 );
		add_action( 'customize_controls_enqueue_scripts', [ __CLASS__, 'enqueue_customizer_scripts' ], 20 );
	}

	/**
	 * Add stylesheets to be Scripts.
	 *
	 * @param  array $styles Stylesheets to be Scriptsd.
	 * @return array
	 */
	public static function add_styles( $styles ) {
		$styles[] = [
			'handle'   => wp_get_theme()->stylesheet . '_no-kirki',
			'uri'      => get_stylesheet_uri(),
			'version'  => filemtime( get_stylesheet_uri() ),
			'priority' => 35,
		];

		return $styles;
	}

	/**
	 * Enqueue customizer stylesheets.
	 *
	 * @return void
	 */
	public static function enqueue_customizer_styles() {
		wp_enqueue_style( get_template() . '-kirki', get_template_directory_uri() . '/dist/css/kirki.css', [], filemtime( get_template_directory() . '/dist/css/kirki.css' ) );
	}

	/**
	 * Enqueue customizer scripts.
	 *
	 * @return void
	 */
	public static function enqueue_customizer_scripts() {
		wp_enqueue_script( get_template() . '-kirki-js', get_template_directory_uri() . '/dist/js/kirki.js', [ 'jquery', 'customize-controls' ], filemtime( get_template_directory() . '/dist/js/kirki.js' ), true );
	}
}
