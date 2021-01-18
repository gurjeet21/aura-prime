<?php
/**
 * The template for displaying Nothing Found.
 *
 * This template can be overridden by copying it to
 * your-child-theme/template-parts/nothing-found.php.
 *
 * @package MadeByAura\Prime
 * @author  MadeByAura.com
 *
 * @param array $args
 */

namespace MadeByAura\Prime;

defined( 'ABSPATH' ) || die();
?>

<div class="aura-nothing-found">
	<?php
	if ( is_404() ) {
		get_template_part( 'template-parts/error-404' );
	} elseif ( is_search() ) {
		get_template_part( 'template-parts/no-search-results' );
	} else {
		get_template_part( 'template-parts/no-posts' );
	}
	?>
</div><!-- .aura-nothing-found -->
