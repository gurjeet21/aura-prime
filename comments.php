<?php
/**
 * The template for displaying comments. It contains both the current comments
 * and the comment form.
 *
 * This template can be overridden by copying it to
 * your-child-theme/comments.php.
 *
 * @package MadeByAura\Prime
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime;

defined( 'ABSPATH' ) || die();

/*
 * Don't proceed if the current post is protected by a password and the visitor
 * has not yet entered the password.
 */
if ( post_password_required() ) {
	return;
}

get_template_part( 'template-parts/comments' );
