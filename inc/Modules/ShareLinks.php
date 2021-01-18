<?php
/**
 * Share Links.
 *
 * @package MadeByAura\Prime\Modules
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Modules;

defined( 'ABSPATH' ) || die();

use MadeByAura\Prime\Base;

/**
 * Share Links.
 */
class ShareLinks {
	/**
	 * Get sites for share links.
	 *
	 * @return array
	 */
	public static function get_data() {
		static $sites;

		if ( ! $sites ) {
			$sites = apply_filters( 'aura_theme_share-links_data', [
				'facebook'  => [
					'name'  => esc_html__( 'Facebook', 'aura-prime' ),
					'class' => 'fab fa-facebook',
				],
				'twitter'   => [
					'name'  => esc_html__( 'Twitter', 'aura-prime' ),
					'class' => 'fab fa-twitter',
				],
				'pinterest' => [
					'name'  => esc_html__( 'Pinterest', 'aura-prime' ),
					'class' => 'fab fa-pinterest',
				],
				'linkedin'  => [
					'name'  => esc_html__( 'LinkedIn', 'aura-prime' ),
					'class' => 'fab fa-linkedin',
				],
				'email'     => [
					'name'  => esc_html__( 'Email', 'aura-prime' ),
					'class' => 'fas fa-envelope',
				],
			] );
		}

		return $sites;
	}

	/**
	 * Get share links data.
	 *
	 * @param string $url      URL to be shared.
	 * @param int    $post_id  Post ID.
	 * @return array
	 */
	public static function get_links( $url, $post_id = null ) {
		// Conditional early exit.
		if ( ! $url ) {
			return;
		}

		if ( ! $post_id ) {
			$post_id = get_the_ID();
		}

		$sites = self::get_data();
		$data  = [];

		foreach ( Base::get_mod( 'share_links', 'sites' ) as $site_id ) {
			if ( in_array( $site_id, array_keys( $sites ), true ) ) {
				$data[ $site_id ] = array_merge( $sites[ $site_id ], [
					'url' => call_user_func( [ __CLASS__, "get_{$site_id}_link" ], $url, $post_id ),
				] );
			}
		}

		return apply_filters( 'aura_theme_share-links_links', $data, $url, $post_id );
	}

	/**
	 * Get Facebook share link.
	 *
	 * @param  string $url  URL to be shared.
	 * @return string
	 */
	public static function get_facebook_link( $url ) {
		return "https://www.facebook.com/sharer.php?u={$url}";
	}

	/**
	 * Get Twitter share link.
	 *
	 * @param  string $url      URL to be shared.
	 * @param  int    $post_id  Post ID.
	 * @return string
	 */
	public static function get_twitter_link( $url, $post_id ) {
		$tweet = null;
		$via   = null;

		// Twitter Text.
		if ( intval( $post_id ) > 0 ) {
			$title = html_entity_decode( get_the_title( $post_id ) );

			$tweet = '&text=' . rawurlencode( $title );
		}

		// Twitter Via.
		$username = Base::get_info( 'share_links_twitter_username' );

		if ( $username ) {
			$via = '&via=' . $username;
		}

		return "https://twitter.com/share?{$tweet}{$via}&url={$url}";
	}

	/**
	 * Get Pinterest share link.
	 *
	 * @param  string $url      URL to be shared.
	 * @param  int    $post_id  Post ID.
	 * @return string
	 */
	public static function get_pinterest_link( $url, $post_id ) {
		$media = null;

		// Media.
		$thumb_url = get_the_post_thumbnail_url( $post_id, 'large' );

		if ( $thumb_url ) {
			$media = '&media=' . $thumb_url;
		}

		return "https://pinterest.com/pin/create/bookmarklet/?url={$url}{$media}";
	}

	/**
	 * Get LinkedIn share link.
	 *
	 * @param  string $url  URL to be shared.
	 * @return string
	 */
	public static function get_linkedin_link( $url ) {
		return "https://www.linkedin.com/shareArticle?mini=true&url={$url}";
	}

	/**
	 * Get Email share link.
	 *
	 * @param  string $url      URL to be shared.
	 * @param  int    $post_id  Post ID.
	 * @return string
	 */
	public static function get_email_link( $url, $post_id ) {
		$title = esc_html__( 'Share Link', 'aura-prime' );

		// Title.
		if ( intval( $post_id ) > 0 ) {
			$title = html_entity_decode( get_the_title( $post_id ) );
		}

		$subject = rawurlencode( $title );
		$body    = rawurlencode( "{$title}: {$url}" );

		return "mailto:?subject={$subject}&body={$body}";
	}
}
