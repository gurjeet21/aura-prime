<?php
/**
 * The template for displaying Content.
 *
 * This template can be overridden by copying it to
 * your-child-theme/template-parts/site/content.php.
 *
 * @package MadeByAura\Prime
 * @author  MadeByAura.com
 *
 * @param array $args
 */

namespace MadeByAura\Prime;

defined( 'ABSPATH' ) || die();

do_action( 'aura_theme_content_open' );
do_action( 'aura_theme_content' );
do_action( 'aura_theme_content_close' );
