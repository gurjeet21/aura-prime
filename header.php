<?php
/**
 * The template for displaying the footer. This is the template that displays
 * all of the <head> section and everything up until .aura-middle div.
 *
 * This template can be overridden by copying it to your-child-theme/header.php.
 *
 * @package MadeByAura\Prime
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime;

defined( 'ABSPATH' ) || die();
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php
	wp_body_open();

	do_action( 'aura_theme_site_open' );

	get_template_part( 'template-parts/site/header' );
