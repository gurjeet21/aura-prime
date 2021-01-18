<?php
/**
 * PageTitle.
 *
 * @package MadeByAura\Prime\Plugins\Elementor\DynamicTags
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Plugins\Elementor\DynamicTags;

defined( 'ABSPATH' ) || die();

use Elementor\Core\DynamicTags\Tag;
use Elementor\Modules\DynamicTags\Module;
use MadeByAura\Prime\Modules\PageTitle as PageTitleModule;

/**
 * PageTitle.
 */
class PageTitle extends Tag {
	/**
	 * Get the Name of the tag
	 *
	 * @return string
	 */
	public function get_name() {
		return get_template() . '-page-title';
	}

	/**
	 * Get the title of the Tag.
	 *
	 * @return string
	 */
	public function get_title() {
		return __( 'Page Title', 'aura-prime' );
	}

	/**
	 * Get the Group of the tag.
	 *
	 * @return string
	 */
	public function get_group() {
		return get_template();
	}

	/**
	 * Get an array of tag categories.
	 *
	 * @return array
	 */
	public function get_categories() {
		return [ Module::TEXT_CATEGORY ];
	}

	/**
	 * Register the Dynamic tag controls.
	 *
	 * @return void
	 */
	protected function _register_controls() {}

	/**
	 * Print out the value of the Dynamic tag.
	 *
	 * @return void
	 */
	public function render() {
		echo esc_html( PageTitleModule::get_title() );
	}
}
