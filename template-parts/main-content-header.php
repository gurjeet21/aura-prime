<?php
/**
 * The template for displaying Header of Main Content.
 *
 * This template can be overridden by copying it to
 * your-child-theme/template-parts/main-content-header.php.
 *
 * @package MadeByAura\Prime
 * @author  MadeByAura.com
 *
 * @param array $args
 */

namespace MadeByAura\Prime;

defined( 'ABSPATH' ) || die();

$title  = '';
$object = get_queried_object();

if ( $object instanceof \WP_Term ) {
	$title = sprintf( '%1s: %2s', get_taxonomy( $object->taxonomy )->labels->singular_name, $object->name );
}

if ( ! $title ) {
	return;
}
?>

<div class="aura-main-content-header">
	<h1 class="aura-main-content-header__title">
		<?php echo esc_html( $title ); ?>
	</h1><!-- .aura-main-content-header__title -->
</div><!-- .aura-main-content-header -->
