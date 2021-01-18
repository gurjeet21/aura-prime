<?php
/**
 * Pagination.
 *
 * @package MadeByAura\Prime\Hooks
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Hooks;

defined( 'ABSPATH' ) || die();

/**
 * Pagination.
 */
class Pagination {
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
		// Add choices.
		add_filter( 'aura_theme_choices_pagination_type', [ __CLASS__, 'get_choices' ], 20 );
	}

	/**
	 * Get pagination choices.
	 *
	 * @return array $choices
	 */
	public static function get_choices() {
		static $choices;

		if ( ! $choices ) {
			$choices['links']     = __( 'Links', 'aura-prime' );
			$choices['numbers']   = __( 'Numbers', 'aura-prime' );
			$choices['load_more'] = __( 'Load More', 'aura-prime' );
		}

		return $choices;
	}
}
