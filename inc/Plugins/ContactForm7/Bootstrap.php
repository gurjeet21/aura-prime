<?php
/**
 * Contact Form 7 integeration file.
 *
 * @link https://wordpress.org/plugins/contact-form-7/
 *
 * @package MadeByAura\Prime\Plugins\ContactForm7
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Plugins\ContactForm7;

defined( 'ABSPATH' ) || die();

use MadeByAura\WPTools\Utils;

/**
 * Bootstrap.
 */
class Bootstrap {
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
		if ( Utils::is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) {
			// Hooks.
			Hooks\Setup::get_instance();
			Hooks\Scripts::get_instance();

			// Shortcodes.
			Shortcodes\Cf7Form::get_instance();
			Shortcodes\Cf7Fieldset::get_instance();
			Shortcodes\Cf7Field::get_instance();
		}
	}
}
