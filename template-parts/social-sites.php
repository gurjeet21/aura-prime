<?php
/**
 * The template for displaying Social Sites.
 *
 * This template can be overridden by copying it to
 * your-child-theme/template-parts/social-sites.php.
 *
 * @package MadeByAura\Prime
 * @author  MadeByAura.com
 *
 * @param array $args
 */

namespace MadeByAura\Prime;

defined( 'ABSPATH' ) || die();

use MadeByAura\WPTools\Utils;
use MadeByAura\Prime\Modules\SocialSites;

// Merge incoming `$args` with defaults.
$args = array_replace_recursive( [
	'attrs'     => [],
	'title'     => '',
	'icon_type' => 'font',
	'urls'      => [],
], $args );

$sites = SocialSites::get_data();

// Conditional early exit.
if ( ! $sites ) {
	get_template_part( 'template-parts/message', null, [
		'text' => __( '<em>Social sites data</em> is required to display <em>Social Sites</em>.', 'aura-prime' ),
	] );

	return;
}

// Conditional early exit.
if ( ! array_filter( $args['urls'] ) ) {
	get_template_part( 'template-parts/message', null, [
		'text' => __( '<var>urls</var> are required to display <em>Social Sites</em>.', 'aura-prime' ),
	] );

	return;
}
?>

<div class="aura-social-sites">
	<?php if ( $args['title'] ) : ?>
		<div class="aura-social-sites__title">
			<?php echo esc_html( $args['title'] ); ?>
		</div><!-- .aura-social-sites__title -->
	<?php endif; ?>

	<ul class="aura-social-sites__list">
		<?php foreach ( $args['urls'] as $site_id => $url ) : ?>
			<?php if ( $url ) : ?>
				<li class="aura-social-sites__list-item aura-social-sites__list-item--<?php Utils::dashify( $site_id ); ?>">
					<a class="aura-social-sites__link" href="<?php echo esc_url( $url ); ?>" target="_blank">
						<?php
						get_template_part( 'template-parts/icon', null, [
							'wrapper'    => 'social-sites__icon',
							'type'       => $args['icon_type'],
							'font_class' => $sites[ $site_id ]['font_class'],
							'svg_id'     => $sites[ $site_id ]['svg_id'],
						] );
						?>

						<div class="aura-social-sites__text">
							<?php echo esc_html( $sites[ $site_id ]['text'] ); ?>
						</div><!-- .aura-social-sites__text -->
					</a>
				</li>
			<?php endif; ?>
		<?php endforeach; ?>
	</ul><!-- .aura-social-sites__list -->
</div><!-- .aura-social-sites -->
