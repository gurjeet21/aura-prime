<?php
/**
 * The template for displaying Excerpt in Post.
 *
 * This template can be overridden by copying it to
 * your-child-theme/template-parts/post/excerpt.php.
 *
 * @package MadeByAura\Prime
 * @author  MadeByAura.com
 *
 * @param array $args
 */

namespace MadeByAura\Prime;

defined( 'ABSPATH' ) || die();

// Merge incoming `$args` with defaults.
$args = array_replace_recursive( [
	'words' => 40,
], $args );

$excerpt = get_the_excerpt();

if ( ! has_excerpt() || ! $excerpt ) {
	$excerpt = wp_trim_words( get_the_content(), $args['words'] );
}
?>

<div class="aura-post__excerpt">
	<?php echo wp_kses_post( $excerpt ); ?>
</div><!-- .aura-post__excerpt -->
