<?php
/**
 * The template for displaying Search Form.
 *
 * This template can be overridden by copying it to
 * your-child-theme/template-parts/search-form.php.
 *
 * @package MadeByAura\Prime
 * @author  MadeByAura.com
 *
 * @param array $args
 */

namespace MadeByAura\Prime;

defined( 'ABSPATH' ) || die();
?>

<form class="aura-search-form" method="get" action="<?php echo esc_url( trailingslashit( get_site_url() ) ); ?>">
	<input classs="aura-search-form__text" type="text" name="s" placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder', 'aura-prime' ); ?>">

	<?php
	get_template_part( 'template-parts/button', null, [
		'wrapper'         => 'search-form__button',
		'tag'             => 'button',
		'text'            => _x( 'Search', 'submit button', 'aura-prime' ),
		'text_hidden'     => true,
		'icon_font_class' => 'fa fa-search',
	] );
	?>
</form>
