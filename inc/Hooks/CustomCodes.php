<?php
/**
 * Custom Codes.
 *
 * @package MadeByAura\Prime\Hooks
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Hooks;

defined( 'ABSPATH' ) || die();

use MadeByAura\Prime\Base;

/**
 * Custom Codes.
 */
class CustomCodes {
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
		add_action( 'wp_head', [ __CLASS__, 'add_code_before_closing_head_tag' ], 20 );
		add_action( 'wp_footer', [ __CLASS__, 'add_code_before_closing_body_tag' ], 20 );
	}

	/**
	 * Add code in the <head> tag.
	 *
	 * @return void
	 */
	public static function add_code_before_closing_head_tag() {
		$code = Base::get_acf( 'option', 'code_before_closing_head_tag' );

		if ( $code ) {
			echo $code; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}

	/**
	 * Add code in the in the footer above the closing <body> tag.
	 *
	 * @return void
	 */
	public static function add_code_before_closing_body_tag() {
		$code = Base::get_acf( 'option', 'code_before_closing_body_tag' );

		if ( $code ) {
			echo $code; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}
}
