<?php
/**
 * The template for displaying No Search Results.
 *
 * This template can be overridden by copying it to
 * your-child-theme/template-parts/no-search-results.php.
 *
 * @package MadeByAura\Prime
 * @author  MadeByAura.com
 *
 * @param array $args
 */

namespace MadeByAura\Prime;

defined( 'ABSPATH' ) || die();
?>

<div class="aura-no-search-results">
	<h2 class="aura-no-search-results__title">
		<?php echo esc_html__( 'Nothing Found', 'aura-prime' ); ?>
	</h2>

	<div class="aura-no-search-results__description">
		<?php
		// Translators: 1: Search term.
		echo wp_kses_post( sprintf( __( 'No search results were found for %1s. Please try another keyword.', 'aura-prime' ), '"<em>' . get_search_query() . '</em>"' ) );
		?>
	</div><!-- .aura-no-search-results__description -->
</div><!-- .aura-no-search-results -->
