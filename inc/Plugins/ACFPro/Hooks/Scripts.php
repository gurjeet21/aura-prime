<?php
/**
 * CSS and JS files.
 *
 * @package MadeByAura\Prime\Plugins\ACFPro\Hooks
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Plugins\ACFPro\Hooks;

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
		// Add styles.
		add_action( 'acf/input/admin_head', [ __CLASS__, 'add_styles' ] );
	}

	/**
	 * Add styles.
	 *
	 * @return void
	 */
	public static function add_styles() {
		?>
			<style type="text/css">
				.acf-oembed.has-value .canvas {
					min-height: 50px;
				}

				.acf-repeater .acf-row:nth-child(odd) > .acf-row-handle {
					background: #e9e9e9;
					color: #777;
				}

				.aura-acf-borderless-children .acf-fields {
					border: 0;
				}

				.aura-acf-borderless-children .acf-fields .acf-field {
					border: 0;
					padding: 0;
				}

				.aura-acf-borderless-children .acf-fields .acf-field + .acf-field {
					padding-top: 10px;
				}
			</style>
		<?php
	}
}
