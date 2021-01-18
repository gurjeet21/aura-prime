<?php
/**
 * SocialSites.
 *
 * @package MadeByAura\Prime\Hooks
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Hooks;

defined( 'ABSPATH' ) || die();

use MadeByAura\Prime\Modules\SocialSites as SocialSitesComponent;

/**
 * SocialSites.
 */
class SocialSites {
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
		add_filter( 'aura_theme_choices_social_sites', [ __CLASS__, 'get_choices' ], 20 );
	}

	/**
	 * Get choices for social sites.
	 *
	 * @return array $choices
	 */
	public static function get_choices() {
		static $choices;

		if ( ! $choices ) {
			foreach ( SocialSitesComponent::get_data() as $id => $site ) {
				$choices[ $id ] = $site['text'];
			}
		}

		return $choices;
	}
}
