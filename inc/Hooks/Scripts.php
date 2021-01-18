<?php
/**
 * Add CSS and JS files.
 *
 * @package MadeByAura\Prime\Hooks
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Hooks;

defined( 'ABSPATH' ) || die();

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
	 */
	protected static function add_hooks() {
		// Enqueue CSS and JS files.
		add_action( 'wp_enqueue_scripts', [ __CLASS__, 'enqueue_styles' ], 20 );
		add_action( 'wp_enqueue_scripts', [ __CLASS__, 'enqueue_scripts' ], 20 );

		// Add JS object for app.js.
		add_action( 'wp_enqueue_scripts', [ __CLASS__, 'add_js_object' ], 20 );
	}

	/**
	 * Enqueue CSS files.
	 *
	 * Add current theme version to CSS files to make sure that the browsers
	 * do not load those file from its cache whenever version number of the theme
	 * is updated.
	 *
	 * Priorities:
	 * 10: Vendors css.
	 * 15: Child Theme Vendors css.
	 * 20: Plugins css.
	 * 30: app.css.
	 * 40: style.css.
	 * 50: Child Theme Plugins css.
	 * 60: Child Theme app.css.
	 * 70: Child Theme style.css.
	 *
	 * @return void
	 */
	public static function enqueue_styles() {
		$styles[] = [
			'handle'   => 'font-awesome-5',
			'uri'      => get_template_directory_uri() . '/dist/css/vendor/font-awesome.css',
			'version'  => '5.10.2',
			'priority' => 10,
		];

		$styles[] = [
			'handle'   => get_template() . '-app',
			'uri'      => get_template_directory_uri() . '/dist/css/app.css',
			'version'  => filemtime( get_template_directory() . '/dist/css/app.css' ),
			'priority' => 30,
		];

		$styles[] = [
			'handle'   => get_template(),
			'uri'      => get_template_directory_uri() . '/style.css',
			'version'  => filemtime( get_template_directory() . '/style.css' ),
			'priority' => 40,
		];

		$styles = apply_filters( 'aura_theme_styles', $styles );

		// Sort stylesheets according to their priority.
		usort( $styles, function ( $item1, $item2 ) {
			if ( absint( $item1['priority'] ) === absint( $item2['priority'] ) ) {
				return 0;
			}

			return $item1['priority'] < $item2['priority'] ? -1 : 1;
		} );

		// Enqueue css files.
		foreach ( $styles as $style ) {
			wp_enqueue_style( $style['handle'], $style['uri'], [], $style['version'] );
		}
	}

	/**
	 * Enqueue JS files.
	 *
	 * Add current theme version to JS files to make sure that the browsers
	 * do not load those file from its cache whenever version number of the theme
	 * is updated.
	 *
	 * Priorities:
	 * 10: Vendors js.
	 * 20: Plugins js.
	 * 30: app.js.
	 * 40: Child Theme app.js.
	 *
	 * @return void
	 */
	public static function enqueue_scripts() {
		$scripts[] = [
			'handle'       => get_template() . '-app',
			'uri'          => get_template_directory_uri() . '/dist/js/app.js',
			'version'      => filemtime( get_template_directory() . '/dist/js/app.js' ),
			'dependencies' => [ 'jquery' ],
			'in_footer'    => true,
			'priority'     => 30,
		];

		$scripts = apply_filters( 'aura_theme_scripts', $scripts );

		// Sort srcipts according to their priority.
		usort( $scripts, function ( $item1, $item2 ) {
			if ( absint( $item1['priority'] ) === absint( $item2['priority'] ) ) {
				return 0;
			}

			return $item1['priority'] < $item2['priority'] ? -1 : 1;
		} );

		// Enqueue js files.
		foreach ( $scripts as $script ) {
			wp_enqueue_script( $script['handle'], $script['uri'], $script['dependencies'], $script['version'], $script['in_footer'] );
		}

		// Conditionally enqueue comment reply JS file.
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}

	/**
	 * Add JS object for app.js.
	 *
	 * @return void
	 */
	public static function add_js_object() {
		wp_localize_script(
			get_template() . '-app',
			'auraPrimeApp',
			apply_filters( 'aura_theme_script_app_js_object', [] )
		);
	}
}
