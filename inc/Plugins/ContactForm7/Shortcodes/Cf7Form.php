<?php
/**
 * Cf7Form.
 *
 * @package MadeByAura\Prime\Plugins\ContactForm7\Shortcodes
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Plugins\ContactForm7\Shortcodes;

use MadeByAura\WPTools\Markup;

defined( 'ABSPATH' ) || die();

/**
 * Cf7Form.
 */
class Cf7Form {
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
		self::register_shortcodes();
	}

	/**
	 * Register shortcodes.
	 *
	 * @return void
	 */
	public static function register_shortcodes() {
		add_shortcode( 'aura-cf7-form', [ __CLASS__, 'render' ] );
	}

	/**
	 * Render shortcode.
	 *
	 * @param  array  $args     Shorcode arguments.
	 * @param  string $content  Shorcode content.
	 * @return string
	 */
	public static function render( $args, $content = null ) {
		$args = shortcode_atts( [
			'type' => apply_filters( 'aura_theme_contact_form_7_default_type', 'default' ),
		], $args );

		ob_start();

		$classes[] = 'aura-cf7__form';
		$classes[] = 'aura-cf7__form--type-' . $args['type'];
		?>

		<div class="<?php Markup::echo_classes( $classes ); ?>">
			<?php echo do_shortcode( $content ); ?>
		</div><!-- .aura-cf7__form -->
		<?php
		return ob_get_clean();
	}
}
