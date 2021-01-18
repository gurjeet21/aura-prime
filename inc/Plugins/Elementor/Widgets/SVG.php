<?php
/**
 * Elementor widget SVG.
 *
 * @package MadeByAura\Prime\Plugins\Elementor\Widgets
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Plugins\Elementor\Widgets;

defined( 'ABSPATH' ) || die();

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use MadeByAura\Prime\Base;

/**
 * Elementor widget SVG.
 */
class SVG extends Widget_Base {
	/**
	 * Get the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return get_template() . '-svg';
	}

	/**
	 * Get the widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'SVG', 'aura-prime' );
	}

	/**
	 * Get the list of keywords the widget belongs to.
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'aura', 'svg' ];
	}

	/**
	 * Get the widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-integration';
	}

	/**
	 * Get the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
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

		// ID.
		$this->add_control( 'svg_id', [
			'type'    => Controls_Manager::SELECT,
			'label'   => __( 'ID', 'aura-prime' ),
			'options' => Base::get_choices( 'svg' ),
		] );

		// Link.
		$this->add_control( 'link', [
			'type'        => Controls_Manager::URL,
			'label'       => __( 'Link', 'aura-prime' ),
			'label_block' => false,
		] );

		$this->end_controls_section();

		$this->start_controls_section( 'section_size', [
			'label' => __( 'Size', 'aura-prime' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		// Width.
		$this->add_responsive_control( 'width', [
			'type'       => Controls_Manager::SLIDER,
			'label'      => __( 'Width', 'aura-prime' ),
			'range'      => [
				'px' => [
					'min' => 1,
					'max' => 500,
				],
			],
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .aura-svg' => 'width: {{SIZE}}{{UNIT}};',
			],
		] );

		// Height.
		$this->add_responsive_control( 'height', [
			'type'       => Controls_Manager::SLIDER,
			'label'      => __( 'Height', 'aura-prime' ),
			'range'      => [
				'px' => [
					'min' => 1,
					'max' => 500,
				],
			],
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .aura-svg' => 'height: {{SIZE}}{{UNIT}};',
			],
		] );

		// Max Width.
		$this->add_responsive_control( 'max_width', [
			'type'       => Controls_Manager::SLIDER,
			'label'      => __( 'Max Width', 'aura-prime' ),
			'range'      => [
				'px' => [
					'min' => 1,
					'max' => 500,
				],
			],
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .aura-svg' => 'max-width: {{SIZE}}{{UNIT}};',
			],
		] );

		// Max Height.
		$this->add_responsive_control( 'max_height', [
			'type'       => Controls_Manager::SLIDER,
			'label'      => __( 'Max Height', 'aura-prime' ),
			'range'      => [
				'px' => [
					'min' => 1,
					'max' => 500,
				],
			],
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .aura-svg' => 'max-height: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();

		$this->start_controls_section( 'section_colors', [
			'label' => __( 'Colors', 'aura-prime' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'color', [
			'label'     => __( 'Color', 'aura-prime' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .aura-svg' => '--aura-svg--color: {{VALUE}};',
			],
		] );

		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render() {
		// Get settings.
		$settings = $this->get_settings_for_display();
	?>
		<?php if ( $settings['link']['url'] ) : ?>
			<a class="aura-elementor-widget-svg__link"
					href="<?php echo esc_url( $settings['link']['url'] ); ?>"
						target="<?php $settings['link']['is_external'] ? '_blank' : ''; ?>"
							rel="<?php $settings['link']['nofollow'] ? 'nofollow' : ''; ?>">
				<?php
				get_template_part( 'template-parts/svg', null, [
					'id' => $settings['svg_id'],
				] );
				?>
			</a>
		<?php endif; ?>
	<?php
	}

	/**
	 * Render button widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */
	protected function _content_template() {}
}
