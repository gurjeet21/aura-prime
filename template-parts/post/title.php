<?php
/**
 * The template for displaying Title in Post.
 *
 * This template can be overridden by copying it to
 * your-child-theme/template-parts/post/title.php.
 *
 * @package MadeByAura\Prime
 * @author  MadeByAura.com
 *
 * @param array $args
 */

namespace MadeByAura\Prime;

defined( 'ABSPATH' ) || die();

use MadeByAura\WPTools\Markup;

// Merge incoming `$args` with defaults.
$args = array_replace_recursive( [
	'tag'  => 'h3',
	'link' => true,
], $args );

$classes[] = 'aura-post__title';

$attrs['class'] = $classes;
?>

<<?php echo tag_escape( $args['tag'] ); ?> <?php Markup::echo_attrs( $attrs ); ?>>
	<?php if ( $args['link'] ) : ?>
		<a href="<?php echo esc_url( get_the_permalink() ); ?>"> <?php the_title(); ?> </a>
	<?php endif; ?>
</<?php echo tag_escape( $args['tag'] ); ?>><!-- .aura-post__title -->
