<?php
/**
 * Branding.
 *
 * @package MadeByAura\Prime\Hooks
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Hooks;

defined( 'ABSPATH' ) || die();

/**
 * Branding.
 */
class Branding {
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
	 */
	protected static function add_hooks() {
		// Replace login logo image.
		add_action( 'login_enqueue_scripts', [ __CLASS__, 'replace_login_logo_image' ] );

		// Replace login logo link.
		add_action( 'login_headerurl', [ __CLASS__, 'replace_login_logo_link' ] );

		// Add admin bar menu item.
		add_action( 'admin_bar_menu', [ __CLASS__, 'add_admin_bar_menu_item' ], 80 );

		// Update dashboard footers text left.
		add_filter( 'admin_footer_text', [ __CLASS__, 'update_dashboard_footer_text_left' ] );

		// Update dashboard footer text right.
		add_filter( 'update_footer', [ __CLASS__, 'update_dashboard_footer_text_right' ], 20 );
	}

	/**
	 * Replace login logo image.
	 *
	 * @return void
	 */
	public static function replace_login_logo_image() {
		?>
		<style type="text/css">
			body.login {
				background-image: linear-gradient(45deg, #f5f5f5 12.50%, #ffffff 12.50%, #ffffff 50%, #f5f5f5 50%, #f5f5f5 62.50%, #ffffff 62.50%, #ffffff 100%);
				background-size: 5.66px 5.66px;
			}
			body.login h1 a {
				width: 278px !important;
				height: 49px !important;
				margin: 0 auto !important;
				background-image: url('data:image/svg+xml;utf8,<svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 526.5 92" xml:space="preserve"><path d="M391.8 50.8V22.5h12.7v28.3c0 6.2 3.7 10.3 9.8 10.3 6.1 0 9.8-4 9.8-10.3V22.5h12.7v28.3c0 13.8-8.5 21.9-22.5 21.9s-22.5-8.1-22.5-21.9zm51.4 20.7v-49h12.1v6.6c3-5.3 7.5-7.9 13.5-7.9 2 0 4 .4 5.9 1.1l-1.1 12.1c-2.1-.6-4-1-5.8-1-7.2 0-12 4.7-12 14.8v23.3h-12.6zm71.3-49h12.1v49h-12.1v-5.7c-4.2 4.6-9.4 6.8-15.7 6.8-7 0-12.9-2.4-17.5-7.4-4.6-4.9-6.8-11.2-6.8-18.5s2.3-13.5 6.9-18.3c4.6-4.9 10.4-7.3 17.4-7.3 6.1 0 11.3 2.3 15.7 7.1v-5.7zM510.7 37c-2.6-2.8-5.9-4.1-9.8-4.1-4 0-7.3 1.3-9.9 4.1-2.5 2.8-3.8 6.1-3.8 10 0 4 1.3 7.3 3.9 10.1 2.6 2.8 5.9 4.1 9.8 4.1 4 0 7.2-1.3 9.8-4.1 2.6-2.8 4-6.1 4-10.1-.1-3.9-1.4-7.2-4-10z"/><path d="M0 71.5V5h2.4l29.2 43 29-43h2.5v66.5h-5.5V18.6L32.3 56.2H31L5.5 18.7v52.8H0zm114.6-48.1h5.2v48.1h-5.2v-9.4c-4 6.6-11 10.5-19 10.5-6.8 0-12.5-2.4-17.1-7.3-4.6-4.9-6.8-11-6.8-18.2 0-7.1 2.3-13 6.8-17.8 4.6-4.8 10.3-7.2 17.2-7.2 8 0 14.9 3.9 19 10.4v-9.1zm-5 38.4c3.6-4 5.4-8.8 5.4-14.6 0-5.6-1.8-10.3-5.4-14.2s-8.2-5.8-13.8-5.8c-5.5 0-10.1 2-13.6 5.8S77 41.8 77 47.4c0 5.8 1.7 10.6 5.2 14.5 3.5 3.9 8.1 5.8 13.6 5.8 5.6.1 10.2-1.9 13.8-5.9zm60.1-58.2h5.4v67.9h-5.4v-9.4c-4 6.7-10.9 10.6-19.1 10.6-6.8 0-12.5-2.4-17.1-7.3-4.6-5-6.8-10.9-6.8-18s2.3-13 6.8-17.9c4.6-4.9 10.3-7.3 17.1-7.3 8.2 0 15 4 19.1 10.5V3.6zm-5 58.2c3.6-4 5.4-8.8 5.4-14.5 0-5.6-1.8-10.3-5.4-14.2-3.6-3.9-8.2-5.8-13.8-5.8-5.5 0-10.1 2-13.6 5.8-3.5 3.9-5.2 8.7-5.2 14.4s1.7 10.5 5.2 14.4c3.5 3.9 8.1 5.8 13.6 5.8 5.6.1 10.2-1.9 13.8-5.9zm63.5-12.2h-40.5c.8 10.7 7.7 18 19.5 18 6.2 0 13.3-2.3 17.6-5.8l2.5 4.1c-4.7 3.7-12.3 6.7-20.3 6.7-17.7 0-25-12.7-25-25.3 0-7.3 2.2-13.2 6.6-18 4.4-4.8 10.2-7.1 17.4-7.1 6.5 0 11.8 2.1 16 6.3 4.2 4.1 6.4 9.7 6.4 16.8.1.7 0 2.1-.2 4.3zm-40.5-5h35.2c-.1-10.7-7-17.5-16.8-17.5-10.1.1-17.3 7-18.4 17.5zm95.2 8c0 5.1-1.8 9.5-5.5 13.3-3.7 3.7-8.8 5.6-15.6 5.6H237V5h23.9c5.8 0 10.4 1.6 13.6 4.9 3.2 3.2 4.9 7.1 4.9 11.6 0 6.4-3.7 12.1-9.4 14 8.2 2.3 12.9 9.3 12.9 17.1zm-40.4-42.3v23.1h18.9c7.3 0 12.4-5.2 12.4-11.8 0-6.6-4.9-11.3-13.4-11.3h-17.9zm18.9 56c4.8 0 8.5-1.3 11.4-4 3-2.7 4.4-6 4.4-10s-1.4-7.2-4.4-9.8c-3-2.6-6.8-4-11.5-4h-18.8v27.7h18.9zm61.7-42.9h5.9l-20.3 51.7c-4.8 12.2-9.2 16.8-16.5 16.8-2.5 0-4.9-.5-6.9-1.7l.8-4.8c2.2 1 4.1 1.4 5.9 1.4 5 0 8.4-4.1 11.5-12.3l1.2-3.1-20.5-48.1h5.9l17.2 41.1 15.8-41z"/><path d="M378.6 71.5H392L356.2 0h-.4L320 71.5h13.4l.8-1.5c3.9-7.3 9.1-12.3 20.6-12.3l6.1-12.2c-6 0-11 .3-15.1 1.6l10.3-20.3 22.5 44.7z"/></svg>');
				background-size: 278px 49px !important;
			}
			.login form {
				margin-top: 15px;
			}
			.login #nav, .login #backtoblog {
				padding: 0 !important;
				margin-top: 20px !important;
			}
			.login #nav {
				float: right;
			}
		</style>
		<?php
	}

	/**
	 * Replace login logo link.
	 *
	 * @return string
	 */
	public static function replace_login_logo_link() {
		return esc_url( 'https://madebyaura.com/' );
	}

	/**
	 * Add admin bar menu item.
	 *
	 * @param mixed $admin_bar add menu.
	 * @return void
	 */
	public static function add_admin_bar_menu_item( $admin_bar ) {
		$admin_bar->add_menu( [
			'id'     => 'madebyaura-link',
			'title'  => 'MadeByAura.com',
			'href'   => 'https://madebyaura.com',
			'target' => '_blank',
			'meta'   => [
				'target' => '_blank',
			],
		] );
	}

	/**
	 * Update dashboard footer text left.
	 *
	 * @return void
	 */
	public static function update_dashboard_footer_text_left() {
	?>
		<a style="display: block;" target="_blank" href="https://madebyaura.com/">MadeByAura.com</a>
		Powered by WordPress v<?php echo bloginfo( 'version' ); ?>
	<?php
	}

	/**
	 * Update dashboard footer text right.
	 *
	 * @return void
	 */
	public static function update_dashboard_footer_text_right() {
	?>
		<a style="display: block;width:172px" target="_blank" href="https://madebyaura.com/">
			<svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 526.5 92" xml:space="preserve"><path d="M391.8 50.8V22.5h12.7v28.3c0 6.2 3.7 10.3 9.8 10.3 6.1 0 9.8-4 9.8-10.3V22.5h12.7v28.3c0 13.8-8.5 21.9-22.5 21.9s-22.5-8.1-22.5-21.9zm51.4 20.7v-49h12.1v6.6c3-5.3 7.5-7.9 13.5-7.9 2 0 4 .4 5.9 1.1l-1.1 12.1c-2.1-.6-4-1-5.8-1-7.2 0-12 4.7-12 14.8v23.3h-12.6zm71.3-49h12.1v49h-12.1v-5.7c-4.2 4.6-9.4 6.8-15.7 6.8-7 0-12.9-2.4-17.5-7.4-4.6-4.9-6.8-11.2-6.8-18.5s2.3-13.5 6.9-18.3c4.6-4.9 10.4-7.3 17.4-7.3 6.1 0 11.3 2.3 15.7 7.1v-5.7zM510.7 37c-2.6-2.8-5.9-4.1-9.8-4.1-4 0-7.3 1.3-9.9 4.1-2.5 2.8-3.8 6.1-3.8 10 0 4 1.3 7.3 3.9 10.1 2.6 2.8 5.9 4.1 9.8 4.1 4 0 7.2-1.3 9.8-4.1 2.6-2.8 4-6.1 4-10.1-.1-3.9-1.4-7.2-4-10z"/><path d="M0 71.5V5h2.4l29.2 43 29-43h2.5v66.5h-5.5V18.6L32.3 56.2H31L5.5 18.7v52.8H0zm114.6-48.1h5.2v48.1h-5.2v-9.4c-4 6.6-11 10.5-19 10.5-6.8 0-12.5-2.4-17.1-7.3-4.6-4.9-6.8-11-6.8-18.2 0-7.1 2.3-13 6.8-17.8 4.6-4.8 10.3-7.2 17.2-7.2 8 0 14.9 3.9 19 10.4v-9.1zm-5 38.4c3.6-4 5.4-8.8 5.4-14.6 0-5.6-1.8-10.3-5.4-14.2s-8.2-5.8-13.8-5.8c-5.5 0-10.1 2-13.6 5.8S77 41.8 77 47.4c0 5.8 1.7 10.6 5.2 14.5 3.5 3.9 8.1 5.8 13.6 5.8 5.6.1 10.2-1.9 13.8-5.9zm60.1-58.2h5.4v67.9h-5.4v-9.4c-4 6.7-10.9 10.6-19.1 10.6-6.8 0-12.5-2.4-17.1-7.3-4.6-5-6.8-10.9-6.8-18s2.3-13 6.8-17.9c4.6-4.9 10.3-7.3 17.1-7.3 8.2 0 15 4 19.1 10.5V3.6zm-5 58.2c3.6-4 5.4-8.8 5.4-14.5 0-5.6-1.8-10.3-5.4-14.2-3.6-3.9-8.2-5.8-13.8-5.8-5.5 0-10.1 2-13.6 5.8-3.5 3.9-5.2 8.7-5.2 14.4s1.7 10.5 5.2 14.4c3.5 3.9 8.1 5.8 13.6 5.8 5.6.1 10.2-1.9 13.8-5.9zm63.5-12.2h-40.5c.8 10.7 7.7 18 19.5 18 6.2 0 13.3-2.3 17.6-5.8l2.5 4.1c-4.7 3.7-12.3 6.7-20.3 6.7-17.7 0-25-12.7-25-25.3 0-7.3 2.2-13.2 6.6-18 4.4-4.8 10.2-7.1 17.4-7.1 6.5 0 11.8 2.1 16 6.3 4.2 4.1 6.4 9.7 6.4 16.8.1.7 0 2.1-.2 4.3zm-40.5-5h35.2c-.1-10.7-7-17.5-16.8-17.5-10.1.1-17.3 7-18.4 17.5zm95.2 8c0 5.1-1.8 9.5-5.5 13.3-3.7 3.7-8.8 5.6-15.6 5.6H237V5h23.9c5.8 0 10.4 1.6 13.6 4.9 3.2 3.2 4.9 7.1 4.9 11.6 0 6.4-3.7 12.1-9.4 14 8.2 2.3 12.9 9.3 12.9 17.1zm-40.4-42.3v23.1h18.9c7.3 0 12.4-5.2 12.4-11.8 0-6.6-4.9-11.3-13.4-11.3h-17.9zm18.9 56c4.8 0 8.5-1.3 11.4-4 3-2.7 4.4-6 4.4-10s-1.4-7.2-4.4-9.8c-3-2.6-6.8-4-11.5-4h-18.8v27.7h18.9zm61.7-42.9h5.9l-20.3 51.7c-4.8 12.2-9.2 16.8-16.5 16.8-2.5 0-4.9-.5-6.9-1.7l.8-4.8c2.2 1 4.1 1.4 5.9 1.4 5 0 8.4-4.1 11.5-12.3l1.2-3.1-20.5-48.1h5.9l17.2 41.1 15.8-41z"/><path d="M378.6 71.5H392L356.2 0h-.4L320 71.5h13.4l.8-1.5c3.9-7.3 9.1-12.3 20.6-12.3l6.1-12.2c-6 0-11 .3-15.1 1.6l10.3-20.3 22.5 44.7z"/></svg>
		</a>
	<?php
	}
}
