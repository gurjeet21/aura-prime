<?php
/**
 * Callbacks.
 *
 * @package MadeByAura\Prime\Plugins\Kirki\Modules
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Plugins\Kirki\Modules;

use MadeByAura\Prime\Base;

defined( 'ABSPATH' ) || die();

/**
 * Callbacks.
 */
class Callbacks {
	/**
	 * Callback for Twitter Username in Share Links section.
	 *
	 * @return bool
	 */
	public static function share_links_twitter_username() {
		$result = false;
		$value  = Base::get_mod( 'share_links', 'sites' );

		if ( $value ) {
			$result = in_array( 'twitter', $value, true );
		}

		return $result;
	}
}
