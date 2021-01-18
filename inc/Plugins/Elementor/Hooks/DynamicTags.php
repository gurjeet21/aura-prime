<?php
/**
 * DynamicTags.
 *
 * @package MadeByAura\Prime\Plugins\Elementor\Hooks
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Plugins\Elementor\Hooks;

defined( 'ABSPATH' ) || die();

use Elementor\Plugin as Elementor;
use MadeByAura\Prime\Base;

/**
 * DynamicTags.
 */
class DynamicTags {
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
		// Register tags.
		add_action( 'elementor/dynamic_tags/register_tags', [ __CLASS__, 'register_tag_groups' ], 20 );
		add_action( 'elementor/dynamic_tags/register_tags', [ __CLASS__, 'register_tags' ], 20 );
	}

	/**
	 * Register tag groups.
	 *
	 * @return void
	 */
	public static function register_tag_groups() {
		Elementor::$instance->dynamic_tags->register_group( get_template(), [
			'title' => __( 'Aura Prime', 'aura-prime' ),
		] );
	}

	/**
	 * Register tags.
	 *
	 * @return void
	 */
	public static function register_tags() {
		$namespace = Base::get_info( 'namespace' ) . '\\Plugins\\Elementor\\DynamicTags\\';

		$tags = [
			'PageTitle',
		];

		foreach ( $tags as $tag ) {
			$class = $namespace . $tag;

			Elementor::instance()->dynamic_tags->register_tag( new $class() );
		}
	}
}
