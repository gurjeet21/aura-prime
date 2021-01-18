<?php
/**
 * The template for displaying Error 404.
 *
 * This template can be overridden by copying it to
 * your-child-theme/template-parts/error-404.php.
 *
 * @package MadeByAura\Prime
 * @author  MadeByAura.com
 *
 * @param array $args
 */

namespace MadeByAura\Prime;

defined( 'ABSPATH' ) || die();
?>

<div class="aura-error-404">
	<div class="aura-error-404__sub-title">
		<?php echo esc_html__( 'Error 404', 'aura-prime' ); ?>
	</div><!-- .aura-error-404__sub-title -->

	<div class="aura-error-404__title">
		<?php echo esc_html__( 'Page Not Found', 'aura-prime' ); ?>
	</div><!-- .aura-error-404__title -->

	<div class="aura-error-404__description">
		<?php echo esc_html__( 'The page you requested could not be found. Try refining your search, or use the navigation above to locate the post.', 'aura-prime' ); ?>
	</div><!-- .aura-error-404__description -->
</div><!-- .aura-error-404 -->
