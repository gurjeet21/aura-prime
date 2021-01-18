<?php
/**
 * Setup.
 *
 * @package MadeByAura\Prime\Hooks
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Hooks;

defined( 'ABSPATH' ) || die();

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
	protected static function add_hooks() {
		// Theme setup.
		add_action( 'after_setup_theme', [ __CLASS__, 'theme_setup' ], 20 );

		// Use multiple textdomains while being compatible with translation systems.
		add_filter( 'override_load_textdomain', [ __CLASS__, 'override_load_textdomain' ], 20, 2 );

		// Set post types attached to a taxonomy to the main query on taxonomy templates.
		add_action( 'pre_get_posts', [ __CLASS__, 'set_taxonomy_query_post_type' ], 10 );
	}

	/**
	 * Sets up theme defaults and registers support for various WordPress
	 * features.
	 *
	 * @return void
	 */
	public static function theme_setup() {
		// Load theme textdomain.
		load_theme_textdomain( 'aura-prime', get_template_directory() . '/languages' );

		// Load the framework textdomain.
		load_textdomain( 'aura-wp-tools', '' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Switch default core markup to output valid HTML5.
		add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ] );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Register custom image sizes.
		add_image_size( Base::get_info( 'prefix' ) . 'thumbnail', 700, 467, true ); // 3:2
		add_image_size( Base::get_info( 'prefix' ) . 'content', 1040, 693, true ); // 3:2
		add_image_size( Base::get_info( 'prefix' ) . 'content_full', 1400, 933, true ); // 3:2

		// Set the content width in pixels, based on the theme's design and stylesheet.
		$GLOBALS['content_width'] = apply_filters( 'aura_theme_content_width', 1400 );
	}

	/**
	 * Allow our theme to have two textdomains and still work with translation
	 * systems.
	 *
	 * @see https://gist.github.com/justintadlock/7a605c29ae26c80878d0
	 *
	 * @param  bool   $override  Whether to override the .mo file loading.
	 * @param  string $domain    Text domain.
	 * @return mixed
	 */
	public static function override_load_textdomain( $override, $domain ) {
		// Check if the domain is our framework domain.
		if ( 'aura-wp-tools' === $domain ) {
			global $l10n;

			// If the theme's textdomain is loaded, assign the theme's translations
			// to the framework's textdomain.
			if ( isset( $l10n['aura-prime'] ) ) {
				$l10n[ $domain ] = $l10n['aura-prime'];
			}

			// Always override. We only want the theme to handle translations.
			$override = true;
		}

		return $override;
	}

	/**
	 * Set post types attached to a taxonomy to the main query on taxonomy
	 * templates.
	 *
	 * @param  object $query  Query variable object.
	 * @return void
	 */
	public static function set_taxonomy_query_post_type( $query ) {
		if ( $query->is_main_query() && $query->is_tax() ) {
			$current_taxonomy = $query->tax_query->queries[0]['taxonomy'];

			if ( $current_taxonomy ) {
				$taxonomy_meta = get_taxonomy( $current_taxonomy );
				$post_types    = $taxonomy_meta->object_type;
				$query->set( 'post_type', $post_types );
			}
		}
	}
}
