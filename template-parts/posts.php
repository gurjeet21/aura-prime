<?php
/**
 * The template for displaying Posts with the default loop.
 *
 * This template can be overridden by copying it to
 * your-child-theme/template-parts/posts.php.
 *
 * @package MadeByAura\Prime
 * @author  MadeByAura.com
 *
 * @param array $args
 */

namespace MadeByAura\Prime;

defined( 'ABSPATH' ) || die();

use MadeByAura\WPTools\Markup;
use MadeByAura\Prime\Modules\Posts;

// Merge incoming `$args` with defaults.
$args = array_replace_recursive( [
	'layout'     => Posts::get_layout(),
	'pagination' => true,
], $args );

// Context.
$classes   = [];
$classes[] = 'aura-posts';
// Layout classes.
$classes[] = "aura-posts--{$args['layout']}";
?>

<?php if ( have_posts() ) : ?>
	<div class="<?php Markup::echo_classes( $classes ); ?>">
		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>

			<?php get_template_part( 'template-parts/post-layouts/' . $args['layout'] ); ?>
		<?php endwhile; ?>
	</div><!-- .aura-posts -->

	<?php if ( true === $args['pagination'] && ! is_singular() ) : ?>
		<?php get_template_part( 'template-parts/pagination' ); ?>
	<?php endif; ?>
<?php else : ?>
	<?php get_template_part( 'template-parts/nothing-found' ); ?>
<?php endif; ?>
