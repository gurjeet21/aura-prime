<?php
/**
 * CSS and JS files.
 *
 * @package MadeByAura\Prime\Plugins\Elementor\Hooks
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Plugins\Elementor\Hooks;

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
	 *
	 * @return void
	 */
	public static function add_hooks() {
		// Add css and js files to be enqueued.
		add_filter( 'aura_theme_styles', [ __CLASS__, 'add_styles' ], 20 );
		add_filter( 'aura_theme_scripts', [ __CLASS__, 'add_scripts' ], 20 );
	}

	/**
	 * Add stylesheets to be enqueued.
	 *
	 * @param  array $styles  Stylesheets to be enqueued.
	 * @return array
	 */
	public static function add_styles( $styles ) {
		$styles[] = [
			'handle'   => get_template() . '-elementor',
			'uri'      => get_template_directory_uri() . '/dist/css/elementor.css',
			'version'  => filemtime( get_template_directory( '/dist/css/elementor.css' ) ),
			'priority' => 20,
		];

		return $styles;
	}

	/**
	 * Add scripts to be enqueued.
	 *
	 * @param  array $scripts  Scripts to be enqueued.
	 * @return array
	 */
	public static function add_scripts( $scripts ) {
		$scripts[] = [
			'handle'       => get_template() . '-elementor-js',
			'uri'          => get_template_directory_uri() . '/dist/js/elementor.js',
			'version'      => filemtime( get_template_directory( '/dist/js/elementor.js' ) ),
			'dependencies' => [ 'jquery' ],
			'in_footer'    => true,
			'priority'     => 20,
		];

		return $scripts;
	}
}
