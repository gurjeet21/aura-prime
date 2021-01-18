<?php
/**
 * The template for displaying Pagination.
 *
 * This template can be overridden by copying it to
 * your-child-theme/template-parts/pagination.php.
 *
 * @package MadeByAura\Prime
 * @author  MadeByAura.com
 *
 * @param array $args
 */

namespace MadeByAura\Prime;

defined( 'ABSPATH' ) || die();

use MadeByAura\WPTools\Markup;

global $wp_query;

// Merge incoming `$args` with defaults.
$args = array_replace_recursive( [
	'type'            => 'links',
	'prev_text'       => __( 'Previous Page', 'aura-prime' ),
	'prev_icon_class' => 'fa fa-' . Base::get_mod( 'icons', 'prev_fa' ),
	'next_text'       => __( 'Next Page', 'aura-prime' ),
	'next_icon_class' => 'fa fa-' . Base::get_mod( 'icons', 'next_fa' ),
	'load_more_text'  => __( 'Load More', 'aura-prime' ),
	'total_pages'     => $wp_query->max_num_pages,
], $args );

// Conditional early exit.
if ( ! $args['type'] ) {
	get_template_part( 'template-parts/message', null, [
		'text' => __( '<var>type</var> is required to display <em>Pagination</em>.', 'aura-prime' ),
	] );

	return;
}

// Text.
$prev_text = sprintf( '<i class="fa fa-arrow-%2$s" aria-hidden="true"></i> %1$s', $args['prev_text'], $args['prev_icon_class'] );
$next_text = sprintf( '%1$s <i class="fa fa-arrow-%2$s" aria-hidden="true"></i>', $args['next_text'], $args['next_icon_class'] );

// Context.
$classes[] = 'aura-pagination';
// Type classes.
$classes[] = 'aura-pagination--type-' . $args['type'];
?>

<?php if ( 'links' === $args['type'] ) : ?>
	<?php $paged = get_query_var( 'paged' ); ?>

	<?php if ( $paged || $args['total_pages'] > 1 ) : ?>
		<div class="<?php Markup::echo_classes( $classes ); ?>">
			<?php if ( $paged ) : ?>
				<a classs="aura-pagination__link aura-pagination__link--prev" href="<?php echo esc_url( get_previous_posts_page_link() ); ?>">
					<?php echo wp_kses_post( $prev_text ); ?>
				</a>
			<?php endif; ?>

			<?php if ( $paged < $args['total_pages'] ) : ?>
				<a classs="aura-pagination__link aura-pagination__link--next" href="<?php echo esc_url( get_previous_posts_page_link() ); ?>">
					<?php echo wp_kses_post( $next_text ); ?>
				</a>
			<?php endif; ?>
		</div><!-- .aura-pagination -->
	<?php endif; ?>
	<?php elseif ( 'numbers' === $args['type'] ) : ?>
		<?php
		$links = paginate_links( [
			'current'   => absint( max( 1, get_query_var( 'paged' ) ) ),
			'total'     => absint( $args['total_pages'] ),
			'prev_text' => wp_kses_post( $prev_text ),
			'next_text' => wp_kses_post( $next_text ),
		] );
		?>
		<?php if ( $links ) : ?>
			<div class="<?php Markup::echo_classes( $classes ); ?>">
				<?php echo wp_kses_post( $links ); ?>
			</div><!-- .aura-pagination -->
		<?php endif; ?>
	<?php elseif ( 'load_more' === $args['type'] ) : ?>
		<div class="<?php Markup::echo_classes( $classes ); ?>">
			<?php
			get_template_part( 'template-parts/button', null, [
				'tag'       => 'button',
				'text'      => $args['load_more_text'],
				'icon_type' => false,
			] );
			?>
		</div><!-- .aura-pagination -->
<?php endif; ?>
