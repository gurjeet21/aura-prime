<?php
/**
 * Icons.
 *
 * @package MadeByAura\Prime\Hooks
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Hooks;

defined( 'ABSPATH' ) || die();

use MadeByAura\WPTools\Utils;

/**
 * Icons.
 */
class Icons {
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
		add_filter( 'aura_theme_choices_icons', [ __CLASS__, 'get_choices' ], 20 );
	}

	/**
	 * Get entry layout choices.
	 *
	 * @return array $choices.
	 */
	public static function get_choices() {
		static $choices;

		if ( ! $choices ) {
			$file_path = wp_normalize_path( get_template_directory() . '/dist/json/font-awesome.json' );
			$json      = Utils::get_file_content( $file_path );

			if ( $json ) {
				$choices = json_decode( $json, true );
			}
		}

		return $choices;
	}
}
