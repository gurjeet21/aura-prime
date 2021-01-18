<?php
/**
 * The template for displaying a Page Single post layout.
 *
 * This template can be overridden by copying it to
 * your-child-theme/template-parts/post-layouts/page-single.php.
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
$post_type = 'page';
$layout    = 'page-single';

$classes   = [];
$classes[] = 'aura-post';
$classes[] = 'aura-post--' . $post_type;
$classes[] = "aura-post--{$layout}";

// Merge WordPress CSS classes with our CSS classes.
$wp_classes = Markup::get_classes_array( get_post_class() );
$classes    = Markup::merge_classes( $classes, $wp_classes );
?>

<div class="<?php Markup::echo_classes( $classes ); ?>" id="<?php echo 'aura-post' . get_the_ID(); ?>">
	<?php if ( Base::get_mod( 'page', 'title_enabled' ) ) : ?>
		<div class="aura-post__header">
			<?php
			get_template_part( 'template-parts/post/title', [
				'link' => false,
			] );
			?>
		</div><!-- .aura-post__header -->
	<?php endif; ?>

	<?php
	get_template_part( 'template-parts/post/media', [
		'image_size' => Base::get_info( 'prefix' ) . 'content',
		'link'       => false,
	] );

	get_template_part( 'template-parts/post/content' );
	?>
</div><!-- .aura-post -->
