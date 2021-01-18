<?php
/**
 * The template for displaying Comments Count in Post.
 *
 * This template can be overridden by copying it to
 * your-child-theme/template-parts/post/comments-count.php.
 *
 * @package MadeByAura\Prime
 * @author  MadeByAura.com
 *
 * @param array $args
 */

namespace MadeByAura\Prime;

defined( 'ABSPATH' ) || die();

// Comment count.
$comments_count = absint( get_comments_number() );

// Early exit if comments count is 0.
if ( 0 === $comments_count ) {
	return;
}

// Comment text.
$comments_text = _n( 'Comment', 'Comments', $comments_count, 'aura-prime' );
?>

<div class="aura-post__comments-count">
	<?php echo sprintf( '<a href="%s">', esc_url( get_comments_link() ) ); ?>
		<span class="aura-post__comments-count-title">
			<?php echo absint( $comments_count ); ?>
		</span><!-- .aura-post__comments-count-title -->

		<span class="aura-post__comments-count-text">
			<?php echo esc_html( $comments_text ); ?>
		</span><!-- .aura-post__comments-count-text -->
	<?php echo '</a>'; ?>
</div><!-- .aura-post__comments-count -->
