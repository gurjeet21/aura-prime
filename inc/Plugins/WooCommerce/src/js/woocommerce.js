/* -----------------------------------------------------------------------------
 * Aura Prime WooCommerce
 * -------------------------------------------------------------------------- */
;(function($) {
	'use strict'

	document.addEventListener('DOMContentLoaded', () => {
		quantityButtons()
	})

	/* ---------------------------------------------------------------------------
	 * Quanitity Buttons
	 * ------------------------------------------------------------------------ */
	const quantityButtons = () => {
		$(document).on('click', '.quantity .quantity-plus', function(e) {
			e.preventDefault()

			const input = $(this).siblings('.qty')
			const value = parseInt(input.val())

			input.val(value + 1)
			input.trigger('input')
		})

		$(document).on('click', '.quantity .quantity-minus', function(e) {
			e.preventDefault()

			const input = $(this).siblings('.qty')
			const value = parseInt(input.val())

			if (value > 1) {
				input.val(value - 1)
				input.trigger('input')
			}
		})
	}
})(jQuery) // eslint-disable-line no-undef
