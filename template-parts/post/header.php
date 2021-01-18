<?php
/**
 * The template for displaying Header in Post.
 *
 * This template can be overridden by copying it to
 * your-child-theme/template-parts/post/header.php.
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
	'title' => [
		'tag'  => 'h3',
		'link' => true,
	],
], $args );
?>

<div class="aura-post__header">
	<?php
	get_template_part( 'template-parts/post/terms' );
	get_template_part( 'template-parts/post/title', $args['title'] );
	get_template_part( 'template-parts/post/header-meta' );
	?>
</div><!-- .aura-post__header -->
