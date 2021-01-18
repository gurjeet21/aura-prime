<?php
/**
 * Social Sites.
 *
 * @package MadeByAura\Prime\Modules
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Modules;

defined( 'ABSPATH' ) || die();

/**
 * Social Sites.
 */
class SocialSites {
	/**
	 * Get social sites data.
	 *
	 * @return array $data
	 */
	public static function get_data() {
		static $data;

		if ( ! $data ) {
			$data = apply_filters( 'aura_theme_social_sites_data', [
				'facebook'    => [
					'text'       => __( 'Facebook', 'aura-prime' ),
					'font_class' => 'fab fa-facebook',
					'svg_id'     => 'brand-facebook',
				],
				'twitter'     => [
					'text'       => __( 'Twitter', 'aura-prime' ),
					'font_class' => 'fab fa-twitter',
					'svg_id'     => 'brand-twitter',
				],
				'google_plus' => [
					'text'       => __( 'Google Plus', 'aura-prime' ),
					'font_class' => 'fab fa-google-plus',
					'svg_id'     => 'brand-google-plus',
				],
				'instagram'   => [
					'text'       => __( 'Instagram', 'aura-prime' ),
					'font_class' => 'fab fa-instagram',
					'svg_id'     => 'brand-instagram',
				],
				'pinterest'   => [
					'text'       => __( 'Pinterest', 'aura-prime' ),
					'font_class' => 'fab fa-pinterest',
					'svg_id'     => 'brand-pinterest',
				],
				'youtube'     => [
					'text'       => __( 'YouTube', 'aura-prime' ),
					'font_class' => 'fab fa-youtube-play',
					'svg_id'     => 'brand-youtube',
				],
				'vimeo'       => [
					'text'       => __( 'Vimeo', 'aura-prime' ),
					'font_class' => 'fab fa-vimeo',
					'svg_id'     => 'brand-vimeo',
				],
				'tumblr'      => [
					'text'       => __( 'Tumblr', 'aura-prime' ),
					'font_class' => 'fab fa-tumblr',
					'svg_id'     => 'brand-tumblr',
				],
				'linkedin'    => [
					'text'       => __( 'LinkedIn', 'aura-prime' ),
					'font_class' => 'fab fa-linkedin',
					'svg_id'     => 'brand-linkedin',
				],
				'yelp'        => [
					'text'       => __( 'Yelp', 'aura-prime' ),
					'font_class' => 'fab fa-yelp',
					'svg_id'     => 'brand-yelp',
				],
				'dribbble'    => [
					'text'       => __( 'Dribbble', 'aura-prime' ),
					'font_class' => 'fab fa-dribbble',
					'svg_id'     => 'brand-dribbble',
				],
				'behance'     => [
					'text'       => __( 'Behance', 'aura-prime' ),
					'font_class' => 'fab fa-behance',
					'svg_id'     => 'brand-behance',
				],
				'github'      => [
					'text'       => __( 'GitHub', 'aura-prime' ),
					'font_class' => 'fab fa-github',
					'svg_id'     => 'brand-github',
				],
				'soundcloud'  => [
					'text'       => __( 'SoundCloud', 'aura-prime' ),
					'font_class' => 'fab fa-soundcloud',
					'svg_id'     => 'brand-soundcloud',
				],
				'spotify'     => [
					'text'       => __( 'Spotify', 'aura-prime' ),
					'font_class' => 'fab fa-spotify',
					'svg_id'     => 'brand-spotify',
				],
				'rss'         => [
					'text'       => __( 'RSS', 'aura-prime' ),
					'font_class' => 'fab fa-rss',
					'svg_id'     => 'brand-rss',
				],
			] );
		}

		return $data;
	}

	/**
	 * Parse ACF repeater field data.
	 *
	 * @param  array  $data   ACF repeater field data.
	 * @param  string $key    ACF repeater social site key.
	 * @return array  $sites
	 */
	public static function parse_acf_repeater_field_data( $data, $key = 'aura_dynamic_social_site' ) {
		$sites = [];

		if ( $data ) {
			foreach ( $data as $item ) {
				$sites[ $item[ $key ] ] = $item['url'];
			}
		}

		return $sites;
	}
}
