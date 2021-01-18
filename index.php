<?php
/**
 * This is the most generic template file in a WordPress theme. It is used to
 * display a page when nothing more specific matches a query. E.g., it puts
 * together the home page when no home.php file exists.
 *
 * This template can be overridden by copying it to your-child-theme/index.php.
 *
 * @package MadeByAura\Prime
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime;

defined( 'ABSPATH' ) || die();

get_header();

get_template_part( 'template-parts/site/middle' );

get_footer();
