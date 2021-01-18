<?php
/**
 * Posts.
 *
 * @package MadeByAura\Prime\Modules
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Modules;

defined( 'ABSPATH' ) || die();

use MadeByAura\Prime\Base;

/**
 * Posts.
 */
class Posts {
	/**
	 * Get post layout.
	 *
	 * @return string $layout
	 */
	public static function get_layout() {
		$layout = 'post-' . Base::get_mod( 'post_archive', 'post_layout' );

		if ( is_singular( 'post' ) ) {
			$layout = 'post-single';
		} elseif ( is_singular() ) {
			$layout = 'page-single';
		};

		return apply_filters( 'aura_theme_post_layout', $layout );
	}
}
