<?php
/**
 * The template for displaying Author in Post.
 *
 * This template can be overridden by copying it to
 * your-child-theme/template-parts/post/author.php.
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
	'title' => __( 'By', 'aura-prime' ),
], $args );
?>

<div class="aura-post__author">
	<?php if ( $args['title'] ) : ?>
		<div class="aura-post__author-title">
			<?php echo esc_html( $args['title'] ); ?>
		</div><!-- .aura-post__author-title -->
	<?php endif; ?>

	<div class="aura-post__author-text">
		<?php the_author_posts_link(); ?>
	</div><!-- .aura-post__author-text -->
</div><!-- .aura-post__author -->
