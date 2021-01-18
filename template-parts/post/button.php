<?php
/**
 * The template for displaying Button in Post.
 *
 * This template can be overridden by copying it to
 * your-child-theme/template-parts/post/button.php.
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
	'type' => 'beta',
	'text' => __( 'Read More', 'aura-prime' ),
], $args );
?>

<div class="aura-post__button">
	<?php
	get_template_part( 'template-parts/button', [
		'type' => $args['type'],
		'text' => $args['text'],
		'url'  => get_the_permalink(),
	] );
	?>
</div><!-- .aura-post__button -->
