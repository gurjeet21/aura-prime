<?php
/**
 * Add customizer panels and fields using Kirki.
 *
 * @link https://wordpress.org/plugins/kirki/
 *
 * @package MadeByAura\Prime\Plugins\Kirki
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Plugins\Kirki;

defined( 'ABSPATH' ) || die();

use MadeByAura\Prime\Plugins\Kirki\Modules\Customizer;

$group    = 'spacer';
$priority = 10;

// Spacer.
Customizer::add_section( $group, [
	'type' => 'spacer',
] );

// Spacer > Placeholder.
$key      = 'placeholder';
$priority = Customizer::add_field( $group, $key, $priority, [
	'type' => 'hidden',
] );
