<?php
/**
 * The template for displaying a Grid post layout.
 *
 * This template can be overridden by copying it to
 * your-child-theme/template-parts/post-layouts/post-grid-small.php.
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
$layout    = 'post-grid-small';

// Classes.
$classes   = [];
$classes[] = 'aura-post';
$classes[] = "aura-post--{$post_type}";
// Layout classes.
$classes[] = "aura-post--{$layout}";

// Merge WordPress CSS classes with our CSS classes.
$wp_classes = Markup::get_classes_array( get_post_class() );
$classes    = Markup::merge_classes( $classes, $wp_classes );
?>

<div class="<?php Markup::echo_classes( $classes ); ?>" id="<?php echo 'aura-post-' . get_the_ID(); ?>">
	<?php get_template_part( 'template-parts/post/media' ); ?>

	<div class="aura-post__text">
		<div class="aura-post__header">
			<?php
			get_template_part( 'template-parts/post/title' );
			get_template_part( 'template-parts/post/date' );
			?>
		</div><!-- .aura-post__header -->
	</div><!-- .aura-post__text -->
</div><!-- .aura-post -->
