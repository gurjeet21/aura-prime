<?php
/**
 * The template for displaying a Single Comment.
 *
 * This template can be overridden by copying it to
 * your-child-theme/template-parts/comment.php.
 *
 * @package MadeByAura\Prime
 * @author  MadeByAura.com
 *
 * @param array $args
 */

namespace MadeByAura\Prime;

defined( 'ABSPATH' ) || die();

$comment = $args['comment'];
$depth   = $args['depth'];

// Author image.
$author_image = get_avatar( $comment, $args['avatar_size'] );

// Author link.
$author_link = get_comment_author_link();

// Author link.
$comment_author_url = get_comment_author_url();

// Translators: 1: Comment date, 2: Comment time.
$date = sprintf( __( '%1$s at %2$s', 'aura-prime' ), get_comment_date(), get_comment_time() );

// Comment classes.
$classes = get_comment_class();

// Stringify comment classes.
$classes_string = implode( ' ', $classes );
?>

<div class="aura-comment <?php echo esc_attr( $classes_string ); ?>" id="aura-comment-<?php echo esc_attr( get_comment_ID() ); ?>">
	<div class="aura-comment__inner">
		<?php if ( $author_image ) : ?>
			<div class="aura-comment__image">
				<?php echo wp_kses_post( $author_image ); ?>
			</div><!-- .aura-comment__image -->
		<?php endif; ?>

			<div class="aura-comment__text">
				<div class="aura-comment__meta">
					<?php if ( $author_link ) : ?>
						<span class="aura-comment__author">
							<?php echo wp_kses_post( $author_link ); ?>
						</span><!-- .comment_author -->
					<?php endif; ?>

					<?php if ( $date ) : ?>
						<span class="aura-comment__date">
							<?php echo esc_html( $date ); ?>
						</span><!-- .comment__date -->
					<?php endif; ?>

					<?php if ( 0 === absint( $comment->comment_approved ) ) : ?>
						<span class="aura-comment__awaiting-approval">
							<?php echo esc_html__( 'Comment awaiting approval', 'aura-prime' ); ?>
						</span><!-- .aura-comment__awaiting-approval -->
					<?php endif; ?>

					<span class="aura-comment__edit-link">
						<?php edit_comment_link( esc_html__( 'Edit', 'aura-prime' ) ); ?>
					</span><!-- .aura-comment__edit-link -->

					<span class="aura-comment__reply-link">
						<?php
						comment_reply_link( [
							'reply_text' => esc_html__( 'Reply', 'aura-prime' ),
							'depth'      => $depth,
							'max_depth'  => $args['args']['max_depth'],
						], $comment->comment_ID );
						?>
					</span><!-- .aura-comment__reply-link -->
				</div><!-- .aura-comment__meta -->

				<div class="aura-comment__content">
					<?php comment_text(); ?>
				</div><!-- .aura-comment__content -->

				<?php if ( $comment_author_url ) : ?>
					<a class="aura-comment__author-link" href="<?php echo esc_url( $comment_author_url ); ?>">
						<?php echo esc_html( $comment_author_url ); ?>
					</a><!-- .aura-comment__author-link -->
				<?php endif; ?>
			</div><!-- .aura-comment__text -->
	</div><!-- .aura-comment__inner -->

<?php
/**
 * The div with the context post-comment is not closed intentionally.
 * In order to accommodate nested replies, WordPress will add the
 * appropriate closing tag after listing any child elements.
 *
 * @link https://codex.wordpress.org/Function_Reference/wp_list_comments#Comments_Only_With_A_Custom_Comment_Display
 */
