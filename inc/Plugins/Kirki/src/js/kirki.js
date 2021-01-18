/* -----------------------------------------------------------------------------
 * Aura Prime > Kirki
 * -------------------------------------------------------------------------- */
(function($) {
	'use strict'

	/* ---------------------------------------------------------------------------
	 * Initialize functions
	 * ------------------------------------------------------------------------ */
	document.addEventListener('DOMContentLoaded', () => {
		collapsibles()
	})

	/* ---------------------------------------------------------------------------
	 * Site scrolled
	 * ------------------------------------------------------------------------ */
	const collapsibles = () => {
		// Collapse all collapsibles.
		$('.customize-collapsible')
			.closest('li[id*="_collapsible_block"]')
			.toggleClass('customize-control-collapsed')

		$('.customize-collapsible')
			.closest('li[id*="_collapsible_block"]')
			.nextUntil('li[id*="_collapsible_block"]')
			.toggleClass('customize-control-hidden')

		// Expand on click.
		$('.customize-collapsible').click(function() {
			$(this)
				.closest('li[id*="_collapsible_block"]')
				.toggleClass('customize-control-collapsed')

			$(this)
				.closest('li[id*="_collapsible_block"]')
				.nextUntil('li[id*="_collapsible_block"]')
				.toggleClass('customize-control-hidden')
		})
	}
})(jQuery)
