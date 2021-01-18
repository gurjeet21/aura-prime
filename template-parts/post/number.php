<?php
/**
 * The template for displaying Number in Post.
 *
 * This template can be overridden by copying it to
 * your-child-theme/template-parts/post/number.php.
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
	'current_post' => 0,
], $args );

// Conditional early exit.
if ( ! $args['current_post'] ) {
	return;
}
?>

<div class="aura-post__number">
	<?php echo absint( $args['current_post'] ); ?>
</div><!-- .aura-post__number -->
