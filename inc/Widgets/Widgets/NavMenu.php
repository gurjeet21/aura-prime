<?php
/**
 * NavMenu Widget.
 *
 * @package MadeByAura\Prime\Widgets\Widgets
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Widgets\Widgets;

defined( 'ABSPATH' ) || die();

use MadeByAura\WPTools\Utils;
use MadeByAura\Prime\Base;

/**
 * NavMenu Widget.
 */
class NavMenu extends \WP_Widget {
	/**
	 * Sets up a new widget instance.
	 */
	public function __construct() {
		$css_class = Utils::get_widget_css_class( __CLASS__ );

		parent::__construct(
			$css_class,
			esc_attr__( '(Aura) Navigation Menu', 'aura-prime' ),
			[
				'classname'                   => $css_class,
				'description'                 => esc_attr__( 'Add a multi-level navigation menu to your sidebar.', 'aura-prime' ),
				'customize_selective_refresh' => true,
			]
		);
	}

	/**
	 * Widget output.
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Widget data.
	 */
	public function widget( $args, $instance ) {
		// Set widget defaults.
		$instance = wp_parse_args( (array) $instance, self::get_defaults() );

		// Early exit if there menu is empty.
		if ( ! $instance['menu'] ) {
			return;
		}

		// Set and filter title.
		$title = $instance['title'] ? $instance['title'] : '';
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		/**
		 * Render before widget.
		 */
		echo wp_kses_post( $args['before_widget'] );

		/**
		 * Render widget title.
		 */
		if ( $title ) {
			echo wp_kses_post( $args['before_title'] . $title . $args['after_title'] );
		}

		/**
		 * Render widget body.
		 */
		?>
			<div class="aura-nav-menu-widget">
				<?php
				wp_nav_menu( [
					'menu'      => $instance['menu'],
					'container' => false,
				] );
				?>
			</div><!-- .aura-nav-menu-widget -->
		<?php
		/**
		 * Render after widget.
		 */
		echo wp_kses_post( $args['after_widget'] );
	}

	/**
	 * Handles updating settings for the current widget instance.
	 *
	 * @param  array $new_instance New settings for this instance as input by the user via WP_Widget::form().
	 * @param  array $old_instance Old settings for this instance.
	 * @return array $instance     Settings to save or bool false to cancel saving.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['menu']  = (int) $new_instance['menu'];

		return $instance;
	}

	/**
	 * Outputs the widget settings form.
	 *
	 * @global WP_Customize_Manager $wp_customize
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		global $wp_customize;

		// Set widget defaults.
		$instance = wp_parse_args( (array) $instance, self::get_defaults() );

		$menus = Base::get_choices( 'menus' );
	?>

		<?php if ( empty( $menus ) ) : ?>
			<p class="nav-menu-widget-no-menus-message">
				<?php
					// Translators: 1: Opening anchor tag, 2: Closing anchor tag.
					echo wp_kses_post( sprintf( __( 'No menus have been created yet. %1$1sCreate some%2$2s.', 'aura-prime' ), '<a href="' . esc_attr( admin_url( 'nav-menus.php' ) ) . '">', '</a>' ) );
				?>
			</p>
		<?php else : ?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__( 'Title', 'aura-prime' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" placeholder="<?php echo esc_attr__( 'Optional', 'aura-prime' ); ?>">
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'menu' ) ); ?>"><?php echo esc_html__( 'Select Menu:', 'aura-prime' ); ?></label>
				<select id="<?php echo esc_attr( $this->get_field_id( 'menu' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'menu' ) ); ?>">
					<option value="0"><?php echo esc_html__( '&mdash; Select &mdash;', 'aura-prime' ); ?></option>
					<?php foreach ( $menus as $menu_id => $menu ) : ?>
						<option value="<?php echo esc_attr( $menu_id ); ?>" <?php selected( $instance['menu'], $menu_id ); ?>>
							<?php echo esc_html( $menu ); ?>
						</option>
					<?php endforeach; ?>
				</select>
			</p>
		<?php
		endif;
	}

	/**
	 * Widget defaults.
	 *
	 * @return array
	 */
	public static function get_defaults() {
		return [
			'title' => '',
			'menu'  => 0,
		];
	}
}
