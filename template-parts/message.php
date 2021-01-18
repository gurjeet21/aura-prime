<?php
/**
 * The template for displaying Message.
 *
 * This template can be overridden by copying it to
 * your-child-theme/template-parts/message.php.
 *
 * @package MadeByAura\Prime
 * @author  MadeByAura.com
 *
 * @param array $args
 */

namespace MadeByAura\Prime;

defined( 'ABSPATH' ) || die();

use MadeByAura\WPTools\Utils;
use MadeByAura\WPTools\Markup;

// Merge incoming `$args` with defaults.
$args = array_replace_recursive( [
	'type' => 'warning',
	'text' => '',
], $args );

// Conditional early exit.
if ( ! $args['text'] ) {
	$args['text'] = __( '<var>text</var> is required to display <em>Message</em>.', 'aura-prime' );
}

// Classes.
$classes[] = 'aura-message';

// Type classes.
if ( $args['type'] ) {
	$classes[] = 'aura-message--type-' . Utils::dashify( $args['type'] );
}
?>

<div class="<?php Markup::echo_classes( $classes ); ?>">
	<?php echo wp_kses_post( $args['text'] ); ?>
</div><!-- .aura-message -->
