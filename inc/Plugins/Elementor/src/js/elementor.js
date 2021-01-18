/* -----------------------------------------------------------------------------
 * Aura Prime > Elementor
 * -------------------------------------------------------------------------- */
(function($) {
	'use strict'

	document.addEventListener('DOMContentLoaded', () => {
		hamburgerMenuModal()
	})

	/* ---------------------------------------------------------------------------
	 * Hamburger Menu Modal.
	 * ------------------------------------------------------------------------ */
	const hamburgerMenuModal = () => {
		var container = '[data-aura-hamburger-menu]'
		var modifier = 'data-aura-hamburger-menu--enabled'

		var toggle = '[data-aura-hamburger-menu--toggle]'
		var open = '[data-aura-hamburger-menu--open]'
		var close = '[data-aura-hamburger-menu--close]'

		var openButton = '[data-aura-hamburger-menu--open-button]'

		var scrollDisabled = 'data-aura-scroll-disabled'
		var scrollEnabled = 'data-aura-scroll-enabled'
		var bodyScrollbarWidth =
			window.innerWidth - document.documentElement.clientWidth

		$(open)
			.off()
			.on('click', function(e) {
				e.preventDefault() // prevent default action of an anchor
				openOverlay(this)
			})

		$(close)
			.off()
			.on('click', function(e) {
				e.preventDefault() // prevent default action of an anchor
				closeOverlay(this)
			})

		$(toggle)
			.off()
			.on('click', function(e) {
				e.preventDefault() // prevent default action of an anchor

				if (
					$(this)
						.parents(container)
						.hasClass(modifier)
				) {
					close(this)
				} else {
					open(this)
				}
			})

		function openOverlay(currentElement) {
			var currentContainer = $(currentElement).parents(container)
			var currentOpenButton = $(currentContainer).find(openButton)

			$(currentContainer).attr(modifier, '')
			$(currentOpenButton).attr(modifier, '')
			$('body').removeAttr(scrollEnabled)
			$('body').attr(scrollDisabled, '')
			$('body').css('padding-right', bodyScrollbarWidth)
		}

		function closeOverlay(currentElement) {
			var currentContainer = $(currentElement).parents(container)
			var currentOpenButton = $(currentContainer).find(openButton)

			$(currentContainer).removeAttr(modifier)
			$(currentOpenButton).removeAttr(modifier)
			$('body').removeAttr(scrollDisabled)
			$('body').attr(scrollEnabled, '')
			$('body').css('padding-right', '')
		}
	}
})(jQuery)
