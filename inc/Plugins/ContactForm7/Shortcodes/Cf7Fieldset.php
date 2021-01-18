<?php
/**
 * Cf7Fieldset.
 *
 * @package MadeByAura\Prime\Plugins\ContactForm7\Shortcodes
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Plugins\ContactForm7\Shortcodes;

defined( 'ABSPATH' ) || die();

/**
 * Cf7Fieldset.
 */
class Cf7Fieldset {
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
		add_shortcode( 'aura-cf7-fieldset', [ __CLASS__, 'render' ] );
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
			'title' => '',
		], $args );

		ob_start();
		?>

		<div class="aura-cf7__fieldset">
			<?php if ( $args['title'] ) : ?>
				<h3 class="aura-cf7__fieldset-title">
					<?php echo esc_html( $args['title'] ); ?>
				</h3>
			<?php endif; ?>

			<?php echo do_shortcode( $content ); ?>
		</div><!-- .aura-cf7__fieldset -->
		<?php
		return ob_get_clean();
	}
}
