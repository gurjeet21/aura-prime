<?php
/**
 * The template for displaying Pagination in Post.
 *
 * This template can be overridden by copying it to
 * your-child-theme/template-parts/post/pagination.php.
 *
 * @package MadeByAura\Prime
 * @author  MadeByAura.com
 *
 * @param array $args
 */

namespace MadeByAura\Prime;

defined( 'ABSPATH' ) || die();

$previous_post = get_previous_post();
$next_post     = get_next_post();

// Conditional early exit.
if ( ! $previous_post && ! $next_post ) {
	return;
}

$prev_icon_class = 'fa fa-' . Base::get_mod( 'icons', 'prev_fa' );
$next_icon_class = 'fa fa-' . Base::get_mod( 'icons', 'next_fa' );
?>

<div class="aura-post-pagination">
	<?php if ( $previous_post ) : ?>
		<a class="aura-post-pagination__previous" href="<?php echo esc_url( get_permalink( $previous_post->ID ) ); ?>">
			<div class="aura-post-pagination__label">
				<?php echo sprintf( '<i class="fa fa-arrow-%1$s" aria-hidden="true"></i>', esc_attr( $prev_icon_class ) ); ?>
				<?php echo esc_html__( 'Previous Post', 'aura-prime' ); ?>
			</div><!-- .aura-post-pagination__label -->

			<h3 class="aura-post-pagination__title">
				<?php echo wp_kses_post( $previous_post->post_title ); ?>
			</h3><!-- .aura-post-pagination__title -->
		</a><!-- .aura-post-pagination__previous -->
	<?php endif; ?>

	<?php if ( $next_post ) : ?>
		<a class="aura-post-pagination__next" href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>">
			<div class="aura-post-pagination__label">
				<?php echo esc_html__( 'Next Post', 'aura-prime' ); ?>
				<?php echo sprintf( '<i class="fa fa-arrow-%1$s" aria-hidden="true"></i>', esc_attr( $next_icon_class ) ); ?>
			</div><!-- .aura-post-pagination__label -->

			<h3 class="aura-post-pagination__title">
				<?php echo wp_kses_post( $next_post->post_title ); ?>
			</h3><!-- .aura-post-pagination__title -->
		</a><!-- .aura-post-pagination__next -->
	<?php endif; ?>
</div><!-- .aura-post-pagination -->
