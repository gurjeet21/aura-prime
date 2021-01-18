<?php
/**
 * The template for displaying Header Meta in Post.
 *
 * This template can be overridden by copying it to
 * your-child-theme/template-parts/post/header-meta.php.
 *
 * @package MadeByAura\Prime
 * @author  MadeByAura.com
 *
 * @param array $args
 */

namespace MadeByAura\Prime;

defined( 'ABSPATH' ) || die();
?>

<div class="aura-post__header-meta">
	<?php
	get_template_part( 'template-parts/post/date' );
	get_template_part( 'template-parts/post/comments-count' );
	?>
</div><!-- .aura-post__header-meta -->
