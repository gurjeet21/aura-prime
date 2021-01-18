<?php
/**
 * PageTitle.
 *
 * @package MadeByAura\Prime\Modules
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Modules;

defined( 'ABSPATH' ) || die();

use MadeByAura\WPTools\Utils;

/**
 * PageTitle.
 */
class PageTitle {
	/**
	 * Get page title.
	 *
	 * @return string $title
	 */
	public static function get_title() {
		$title = '';

		if ( Utils::is_plugin_active( 'woocommerce/woocommerce.php' ) && ( is_product() || is_product_category() || is_product_tag() || is_shop() ) ) {
			$title = __( 'Shop', 'aura-prime' );
		} elseif ( is_home() || is_single() || is_tag() || is_category() ) {
			$page_for_posts = get_option( 'page_for_posts' );

			if ( 'page' === get_option( 'show_on_front' ) && $page_for_posts ) {
				if ( $page_for_posts ) {
					$title = get_the_title( get_option( 'page_for_posts' ) );
				}
			} else {
				$title = __( 'Blog', 'aura-prime' );
			}
		} else {
			$title = get_the_title();
		}

		return apply_filters( 'aura_theme_page_title', $title );
	}
}
