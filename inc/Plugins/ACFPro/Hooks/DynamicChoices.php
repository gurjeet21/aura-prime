<?php
/**
 * Set attributes of ACF Pro fields dynamically.
 *
 * @link https://www.advancedcustomfields.com/resources/dynamically-populate-a-select-fields-choices/
 *
 * @package MadeByAura\Prime\Plugins\ACFPro\Hooks
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Plugins\ACFPro\Hooks;

defined( 'ABSPATH' ) || die();

use MadeByAura\Prime\Base;

/**
 * DynamicChoices.
 */
class DynamicChoices {
	/**
	 * Instance.
	 *
	 * @var object  Class object.
	 */
	private static $instance;

	/**
	 * Instantiator.
	 *
	 * @return object  Class instance.
	 */
	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Constructor.
	 *
	 * @return void
	 */
	protected function __construct() {
		self::add_hooks();
	}

	/**
	 * Add hooks.
	 *
	 * @return void
	 */
	public static function add_hooks() {
		// Sidebar position.
		add_filter( 'acf/load_field/name=aura_general_sidebar_position', [ __CLASS__, 'set_sidebar_position_field_choices' ], 20 );
	}

	/**
	 * Set choices for the sidebar position field.
	 *
	 * @param  array $field  Field information.
	 * @return array $field  Field information.
	 */
	public static function set_sidebar_position_field_choices( $field ) {
		$field['choices'] = Base::get_choices( 'sidebar_position_with_default' );

		return $field;
	}
}
