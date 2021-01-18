<?php
/**
 * The template for displaying Comments.
 *
 * This template can be overridden by copying it to
 * your-child-theme/template-parts/comments.php.
 *
 * @package MadeByAura\Prime
 * @author  MadeByAura.com
 *
 * @param array $args
 */

namespace MadeByAura\Prime;

defined( 'ABSPATH' ) || die();

$comments_count = absint( get_comments_number() );
?>

<section class="aura-comments" id="comments">
	<?php
	/**
	 * Title.
	 */
	if ( 1 === $comments_count ) {
		// Translators: 1: Comments count.
		$title = sprintf( __( '%1$s Comment', 'aura-prime' ), number_format_i18n( $comments_count ) );
	} elseif ( 1 < $comments_count ) {
		// Translators: 1: Comments count.
		$title = sprintf( __( '%1$s Comments', 'aura-prime' ), number_format_i18n( $comments_count ) );
	} else {
		$title = __( 'Leave a Comment', 'aura-prime' );
	}
	?>

	<div class="aura-comments__title">
		<?php echo esc_html( $title ); ?>
	</div><!-- .aura-comments__title -->

	<?php if ( $comments_count ) : ?>
		<div class="aura-comments__list">
			<?php
			wp_list_comments( [
				'avatar_size' => 70,
				'max_depth'   => 3,
				'style'       => 'div',
				'type'        => 'all',
				'callback'    => function( $comment, $args, $depth ) {
					get_template_part( 'template-parts/comment', null, compact( 'comment', 'args', 'depth' ) );
				},
			] );
			?>
		</div><!-- .aura-comments__list -->
	<?php endif; ?>

	<?php
	/**
	 * Form.
	 */
	ob_start();
		get_template_part( 'template-parts/button', null, [
			'type'  => 'alpha',
			'tag'   => 'button',
			'text'  => '%4$s',
			'attrs' => [
				'name'  => '%1$s',
				'id'    => '%2$s',
				'class' => '%3$s',
			],
		] );
	$button = ob_get_clean();

	comment_form( [
		'label_submit'  => esc_html__( 'Submit Comment', 'aura-prime' ),
		'submit_button' => $button,
	] );
	?>
</section><!-- .aura-comments -->
