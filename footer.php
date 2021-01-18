<?php
/**
 * The template for displaying the footer. It contains the closing of the
 * .aura-middle div and all content after.
 *
 * This template can be overridden by copying it to your-child-theme/footer.php.
 *
 * @package MadeByAura\Prime
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime;

defined( 'ABSPATH' ) || die();

	get_template_part( 'template-parts/site/footer' );

	do_action( 'aura_theme_site_close' );

	wp_footer();
	?>
</body>
</html>
