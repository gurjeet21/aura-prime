<?php
/**
 * The template for displaying No Posts Found.
 *
 * This template can be overridden by copying it to
 * your-child-theme/template-parts/no-posts.php.
 *
 * @package MadeByAura\Prime
 * @author  MadeByAura.com
 *
 * @param array $args
 */

namespace MadeByAura\Prime;

defined( 'ABSPATH' ) || die();
?>

<div class="aura-no-posts">
	<h2 class="aura-no-posts__title">
		<?php echo esc_html__( 'Nothing Found', 'aura-prime' ); ?>
	</h2>
</div><!-- .aura-no-posts -->
