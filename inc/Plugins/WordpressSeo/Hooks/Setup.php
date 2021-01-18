<?php
/**
 * Setup.
 *
 * @package MadeByAura\Prime\Plugins\WordpressSeo\Hooks
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Plugins\WordpressSeo\Hooks;

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
	 *
	 * @return void
	 */
	protected static function add_hooks() {
		// Change priority of Yoast SEO metabox.
		add_filter( 'wpseo_metabox_prio', [ __CLASS__, 'change_metabox_priority' ], 20 );
	}

	/**
	 * Change priority of Yoast SEO metabox to 'low'.
	 *
	 * @return string
	 */
	public static function change_metabox_priority() {
		return 'low';
	}
}
