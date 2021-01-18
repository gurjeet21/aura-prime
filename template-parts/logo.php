<?php
/**
 * The template for displaying Logo.
 *
 * This template can be overridden by copying it to
 * your-child-theme/template-parts/logo.php.
 *
 * @package MadeByAura\Prime
 * @author  MadeByAura.com
 *
 * @param array $args
 */

namespace MadeByAura\Prime;

defined( 'ABSPATH' ) || die();

use MadeByAura\WPTools\Utils;
use MadeByAura\WPTools\Markup;

// Merge incoming `$args` with defaults.
$args = array_replace_recursive( [
	'wrapper'      => '',
	'type'         => 'image',
	'variant'      => '',
	'image_url'    => '',
	'image_url_2x' => '',
	'image_srcset' => '',
	'image_alt'    => get_bloginfo( 'name' ),
	'url'          => get_site_url(),
	'tagline'      => '',
], $args );

// Conditional early exit.
if ( ! $args['type'] ) {
	get_template_part( 'template-parts/message', null, [
		'text' => __( '<var>type</var> is required to display <em>Logo</em>.', 'aura-prime' ),
	] );

	return;
}

// Set mod key.
$mod_key = $args['variant'] ? "logo_{$args['variant']}" : 'logo';

// Set default image_url.
if ( ! $args['image_url'] ) {
	$args['image_url'] = Base::get_mod( 'branding', $mod_key );
}

// Set default image_url_2x.
if ( ! $args['image_url_2x'] ) {
	$args['image_url_2x'] = Base::get_mod( 'branding', "{$mod_key}_2x" );
}

// Context.
$classes[] = 'aura-logo';

// Set type classes.
if ( $args['type'] ) {
	$classes[] = 'aura-logo--type-' . Utils::dashify( $args['type'] );
}

// Set variant classes.
if ( $args['variant'] ) {
	$classes[] = 'aura-logo--variant-' . Utils::dashify( $args['type'] );
}

// Srcset.
$srcset = '';

if ( $args['image_url_2x'] && $args['image_url'] !== $args['image_url_2x'] ) {
	$srcset = esc_url( $args['image_url'] ) . ' 1x, ' . esc_url( $args['image_url_2x'] ) . ' 2x';
}
?>

<div class="<?php Markup::echo_classes( $classes ); ?>">
	<a class="aura-logo__image-link" href="<?php echo esc_url( $args['url'] ); ?>">
		<img class="aura-logo__image-wrap" src="<?php echo esc_url( $args['image_url'] ); ?>" alt="image_alt">
	</a><!-- .aura-logo__image-link -->

	<?php if ( $args['tagline'] ) : ?>
		<div class="aura-logo__tagline">
			<?php echo esc_html( $args['tagline'] ); ?>
		</div><!-- .aura-logo__tagline -->
	<?php endif; ?>
</div><!-- .aura-logo -->
