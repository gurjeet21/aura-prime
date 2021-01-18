<?php
/**
 * Content.
 *
 * @package MadeByAura\Prime\Site
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Site;

defined( 'ABSPATH' ) || die();

/**
 * Content.
 */
class Content {
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
		// Add opening and closing tags.
		add_action( 'aura_theme_content_open', [ __CLASS__, 'open' ], 10 );
		add_action( 'aura_theme_content_close', [ __CLASS__, 'close' ], 10 );

		// Add opening and closing tags for container.
		add_action( 'aura_theme_content_open', [ __CLASS__, 'open_container' ], 10 );
		add_action( 'aura_theme_content_close', [ __CLASS__, 'close_container' ], 10 );

		// Add opening and closing tags for inner.
		add_action( 'aura_theme_content_open', [ __CLASS__, 'open_inner' ], 10 );
		add_action( 'aura_theme_content_close', [ __CLASS__, 'close_inner' ], 10 );

		// Render main and sidebar.
		add_action( 'aura_theme_content', [ __CLASS__, 'render_main' ], 10 );
		add_action( 'aura_theme_content', [ __CLASS__, 'render_sidebar' ], 20 );
	}

	/**
	 * Render opening tag.
	 *
	 * @return void
	 */
	public static function open() {
		?>
		<div class="aura-content">
		<?php
	}

	/**
	 * Render closing tag.
	 *
	 * @return void
	 */
	public static function close() {
		?>
		</div><!-- .aura-content -->
		<?php
	}

	/**
	 * Render opening tag for container.
	 *
	 * @return void
	 */
	public static function open_container() {
		?>
		<div class="aura-container">
		<?php
	}

	/**
	 * Render closing tag for container.
	 *
	 * @return void
	 */
	public static function close_container() {
		?>
		</div><!-- .aura-container -->
		<?php
	}

	/**
	 * Render opening tag for inner.
	 *
	 * @return void
	 */
	public static function open_inner() {
		?>
		<div class="aura-content__inner">
		<?php
	}

	/**
	 * Render closing tag for inner.
	 *
	 * @return void
	 */
	public static function close_inner() {
		?>
		</div><!-- .aura-content__inner -->
		<?php
	}

	/**
	 * Render main.
	 *
	 * @return void
	 */
	public static function render_main() {
		get_template_part( 'template-parts/site/main' );
	}

	/**
	 * Render sidebar.
	 *
	 * @return void
	 */
	public static function render_sidebar() {
		get_template_part( 'template-parts/site/sidebar' );
	}
}
