<?php
/**
 * Cf7Field.
 *
 * @package MadeByAura\Prime\Plugins\ContactForm7\Shortcodes
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Plugins\ContactForm7\Shortcodes;

defined( 'ABSPATH' ) || die();

use MadeByAura\WPTools\Markup;

/**
 * Cf7Field.
 */
class Cf7Field {
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
		add_shortcode( 'aura-cf7-field', [ __CLASS__, 'render' ] );
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
			'type'                  => '',
			'style'                 => '',
			'label'                 => '',
			'description'           => '',
			'align'                 => '',
			'button_type'           => 'alpha',
			'list-col-sm'           => '',
			'list-col-md'           => '',
			'list-col-lg'           => '',
			'list-col-xl'           => '',
			'list-col-2xl'          => '',
			'col-sm'                => '',
			'col-md'                => '',
			'col-lg'                => '',
			'col-xl'                => '',
			'col-2xl'               => '',
			'footer-note-separator' => ' ',
			'privacy-note'          => true,
			'privacy-note-text'     => __( 'We do not share your information with any third party or partners.<br>We hate spam as much as you.', 'aura-prime' ),
			'privacy-policy'        => true,
			// translators: 1. link of the privacy policy page.
			'privacy-policy-text'   => __( 'Read our <a href="%1$s">Privacy Policy</a>.', 'aura-prime' ),
			'privacy-policy-url'    => get_site_url() . '/privacy-policy',
		], $args );

		$classes[] = 'aura-cf7__field';
		$classes[] = $args['type'] ? 'aura-cf7__field--type-' . $args['type'] : '';
		$classes[] = $args['style'] ? 'aura-cf7__field--style-' . $args['style'] : '';
		$classes[] = $args['align'] ? 'aura-cf7__field--align-' . $args['align'] : '';
		$classes[] = $args['list-col-sm'] ? 'aura-cf7__field-list-col--sm-' . $args['list-col-sm'] : '';
		$classes[] = $args['list-col-md'] ? 'aura-cf7__field-list-col--md-' . $args['list-col-md'] : '';
		$classes[] = $args['list-col-lg'] ? 'aura-cf7__field-list-col--lg-' . $args['list-col-lg'] : '';
		$classes[] = $args['list-col-xl'] ? 'aura-cf7__field-list-col--xl-' . $args['list-col-xl'] : '';
		$classes[] = $args['list-col-2xl'] ? 'aura-cf7__field-list-col--2xl-' . $args['list-col-2xl'] : '';
		$classes[] = $args['col-sm'] ? 'aura-cf7-col--sm-' . $args['col-sm'] : '';
		$classes[] = $args['col-md'] ? 'aura-cf7-col--md-' . $args['col-md'] : '';
		$classes[] = $args['col-lg'] ? 'aura-cf7-col--lg-' . $args['col-lg'] : '';
		$classes[] = $args['col-xl'] ? 'aura-cf7-col--xl-' . $args['col-xl'] : '';
		$classes[] = $args['col-2xl'] ? 'aura-cf7-col--2xl-' . $args['col-2xl'] : '';

		ob_start();
		?>

		<div class="<?php Markup::echo_classes( $classes ); ?>">
			<div class="aura-cf7__field-inner">
				<?php if ( 'submit' === $args['type'] ) : ?>
					<?php
					$button_type = $args['button_type'] ? $args['button_type'] : 'alpha';

					get_template_part( 'template-parts/button', null, [
						'type'  => $button_type,
						'tag'   => 'button',
						'text'  => $args['label'] ? $args['label'] : __( 'Submit', 'aura-prime' ),
						'attrs' => [
							'class' => 'wpcf7-submit',
						],
					] );
					?>

				<?php elseif ( 'footer-note' === $args['type'] ) : ?>

					<?php
					$args['privacy-note'] = $args['privacy-note'] && 'false' !== $args['privacy-note'] ? true : false;

					$args['privacy-policy'] = $args['privacy-policy'] && 'false' !== $args['privacy-policy'] ? true : false;

					$text = '';

					if ( $args['privacy-note'] ) {
						$text .= $args['privacy-note-text'];
					}

					if ( $args['privacy-policy'] ) {
						if ( $args['privacy-note'] ) {
							$text .= $args['footer-note-separator'];
						}

						$text .= sprintf( $args['privacy-policy-text'], esc_url( $args['privacy-policy-url'] ) );
					}

					echo wp_kses( $text, [
						'a'  => [
							'href' => [],
						],
						'br' => [],
					] );
					?>
				<?php else : ?>
					<?php if ( $args['label'] ) : ?>
						<div class="aura-cf7__field-label">
							<?php echo esc_html( $args['label'] ); ?>
						</div><!-- .aura-cf7__field-label -->
					<?php endif; ?>

					<?php echo do_shortcode( $content ); ?>

					<?php
					if ( 'file' === $args['type'] ) {
						get_template_part( 'template-parts/button', null, [
							'type'            => 'beta',
							'tag'             => 'a',
							'icon_font_class' => 'fas fa-cloud-upload-alt',
							'icon_position'   => 'before_text',
							'text'            => __( 'Choose file', 'aura-prime' ),
						] );
					}
					?>
				<?php endif; ?>
			</div><!-- .aura-cf7__field-inner -->
		</div><!-- .aura-cf7__field -->
	<?php
		return ob_get_clean();
	}
}
