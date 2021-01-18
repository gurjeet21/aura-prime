<?php
/**
 * PostLoop.
 *
 * @package MadeByAura\Modules\Prime
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Modules;

use MadeByAura\WPTools\Markup;

defined( 'ABSPATH' ) || die();

/**
 * PostLoop.
 */
class PostLoop {
	/**
	 * Arguments.
	 *
	 * @access protected
	 * @var array
	 */
	protected $args = [];

	/**
	 * HTML attributes.
	 *
	 * @access protected
	 * @var array
	 */
	protected $attrs = [];

	/**
	 * Query.
	 *
	 * @access protected
	 * @var WP_Query
	 */
	protected $query = [];

	/**
	 * Constructor.
	 *
	 * @access public
	 * @param  array $args - Arguments.
	 * @return void
	 */
	public function __construct( $args ) {
		$this->args = array_replace_recursive( [
			'id'              => [],
			'attrs'           => [],
			'layout'          => 'post-list',
			'layout_args'     => [],
			'query_args'      => [],
			'nothing_found'   => true,
			'pagination'      => true,
			'pagination_args' => true,
		], $args );

		$this->set_attrs();
		$this->set_query();
	}

	/**
	 * Set HTML attributes.
	 *
	 * @access protected
	 * @return void
	 */
	public function set_attrs() {
		$this->attrs = $this->args['attrs'];

		// CSS Classes.
		$classes[] = 'aura-posts';
		$classes[] = $this->args['layout'] ? "aura-posts--{$this->args['layout']}" : '';
		$classes[] = $this->args['id'] ? "aura-posts--{$this->args['id']}" : '';

		// Merge Classes.
		if ( ! empty( $this->attrs['class'] ) ) {
			$classes = Markup::merge_classes( $classes, $this->class );
		}

		$this->attrs['class'] = $classes;
	}

	/**
	 * Set query.
	 *
	 * @access protected
	 * @return void
	 */
	protected function set_query() {
		$this->query = new \WP_Query( $this->args['query_args'] );
	}

	/**
	 * Have posts.
	 *
	 * @access public
	 * @return bool
	 */
	public function have_posts() {
		return $this->query->have_posts();
	}

	/**
	 * Render posts.
	 *
	 * @access public
	 * @return void
	 */
	public function render_posts() {
		?>
			<?php if ( $this->query->have_posts() ) : ?>
				<div <?php Markup::echo_attrs( $this->attrs ); ?>>
					<?php while ( $this->query->have_posts() ) : ?>
						<?php $this->query->the_post(); ?>

						<?php get_template_part( "template-parts/post-layouts/{$this->args['layout']}", null, $this->args['layout_args'] ); ?>
					<?php endwhile; ?>

					<?php if ( true === $this->args['pagination'] ) : ?>
						<?php get_template_part( 'template-parts/pagination', null, $this->args['pagination'] ); ?>
					<?php endif; ?>
				</div><!-- .aura-posts -->
			<?php else : ?>
				<?php if ( true === $this->args['nothing_found'] ) : ?>
					<?php get_template_part( 'template-parts/nothing-found' ); ?>
				<?php endif; ?>
			<?php endif; ?>
		<?php

		// After looping through a custom query, this function restores the $post
		// global to the current post in the main query.
		wp_reset_postdata();
	}
}
