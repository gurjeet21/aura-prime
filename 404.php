<?php
/**
 * This is template file for Page Not Found in a WordPress theme. It is used to
 * display a page when nothing more specific matches a query. E.g., it puts
 * together the search page when no home.php file exists.
 *
 * This template can be overridden by copying it to your-child-theme/404.php.
 *
 * @package MadeByAura\Prime
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime;

defined( 'ABSPATH' ) || die();

get_header();

get_template_part( 'template-parts/nothing-found' );

get_footer();
