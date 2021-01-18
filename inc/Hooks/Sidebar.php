<?php
/**
 * Sidebar.
 *
 * @package MadeByAura\Prime\Hooks
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Hooks;

defined( 'ABSPATH' ) || die();

use MadeByAura\WPTools\Utils;
use MadeByAura\Prime\Modules\Sidebar as SidebarComponent;

/**
 * Sidebar.
 */
class Sidebar {
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
	protected static function add_hooks() {
		// Add choices.
		add_filter( 'aura_theme_choices_sidebar_position', [ __CLASS__, 'get_choices' ], 20 );
		add_filter( 'aura_theme_choices_sidebar_position_with_default', [ __CLASS__, 'get_choices_with_default' ], 20 );
		add_filter( 'aura_theme_choices_sidebar_sticky_method', [ __CLASS__, 'get_sticky_method_choices' ], 20 );

		// Add body classes.
		add_filter( 'body_class', [ __CLASS__, 'add_body_classes' ], 20 );
	}

	/**
	 * Get choices for sidebar position.
	 *
	 * @return array
	 */
	public static function get_choices() {
		static $choices;

		if ( ! isset( $choices ) ) {
			$choices = [
				'disabled' => esc_html__( 'No Sidebar', 'aura-prime' ),
				'left'     => esc_html__( 'Left Sidebar', 'aura-prime' ),
				'right'    => esc_html__( 'Right Sidebar', 'aura-prime' ),
			];
		}

		return $choices;
	}

	/**
	 * Get choices for sidebar position with default.
	 *
	 * @return array
	 */
	public static function get_choices_with_default() {
		static $choices;

		if ( ! isset( $choices ) ) {
			$choices = array_merge( [
				'default' => esc_html__( 'Default', 'aura-prime' ),
			], self::get_choices() );
		}

		return $choices;
	}

	/**
	 * Get choices for sidebar sticky.
	 *
	 * @return array
	 */
	public static function get_sticky_method_choices() {
		static $choices;

		if ( ! isset( $choices ) ) {
			$choices = [
				'disabled'    => esc_html__( 'Do not Stick', 'aura-prime' ),
				'top'         => esc_html__( 'Stick top edge of Sidebar', 'aura-prime' ),
				'bottom'      => esc_html__( 'Stick bottom edge of Sidebar', 'aura-prime' ),
				'last_widget' => esc_html__( 'Stick top edge of Last Widget', 'aura-prime' ),
			];
		}

		return $choices;
	}

	/**
	 * Add custom css classes to the <body> tag.
	 *
	 * @param  array $classes  CSS classes applied to the body tag.
	 * @return array $classes
	 */
	public static function add_body_classes( $classes ) {
		$position      = SidebarComponent::get_position();
		$sticky_method = SidebarComponent::get_sticky_method();

		// Conditional early exit.
		if ( ! $position ) {
			return $classes;
		}

		if ( 'disabled' === $position ) {
			$classes[] = 'aura--sidebar-disabled';
		} else {
			$classes[] = 'aura--sidebar-enabled';
			$classes[] = 'aura--sidebar-position-' . $position;
			$classes[] = 'aura--sidebar-sticky-' . Utils::dashify( $sticky_method );
		}

		return $classes;
	}
}
