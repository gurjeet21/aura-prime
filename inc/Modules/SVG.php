<?php
/**
 * SVG.
 *
 * @package MadeByAura\Prime\Modules
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Modules;

defined( 'ABSPATH' ) || die();

use MadeByAura\WPTools\Utils;

/**
 * SVG.
 */
class SVG {
	/**
	 * Get SVG sprite paths.
	 *
	 * @return array $paths
	 */
	public static function get_sprite_paths() {
		static $paths;

		if ( ! $paths ) {
			$paths['theme'] = [
				'svg'  => wp_normalize_path( get_template_directory() . '/dist/svg/sprite.svg' ),
				'json' => wp_normalize_path( get_template_directory() . '/dist/json/sprite.svg.json' ),
			];

			if ( is_child_theme() ) {
				$paths['child_theme'] = [
					'svg'  => wp_normalize_path( get_stylesheet_directory() . '/dist/svg/sprite.svg' ),
					'json' => wp_normalize_path( get_stylesheet_directory() . '/dist/json/sprite.svg.json' ),
				];
			}

			$paths = apply_filters( 'aura_theme_svg_sprite_paths', $paths );
		}

		return $paths;
	}

	/**
	 * Get SVG data.
	 *
	 * @return array $data
	 */
	public static function get_data() {
		static $data;

		if ( ! $data ) {
			$data  = [];
			$json  = '';
			$files = self::get_sprite_paths();

			if ( $files ) {
				foreach ( $files as $file ) {
					$json .= Utils::get_file_content( $file['json'] );
				}
			}

			if ( $json ) {
				// Decode JSON string.
				$svgs = json_decode( $json );

				if ( $svgs && is_array( $svgs ) ) {
					foreach ( $svgs as $svg ) {
						$id = preg_replace( '/^aura-svg--/', '', $svg->id );

						$data[ $id ] = [
							'title'   => isset( $svg->title ) && $svg->title ? $svg->title : $id,
							'viewbox' => $svg->viewBox, // phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
						];
					}
				}
			}

			$data = apply_filters( 'aura_theme_svg_data', $data );
		}

		return $data;
	}
}
