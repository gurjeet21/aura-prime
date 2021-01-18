<?php
/**
 * CSS and JS files.
 *
 * @package MadeByAura\Prime\Plugins\ContactForm7\Hooks
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Plugins\ContactForm7\Hooks;

defined( 'ABSPATH' ) || die();

/**
 * Scripts.
 */
class Scripts {
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
	public static function add_hooks() {
		// Add css and js files to be enqueued.
		add_filter( 'aura_theme_styles', [ __CLASS__, 'add_styles' ], 20 );
		add_filter( 'aura_theme_scripts', [ __CLASS__, 'add_scripts' ], 20 );

		// Add Contact Form 7 event tracking code for Google Analytics.
		add_action( 'wp_footer', [ __CLASS__, 'add_event_tacking_code' ], 20 );
	}

	/**
	 * Add stylesheets to be enqueued.
	 *
	 * @param  array $styles  Stylesheets to be enqueued.
	 * @return array
	 */
	public static function add_styles( $styles ) {
		$styles[] = [
			'handle'   => 'lightpick',
			'uri'      => get_template_directory_uri() . '/dist/css/vendor/lightpick.css',
			'version'  => '1.2.6',
			'priority' => 10,
		];

		$styles[] = [
			'handle'   => get_template() . '-contact-form-7',
			'uri'      => get_template_directory_uri() . '/dist/css/contact-form-7.css',
			'version'  => filemtime( get_template_directory( '/dist/css/contact-form-7.css' ) ),
			'priority' => 20,
		];

		return $styles;
	}

	/**
	 * Add scripts to be enqueued.
	 *
	 * @param  array $scripts  Scripts to be enqueued.
	 * @return array
	 */
	public static function add_scripts( $scripts ) {
		$scripts[] = [
			'handle'       => 'autosize-js',
			'uri'          => get_template_directory_uri() . '/dist/js/vendor/autosize.js',
			'version'      => '4.0.2',
			'dependencies' => [ 'jquery' ],
			'in_footer'    => true,
			'priority'     => 10,
		];

		$scripts[] = [
			'handle'       => 'moment-js',
			'uri'          => get_template_directory_uri() . '/dist/js/vendor/moment.js',
			'version'      => '2.22.2',
			'dependencies' => [],
			'in_footer'    => true,
			'priority'     => 10,
		];

		$scripts[] = [
			'handle'       => 'lightpick-js',
			'uri'          => get_template_directory_uri() . '/dist/js/vendor/lightpick.js',
			'version'      => '1.2.6',
			'dependencies' => [ 'moment-js' ],
			'in_footer'    => true,
			'priority'     => 10,
		];

		$scripts[] = [
			'handle'       => get_template() . '-contact-form-7-js',
			'uri'          => get_template_directory_uri() . '/dist/js/contact-form-7.js',
			'version'      => filemtime( get_template_directory( '/dist/js/contact-form-7.js' ) ),
			'dependencies' => [ 'jquery' ],
			'in_footer'    => true,
			'priority'     => 20,
		];

		return $scripts;
	}

	/**
	 * Add Contact Form 7 event tracking code for Google Analytics.
	 *
	 * @link https://contactform7.com/tracking-form-submissions-with-google-analytics/
	 */
	public static function add_event_tacking_code() {
		?>
			<script>
				if (typeof window.ga !== 'undefined') {
					document.addEventListener('wpcf7mailsent', function (event) {
						ga('send', 'event', 'Contact Form', 'submit');
					}, false);
				}
			</script>
		<?php
	}
}
