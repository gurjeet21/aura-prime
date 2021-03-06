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

$group = 'general';

// General.
Customizer::add_panel( $group, [
	'title' => esc_attr__( 'General', 'aura-prime' ),
] );
