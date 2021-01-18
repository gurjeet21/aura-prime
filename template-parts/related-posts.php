<?php
/**
 * The template for displaying Related Posts.
 *
 * This template can be overridden by copying it to
 * your-child-theme/template-parts/related-posts.php.
 *
 * @param array $args
 *
 * @package MadeByAura\Prime
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime;

defined( 'ABSPATH' ) || die();

use MadeByAura\Prime\Modules\PostLoop;

defined( 'ABSPATH' ) || die();

// Merge incoming `$args` with defaults.
$args = array_replace_recursive( [
	'title'   => __( 'Related Posts', 'aura-prime' ),
	'post_id' => '',
], $args );

$cat = wp_get_post_categories( get_the_ID(), [ 'fields' => 'ids' ] );
$cat = $cat ? $cat : null;

$related_posts = new PostLoop( [
	'layout'     => 'post-grid-small',
	'pagination' => false,
	'query_args' => [
		'post_type'      => 'post',
		'posts_per_page' => 4,
		'cat'            => $cat,
		'post__not_in'   => [ get_the_ID() ],
		'orderby'        => 'rand',
	],
] );

// Don't proceed if there are no posts.
if ( ! $related_posts->have_posts() ) {
	return;
}
?>

<div class="aura-related-posts">
	<div class="aura-related-posts__header">
		<h2 class="aura-related-posts__title"><?php echo esc_html( $args['title'] ); ?></h2>
	</div><!-- .aura-related-posts__header -->

	<div class="aura-related-posts__body">
		<?php $related_posts->render_posts(); ?>
	</div><!-- .aura-related-posts__body -->
</div><!-- .aura-related-posts -->
