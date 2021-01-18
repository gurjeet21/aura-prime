<?php
/**
 * Header.
 *
 * @package MadeByAura\Prime\Site
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Site;

defined( 'ABSPATH' ) || die();

/**
 * Footer.
 */
class Header {
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
		add_action( 'aura_theme_header_open', [ __CLASS__, 'open' ], 10 );
		add_action( 'aura_theme_header_close', [ __CLASS__, 'close' ], 10 );
	}

	/**
	 * Render opening tag.
	 *
	 * @return void
	 */
	public static function open() {
		?>
		<header class="aura-header">
		<?php
	}

	/**
	 * Render closing tag.
	 *
	 * @return void
	 */
	public static function close() {
		?>
		</header><!-- .aura-header -->
		<?php
	}
}
