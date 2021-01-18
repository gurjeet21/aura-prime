<?php
/**
 * Wrappers.
 *
 * @package MadeByAura\Prime\Plugins\WooCommerce\Hooks
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Plugins\WooCommerce\Hooks;

defined( 'ABSPATH' ) || die();

/**
 * Wrappers.
 */
class Wrappers {
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
		// Replace default content wrappers with our content wrappers.
		remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
		remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
		add_action( 'woocommerce_before_main_content', [ __CLASS__, 'content_wrapper_open' ], 10 );
		add_action( 'woocommerce_after_main_content', [ __CLASS__, 'content_wrapper_close' ], 10 );
	}

	/**
	 * Add opening content wrapper.
	 *
	 * @return void
	 */
	public static function content_wrapper_open() {
	?>
		<div class="aura-middle">
			<section class="aura-content">
				<div class="aura-content__container aura-container">
					<div class="aura-content__inner aura-inner">
					<main class="aura-content__main">
	<?php
	}

	/**
	 * Add closing content wrapper.
	 *
	 * @return void
	 */
	public static function content_wrapper_close() {
	?>
				<main><!-- .aura-content__main -->
				<?php get_sidebar(); ?>
				</div><!-- .aura-content__inner -->
			</div><!-- .aura-content__container -->
		</section><!-- .aura-content -->
	</div><!-- .aura-middle -->
	<?php
	}
}
