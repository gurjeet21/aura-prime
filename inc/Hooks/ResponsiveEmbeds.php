<?php
/**
 * Responsive Embedded.
 *
 * @package MadeByAura\Prime\Hooks
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Hooks;

defined( 'ABSPATH' ) || die();

/**
 * ResponsiveEmbeds.
 */
class ResponsiveEmbeds {
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
	 * Register hooks.
	 *
	 * @return void
	 */
	protected static function add_hooks() {
		add_filter( 'embed_oembed_html', [ __CLASS__, 'embedded_html' ] );
	}

	/**
	 * Add class in embedded link.
	 *
	 * @param  array $code Embedded iframe.
	 * @return string
	 */
	public static function embedded_html( $code ) {
		if ( false !== strpos( $code, 'youtube.com' ) || false !== strpos( $code, 'youtu.be' ) ) {
			$code = '<div class="aura-responsive-video">' . $code . '</div>';
		}
		return $code;
	}
}
