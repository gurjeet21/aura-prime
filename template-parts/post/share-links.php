<?php
/**
 * The template for displaying Share in Post.
 *
 * This template can be overridden by copying it to
 * your-child-theme/template-parts/post/share.php.
 *
 * @package MadeByAura\Prime
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime;

defined( 'ABSPATH' ) || die();

use MadeByAura\WPTools\Utils;
use MadeByAura\Prime\Modules\ShareLinks;
use MadeByAura\WPTools\Markup;

// Merge incoming `$args` with defaults.
$args = array_replace_recursive( [
	'title' => '',
	'type'  => 'buttons',
], $args );

$sites = ShareLinks::get_links( get_permalink(), get_the_ID() );

// Conditional early exit.
if ( ! $sites ) {
	return;
}

// Classes.
$classes   = [];
$classes[] = 'aura-post-share-links';

// Type context.
if ( $args['type'] ) {
	$classes[] = 'aura-post-share-links--type-' . Utils::dashify( $args['type'] );
}
?>

<div class="<?php Markup::echo_classes( $classes ); ?>">
	<?php if ( $args['title'] ) : ?>
		<div class="aura-post-share-links__title">
			<?php echo esc_html( $args['title'] ); ?>
		</div><!-- .aura-post-share-links__title -->
	<?php endif; ?>

	<div class="aura-post-share-links__items">
		<?php foreach ( $sites as $id => $site ) : ?>
			<?php
			$item_context   = [];
			$item_context[] = 'aura-post-share-links__item';
			$item_context[] = 'aura-post-share-links__item--' . Utils::dashify( $id );
			?>

			<div class="<?php Markup::echo_classes( $item_context ); ?>">
				<a class="aura-post-share-links__link" href="<?php echo esc_url( $site['url'] ); ?>" target="_blank">
					<span class="aura-post-share-links__link-icon">
						<?php echo sprintf( '<i class="%s" aria-hidden="true"></i>', esc_attr( $site['class'] ) ); ?>
					</span><!-- .aura-post-share-links__link-icon -->

					<span class="aura-post-share-links__link-text">
						<?php echo esc_html( $site['name'] ); ?>
					</span><!-- .aura-post-share-links__link-text -->
				</a><!-- .aura-post-share-links__link -->
			</div><!-- .aura-post-share-links__item -->
		<?php endforeach; ?>
	</div><!-- .aura-post-share-links__items -->
</div><!-- .aura-post-share-link -->
