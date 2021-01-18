<?php
/**
 * Post.
 *
 * @package MadeByAura\Prime\Hooks
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Hooks;

defined( 'ABSPATH' ) || die();

/**
 * Post.
 */
class Post {
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
		add_filter( 'aura_theme_choices_post_layout', [ __CLASS__, 'get_layout_choices' ], 20 );
	}

	/**
	 * Get Post layout choices.
	 *
	 * @return array $choices.
	 */
	public static function get_layout_choices() {
		static $choices;

		if ( ! $choices ) {
			$choices['standard'] = __( 'Standard', 'aura-prime' );
			$choices['list']     = __( 'List', 'aura-prime' );
			$choices['grid']     = __( 'Grid', 'aura-prime' );
		}

		return $choices;
	}
}
