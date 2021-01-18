<?php
/**
 * The template for displaying Author Information in Post.
 *
 * This template can be overridden by copying it to
 * your-child-theme/template-parts/post/author-info.php.
 *
 * @package MadeByAura\Prime
 * @author  MadeByAura.com
 *
 * @param array $args
 */

namespace MadeByAura\Prime;

defined( 'ABSPATH' ) || die();

$description = get_the_author_meta( 'description' );

// Early exit if author description is empty.
if ( empty( $description ) ) {
	return;
}

// Author url.
$author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
?>

<div class="aura-post-author-info">
	<div class="aura-post-author-info__sidebar">
		<div class="aura-post-author-info__avatar">
			<a href="<?php echo esc_url( $author_url ); ?>">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), '200' ); ?>
			</a>
		</div><!-- .aura-post-author-info__avatar -->
	</div><!-- .aura-post-author-info__sidebar -->

	<div class="aura-post-author-info__main">
		<h3 class="aura-post-author-info__title">
			<a href="<?php echo esc_url( $author_url ); ?>">
				<?php the_author_meta( 'display_name' ); ?>
			</a>
		</h3><!-- .aura-post-author-info__title -->

		<div class="aura-post-author-info__description">
			<?php echo wp_kses_post( $description ); ?>
		</div><!-- .aura-post-author-info__description -->
	</div><!-- .aura-post-author-info__main -->
</div><!-- .aura-post-author-info -->
