<?php
/**
 * The template for displaying Date in Post.
 *
 * This template can be overridden by copying it to
 * your-child-theme/template-parts/post/date.php.
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
	'title' => __( 'On', 'aura-prime' ),
], $args );
?>

<div class="aura-post__date">
	<?php if ( $args['title'] ) : ?>
		<div class="aura-post__date-title">
			<?php echo esc_html( $args['title'] ); ?>
		</div><!-- .aura-post__date-title -->
	<?php endif; ?>

	<div class="aura-post__date-text">
		<?php the_time( get_option( 'date_format' ) ); ?>
	</div><!-- .aura-post__date-text -->
</div><!-- aura-post__date -->
