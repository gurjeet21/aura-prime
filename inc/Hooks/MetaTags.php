<?php
/**
 * MetaTags.
 *
 * @package MadeByAura\Prime\Hooks
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Hooks;

defined( 'ABSPATH' ) || die();

use MadeByAura\Prime\Base;

/**
 * MetaTags.
 */
class MetaTags {
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
		// Add brand color in browsers that support it.
		add_action( 'wp_head', [ __CLASS__, 'add_browser_theme_color' ], 20 );
	}

	/**
	 * Add theme color in browsers that support it.
	 *
	 * @return void
	 */
	public static function add_browser_theme_color() {
		$color = Base::get_mod( 'branding', 'browser_theme_color' );

		// Conditional early exit.
		if ( ! $color ) {
			return;
		}

		?>
			<meta name="msapplication-TileColor" content="<?php echo esc_attr( $color ); ?>">
			<meta name="theme-color" content="<?php echo esc_attr( $color ); ?>">
		<?php
	}
}
