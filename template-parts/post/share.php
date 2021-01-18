<?php
/**
 * The template for displaying Share in Post.
 *
 * This template can be overridden by copying it to
 * your-child-theme/template-parts/post/share.php.
 *
 * @package MadeByAura\Prime
 * @author  MadeByAura.com
 *
 * @param array $args
 */

namespace MadeByAura\Prime;

defined( 'ABSPATH' ) || die();

use MadeByAura\WPTools\Markup;

$title              = rawurlencode( get_the_title() );
$url                = rawurlencode( get_permalink() );
$post_thumbnail_url = rawurlencode( get_the_post_thumbnail_url( get_the_ID(), Base::get_info( 'prefix' ) . 'thumbnail' ) );
$image_url          = $post_thumbnail_url ? $post_thumbnail_url : get_template_directory_uri() . '/dist/img/logo-2x.png';
$site_url           = rawurlencode( get_site_url() );

$sites = [
	'facebook'  => [
		'text'  => __( 'Facebook', 'aura-prime' ),
		'class' => 'facebook',
		'url'   => sprintf( 'http://www.facebook.com/sharer/sharer.php?u=%1s&title=%2s', $url, $title ),
	],
	'twitter'   => [
		'text'  => __( 'Twitter', 'aura-prime' ),
		'class' => 'twitter',
		'url'   => sprintf( 'http://twitter.com/intent/tweet?status=%1s+%2s', $title, $url ),
	],
	'pinterest' => [
		'text'  => __( 'Pinterest', 'aura-prime' ),
		'class' => 'pinterest',
		'url'   => sprintf( 'http://pinterest.com/pin/create/bookmarklet/?media=%1s&url=%2s&is_video=false&description=%3s', $image_url, $url, $title ),
	],
	'linkedin'  => [
		'text'  => __( 'LinkedIn', 'aura-prime' ),
		'class' => 'linkedin',
		'url'   => sprintf( 'http://www.linkedin.com/shareArticle?mini=true&url=%1s&title=%2s&source=%3s', $url, $title, $site_url ),
	],
	'email'     => [
		'text'  => __( 'Email', 'aura-prime' ),
		'class' => 'envelope',
		'url'   => sprintf( 'mailto:?subject=%1s&body=%2s', get_the_title(), $url ),
	],
];
?>

<div class="aura-post-share">
	<div class="aura-post-share__title">
		<?php echo esc_html__( 'Share This Article', 'aura-prime' ); ?>
	</div><!-- .aura-post-share__title -->

	<div class="aura-post-share__body">
		<?php foreach ( $sites as $id => $site ) : ?>
			<?php $button_context = [ 'aura-post-share__link', 'aura-post-share__link-' . $id ]; ?>
			<a class="<?php Markup::echo_classes( $button_context ); ?>"
					href="<?php echo esc_url( $site['url'] ); ?>"
						target="_blank">
				<?php
				echo '<i class="fa fa-' . esc_attr( $site['class'] ) . '" aria-hidden="true"></i>';
				echo '<span class="screen-reader-text">' . esc_html( $site['text'] ) . '</span>';
				?>
			</a><!-- .aura-post-share__link -->
		<?php endforeach; ?>
	</div><!-- .aura-post-share__body -->
</div><!-- .aura-post-share -->
