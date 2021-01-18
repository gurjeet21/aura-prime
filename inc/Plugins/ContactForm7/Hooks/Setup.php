<?php
/**
 * Setup.
 *
 * @package MadeByAura\Prime\Plugins\ContactForm7\Hooks
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Plugins\ContactForm7\Hooks;

defined( 'ABSPATH' ) || die();

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
	 */
	public static function add_hooks() {
		// Allow shortcodes in Contact Form 7.
		add_filter( 'wpcf7_form_elements', 'do_shortcode' );

		// Turn off auto p in Contact Form 7.
		add_filter( 'wpcf7_autop_or_not', '__return_false' );
	}
}
