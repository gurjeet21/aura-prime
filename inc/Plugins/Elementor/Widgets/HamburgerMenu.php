<?php
/**
 * Elementor widget HamburgerMenu.
 *
 * @package MadeByAura\Prime\Plugins\Elementor\Widgets
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Plugins\Elementor\Widgets;

defined( 'ABSPATH' ) || die();

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use MadeByAura\WPTools\Markup;

/**
 * Elementor widget HamburgerMenu.
 */
class HamburgerMenu extends Widget_Base {
	/**
	 * Get the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return get_template() . '-hamburder-menu';
	}

	/**
	 * Get the widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Hamburger Menu', 'aura-prime' );
	}

	/**
	 * Get the list of keywords the widget belongs to.
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'aura', 'menu' ];
	}

	/**
	 * Get the widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-menu-bar';
	}

	/**
	 * Get the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ get_template() ];
	}

	/**
	 * Get the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function _register_controls() {
		$this->start_controls_section( 'section_content', [
			'label' => __( 'Content', 'aura-prime' ),
		] );

		$this->add_control( 'template_shortcode', [
			'type'  => Controls_Manager::TEXTAREA,
			'label' => __( 'Template Shortcode', 'aura-prime' ),
			'rows'  => 2,
		] );

		$this->end_controls_section();

		$this->start_controls_section( 'section_open_button', [
			'label' => __( 'Hamburger Button', 'aura-prime' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'open_button_color', [
			'type'      => Controls_Manager::COLOR,
			'label'     => __( 'Color', 'aura-prime' ),
			'default'   => '#333',
			'selectors' => [
				'{{WRAPPER}} .aura-hamburger-menu__open-button .aura-hamburger' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'open_button_color_hover', [
			'type'      => Controls_Manager::COLOR,
			'label'     => __( 'Hover Color', 'aura-prime' ),
			'default'   => '#333',
			'selectors' => [
				'{{WRAPPER}} .aura-hamburger-menu__open-button .aura-hamburger:hover' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'open_button_alignment', [
			'type'        => Controls_Manager::CHOOSE,
			'label'       => __( 'Alignment', 'aura-prime' ),
			'label_block' => false,
			'options'     => [
				'flex-start' => [
					'title' => __( 'Left', 'aura-prime' ),
					'icon'  => 'eicon-h-align-left',
				],
				'center'     => [
					'title' => __( 'Center', 'aura-prime' ),
					'icon'  => 'eicon-h-align-center',
				],
				'flex-end'   => [
					'title' => __( 'Right', 'aura-prime' ),
					'icon'  => 'eicon-h-align-right',
				],
			],
			'selectors'   => [
				'{{WRAPPER}} .aura-hamburger-menu' => 'justify-content: {{VALUE}};',
			],
		] );

		$this->end_controls_section();

		$this->start_controls_section( 'section_overlay', [
			'label' => __( 'Overlay', 'aura-prime' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'overlay_alignment', [
			'type'        => Controls_Manager::CHOOSE,
			'label'       => __( 'Alignment', 'aura-prime' ),
			'label_block' => false,
			'default'     => 'left',
			'options'     => [
				'left'  => [
					'title' => __( 'Left', 'aura-prime' ),
					'icon'  => 'eicon-h-align-left',
				],
				'right' => [
					'title' => __( 'Right', 'aura-prime' ),
					'icon'  => 'eicon-h-align-right',
				],
			],
		] );

		$this->end_controls_section();

		$this->start_controls_section( 'section_overlay_background', [
			'label' => __( 'Overlay Background', 'aura-prime' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'     => 'section_overlay_background',
			'label'    => __( 'Background', 'aura-prime' ),
			'selector' => '{{WRAPPER}} .aura-hamburger-menu__overlay-body',
		] );

		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$classes[] = 'aura-hamburger-menu';
		$classes[] = 'aura-hamburger-menu--alignment-' . $settings['overlay_alignment'];
	?>
		<div <?php Markup::echo_class_attr( $classes ); ?> data-aura-hamburger-menu="true">
			<div class="aura-hamburger-menu__open-button">
				<?php
				get_template_part( 'template-parts/hamburger', null, [
					'attrs' => [
						'data-aura-hamburger-menu--open' => true,
					],
				] );
				?>
			</div><!-- .aura-hamburger-menu__open-button -->

			<div class="aura-hamburger-menu__overlay">
				<div class="aura-hamburger-menu__overlay-background" data-aura-hamburger-menu--close="true">
					<div class="aura-hamburger-menu__close-button">
						<?php
						get_template_part( 'template-parts/hamburger', null, [
							'closed' => true,
							'attrs'  => [
								'data-aura-hamburger-menu--close' => true,
							],
						] );
						?>
					</div><!-- .aura-hamburger-menu__close-button -->
				</div><!-- .aura-hamburger-menu__overlay-background -->

				<div class="aura-hamburger-menu__overlay-body">
					<div class="aura-hamburger-menu__overlay-inner">
						<?php echo do_shortcode( $settings['template_shortcode'] ); ?>
					</div><!-- .aura-hamburger-menu__overlay-inner -->
				</div><!-- .aura-hamburger-menu__overlay-body -->
			</div><!-- .aura-hamburger-menu__overlay -->
		</div><!-- .aura-hamburger-menu -->
	<?php
	}

	/**
	 * Render button widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */
	protected function _content_template() {}
}
