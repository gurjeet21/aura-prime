<?php
/**
 * The template for displaying Terms in Post.
 *
 * This template can be overridden by copying it to
 * your-child-theme/template-parts/post/terms.php.
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
	'taxonomy'  => 'category',
	'title'     => '',
	'separator' => ', ',
], $args );

// Conditional early exit.
if ( ! $args['taxonomy'] ) {
	get_template_part( 'template-parts/message', [
		'text' => __( '<var>taxonomy</var> is required to display <em>Entry Terms</em>.', 'aura-prime' ),
	] );

	return;
}

$terms = get_the_term_list( null, $args['taxonomy'], '', $args['separator'], '' );

// Conditional early exit.
if ( ! $terms ) {
	return;
}

// Classes.
$classes[] = 'aura-post__terms';

// Taxonomy context.
$classes[] = 'aura-post__terms--taxonomy-' . Utils::dashify( $args['taxonomy'] );
?>

<div class="<?php Markup::echo_classes( $classes ); ?>">
	<?php if ( $args['title'] ) : ?>
		<div class="aura-post__terms-title">
			<?php echo esc_html( $args['title'] ); ?>
		</div><!-- .aura-post__terms-title -->
	<?php endif; ?>

	<div class="aura-post__terms-text">
		<?php echo wp_kses_post( $terms ); ?>
	</div><!-- .aura-post__terms-text -->
</div><!-- .aura-post__terms -->
