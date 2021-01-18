<?php
/**
 * Sidebar.
 *
 * @package MadeByAura\Prime\Site
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Site;

defined( 'ABSPATH' ) || die();

/**
 * Sidebar.
 */
class Sidebar {
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
		add_action( 'aura_theme_sidebar_open', [ __CLASS__, 'open' ], 10 );
		add_action( 'aura_theme_sidebar_close', [ __CLASS__, 'close' ], 10 );

		// Render widget area.
		add_action( 'aura_theme_sidebar', [ __CLASS__, 'render_widget_area' ], 10 );
	}

	/**
	 * Render opening tag.
	 *
	 * @return void
	 */
	public static function open() {
		?>
		<aside class="aura-content__sidebar">
		<?php
	}

	/**
	 * Render closing tag.
	 *
	 * @return void
	 */
	public static function close() {
		?>
		</aside><!-- .aura-content__sidebar -->
		<?php
	}

	/**
	 * Render widget area.
	 *
	 * @return void
	 */
	public static function render_widget_area() {
		get_template_part( 'template-parts/sidebar/widget-area' );
	}
}
