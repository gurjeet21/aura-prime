<?php
/**
 * The template for displaying a Post Single aura-post layout.
 *
 * This template can be overridden by copying it to
 * your-child-theme/template-parts/post-layouts/post-single.php.
 *
 * @package MadeByAura\Prime
 * @author  MadeByAura.com
 *
 * @param array $args
 */

namespace MadeByAura\Prime;

defined( 'ABSPATH' ) || die();

use MadeByAura\WPTools\Markup;

// Set variables.
$post_type = 'post';
$layout    = 'post-single';

// Classes.
$classes   = [];
$classes[] = 'aura-post';
$classes[] = "aura-post--{$post_type}";
$classes[] = "aura-post--{$layout}";

// Merge WordPress CSS classes with our CSS classes.
$wp_classes = Markup::get_classes_array( get_post_class() );
$classes    = Markup::merge_classes( $classes, $wp_classes );
?>

<div class="<?php Markup::echo_classes( $classes ); ?>" id="<?php echo 'aura-post' . get_the_ID(); ?>">
	<?php
	get_template_part( 'template-parts/post/header', null, [
		'title' => [
			'link' => false,
		],
	] );

	get_template_part( 'template-parts/post/media', null, [
		'image_size' => Base::get_info( 'prefix' ) . 'content',
		'link'       => false,
	] );

	get_template_part( 'template-parts/post/content' );

	get_template_part( 'template-parts/post/terms', null, [
		'taxonomy' => 'post_tag',
		'title'    => __( 'Tags:', 'aura-prime' ),
	] );

	get_template_part( 'template-parts/post/share-links' );

	get_template_part( 'template-parts/post/author-info' );
	get_template_part( 'template-parts/related-posts' );
	get_template_part( 'template-parts/post/comments' );
	get_template_part( 'template-parts/post/pagination' );
	?>
</div><!-- .aura-post -->
