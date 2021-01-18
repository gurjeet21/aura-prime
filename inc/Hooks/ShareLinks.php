<?php
/**
 * Share Links.
 *
 * @package MadeByAura\Prime\Hooks
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Hooks;

defined( 'ABSPATH' ) || die();

use MadeByAura\Prime\Modules\ShareLinks as ShareLinksComponent;

/**
 * Share Links.
 */
class ShareLinks {
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
		add_filter( 'aura_theme_choices_share_links', [ __CLASS__, 'get_choices' ], 20 );
		add_filter( 'aura_theme_choices_share_links_icon_style', [ __CLASS__, 'get_icon_style_choices' ], 20 );
		add_filter( 'aura_theme_choices_share_links_button_style', [ __CLASS__, 'get_button_style_choices' ], 20 );
	}

	/**
	 * Get choices for social links.
	 *
	 * @return array $choices
	 */
	public static function get_choices() {
		static $choices;

		if ( ! $choices ) {
			foreach ( ShareLinksComponent::get_data() as $id => $site ) {
				$choices[ $id ] = $site['name'];
			}
		}

		return $choices;
	}

	/**
	 * Get choices for social links icon styles.
	 *
	 * @return array $choices
	 */
	public static function get_icon_style_choices() {
		static $choices;

		if ( ! $choices ) {
			$choices['icons']   = __( 'Icons', 'aura-prime' );
			$choices['buttons'] = __( 'Buttons', 'aura-prime' );
		}

		return $choices;
	}

	/**
	 * Get choices for social links button styles.
	 *
	 * @return array $choices
	 */
	public static function get_button_style_choices() {
		static $choices;

		if ( ! $choices ) {
			$choices['classic']  = __( 'Classic', 'aura-prime' );
			$choices['priority'] = __( 'Priority', 'aura-prime' );
		}

		return $choices;
	}
}
