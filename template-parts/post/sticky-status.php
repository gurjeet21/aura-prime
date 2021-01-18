<?php
/**
 * The template for displaying Sticky Status in Post.
 *
 * This template can be overridden by copying it to
 * your-child-theme/template-parts/post/sticky-status.php.
 *
 * @package MadeByAura\Prime
 * @author  MadeByAura.com
 *
 * @param array $view_data
 */

namespace MadeByAura\Prime;

defined( 'ABSPATH' ) || die();
?>

<?php if ( is_sticky() ) : ?>
	<div class="aura-post__sticky-status">
		<?php echo esc_html__( 'Featured', 'aura-prime' ); ?>
	</div><!-- .aura-post__sticky-status -->
<?php endif; ?>
