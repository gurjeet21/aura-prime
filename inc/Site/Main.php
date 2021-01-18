<?php
/**
 * Main.
 *
 * @package MadeByAura\Prime\Site
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Site;

defined( 'ABSPATH' ) || die();

/**
 * Main.
 */
class Main {
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
		add_action( 'aura_theme_main_open', [ __CLASS__, 'open' ], 10 );
		add_action( 'aura_theme_main_close', [ __CLASS__, 'close' ], 10 );

		// Render posts.
		add_action( 'aura_theme_main', [ __CLASS__, 'render_posts' ], 10 );
	}

	/**
	 * Render opening tag.
	 *
	 * @return void
	 */
	public static function open() {
		?>
		<main class="aura-content__main">
		<?php
	}

	/**
	 * Render closing tag.
	 *
	 * @return void
	 */
	public static function close() {
		?>
		</main><!-- .aura-content__main -->
		<?php
	}

	/**
	 * Render posts.
	 *
	 * @return void
	 */
	public static function render_posts() {
		get_template_part( 'template-parts/posts' );
	}
}
