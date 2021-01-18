<?php
/**
 * The template for displaying Content in Post.
 *
 * This template can be overridden by copying it to
 * your-child-theme/template-parts/post/content.php.
 *
 * @package MadeByAura\Prime
 * @author  MadeByAura.com
 *
 * @param array $args
 */

namespace MadeByAura\Prime;

defined( 'ABSPATH' ) || die();
?>

<div class="aura-post__content">
	<?php the_content(); ?>
</div><!-- .aura-post__content -->
