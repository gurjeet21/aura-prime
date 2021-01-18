<?php
/**
 * Bootstrap.
 *
 * @package MadeByAura\Prime
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime;

defined( 'ABSPATH' ) || die();

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
		// Site.
		Site\Content::get_instance();
		Site\Footer::get_instance();
		Site\Header::get_instance();
		Site\Main::get_instance();
		Site\Middle::get_instance();
		Site\Sidebar::get_instance();
		Site\Site::get_instance();

		// Hooks.
		Hooks\Setup::get_instance();
		Hooks\Scripts::get_instance();
		Hooks\MetaTags::get_instance();
		Hooks\WidgetAreas::get_instance();
		// Componenet Hooks.
		Hooks\Button::get_instance();
		Hooks\Comments::get_instance();
		Hooks\CustomCodes::get_instance();
		Hooks\Post::get_instance();
		Hooks\Icons::get_instance();
		Hooks\Menu::get_instance();
		Hooks\Pagination::get_instance();
		Hooks\ShareLinks::get_instance();
		Hooks\Sidebar::get_instance();
		Hooks\SocialSites::get_instance();
		Hooks\SVG::get_instance();
		Hooks\ResponsiveEmbeds::get_instance();
		Hooks\Branding::get_instance();

		// Widgets.
		Widgets\Bootstrap::get_instance();

		// Plugin Installer.
		PluginInstaller\Bootstrap::get_instance();

		// Plugins.
		Plugins\Kirki\Bootstrap::get_instance();
		Plugins\ACFPro\Bootstrap::get_instance();
		Plugins\Elementor\Bootstrap::get_instance();
		Plugins\ContactForm7\Bootstrap::get_instance();
		Plugins\WordpressSeo\Bootstrap::get_instance();
		Plugins\WooCommerce\Bootstrap::get_instance();
	}
}
