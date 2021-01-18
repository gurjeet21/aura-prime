<?php
/**
 * The template for displaying Media in Post.
 *
 * This template can be overridden by copying it to
 * your-child-theme/template-parts/post/media.php.
 *
 * @package MadeByAura\Prime
 * @author  MadeByAura.com
 *
 * @param array $args
 */

namespace MadeByAura\Prime;

defined( 'ABSPATH' ) || die();

use MadeByAura\Prime\Base;

// Early exit if no featured image is assigned.
if ( ! has_post_thumbnail() ) {
	return;
}

// Merge incoming `$args` with defaults.
$args = array_replace_recursive( [
	'image_size' => Base::get_info( 'prefix' ) . 'thumbnail',
	'link'       => true,
], $args );
?>

<div class="aura-post__media">
	<div class="aura-post__thumbnail">
		<?php if ( $args['link'] ) : ?>
			<a href="<?php echo esc_url( get_the_permalink() ); ?>">
		<?php endif; ?>

				<?php the_post_thumbnail( apply_filters( 'aura_theme_post_media_image_size', $args['image_size'] ) ); ?>

		<?php if ( $args['link'] ) : ?>
			</a>
		<?php endif; ?>
	</div><!-- .aura-post__thumbnail -->
</div><!-- .aura-post__media -->
