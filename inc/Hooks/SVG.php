<?php
/**
 * SVG.
 *
 * @package MadeByAura\Prime\Hooks
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Hooks;

defined( 'ABSPATH' ) || die();

use MadeByAura\Prime\Modules\SVG as SVGComponent;

/**
 * SVG.
 */
class SVG {
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
		// Add SVG sprite to the footer.
		add_action( 'wp_footer', [ __CLASS__, 'add_svg_sprite' ], 20 );

		// Add SVG specific tags to the kses allowed html.
		add_filter( 'wp_kses_allowed_html', [ __CLASS__, 'add_allowed_tags' ], 20, 2 );

		// Add choices.
		add_filter( 'aura_theme_choices_svg', [ __CLASS__, 'get_choices' ], 20 );

		// Allow upoading SVG files to the Media Library..
		add_action( 'upload_mimes', [ __CLASS__, 'add_svg_support' ], 20 );
		add_action( 'admin_head', [ __CLASS__, 'fix_svg_in_featured_thumbnail' ], 20 );
	}

	/**
	 * Add SVGs sprint to the footer.
	 *
	 * @return void
	 */
	public static function add_svg_sprite() {
		$files = SVGComponent::get_sprite_paths();

		if ( ! $files ) {
			return;
		}
	?>
		<div class="aura-svg-sprite">
			<?php foreach ( $files as $file ) : ?>
				<?php if ( file_exists( $file['svg'] ) ) : ?>
					<?php include_once $file['svg']; ?>
				<?php endif; ?>
			<?php endforeach; ?>
		</div><!-- .aura-svg-sprite -->

	<?php
	}

	/**
	 * Add SVG specific tags to WordPress' allowed post tags.
	 *
	 * @param  array  $allowedposttags  Theme choices.
	 * @param  string $context          Context.
	 * @return array
	 */
	public static function add_allowed_tags( $allowedposttags, $context ) {
		$allowedposttags['svg'] = [
			'class'       => true,
			'viewbox'     => true,
			'xmlns'       => true,
			'aria-hidden' => true,
		];

		$allowedposttags['use'] = [
			'xlink:href' => true,
		];

		return $allowedposttags;
	}

	/**
	 * Add SVG choices to theme choices.
	 *
	 * @return array  $choices
	 */
	public static function get_choices() {
		static $choices;

		if ( ! $choices ) {
			$choices = [];

			$data = SVGComponent::get_data();

			if ( is_array( $data ) && $data ) {
				foreach ( SVGComponent::get_data() as $svg_id => $svg_data ) {
					$choices[ $svg_id ] = $svg_data['title'];
				}
			}
		}

		return $choices;
	}

	/**
	 * Add SVG support.
	 *
	 * @param  array $mimes  Allowed mime types and file extensions.
	 * @return array $mimes
	 */
	public static function add_svg_support( $mimes ) {
		$mimes['svg'] = 'image/svg+xml';

		return $mimes;
	}

	/**
	 * Fix SVG in the Featured Thumbnail metabox on the Add Post page.
	 *
	 * @return void
	 */
	public static function fix_svg_in_featured_thumbnail() {
		ob_start();
		?>
		<style>
			#set-post-thumbnail,
			#set-post-thumbnail img {
				width: 100%;
			}
		</style>
		<?php
		echo ob_get_clean(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}
