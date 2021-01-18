<?php
/**
 * General.
 *
 * @package MadeByAura\Prime\Plugins\WooCommerce\Hooks
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Plugins\WooCommerce\Hooks;

defined( 'ABSPATH' ) || die();

/**
 * General.
 */
class General {
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
		// Change number of related products displayed.
		add_action( 'woocommerce_output_related_products_args', [ __CLASS__, 'change_related_products_count' ], 10 );

		// Add quantity input buttons.
		add_action( 'woocommerce_before_quantity_input_field', [ __CLASS__, 'add_minus_button' ], 10 );
		add_action( 'woocommerce_after_quantity_input_field', [ __CLASS__, 'add_plus_button' ], 10 );
	}

	/**
	 * Change number of related products displayed.
	 *
	 * @param  array $args  Query argunments.
	 * @return array $args
	 */
	public static function change_related_products_count( $args ) {
		$args['columns']        = 3;
		$args['posts_per_page'] = 3;

		return $args;
	}

	/**
	 * Add minus button to quatity input.
	 */
	public static function add_minus_button() {
		?>
			<div href="#" class="quantity-minus">
				<span class="screen-reader-text">">
					<?php esc_html_e( 'Subtract Quantity', 'aura-prime' ); ?>
				</span>
			</div>
		<?php
	}

	/**
	 * Add plus button to quantity input.
	 */
	public static function add_plus_button() {
		?>
			<div href="#" class="quantity-plus">
				<span class="screen-reader-text">">
					<?php esc_html_e( 'Add Quantity', 'aura-prime' ); ?>
				</span>
			</div>
		<?php
	}
}
