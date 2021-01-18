/* globals auraPrimeApp, jQuery */

;(function($) {
	'use strict'

	document.addEventListener('DOMContentLoaded', () => {
		siteScolled()
		stickyHeader()
		menuHashLinkFix()
		navMenuWidget()
		overlays()
	})

	/* ---------------------------------------------------------------------------
	 * Variables.
	 * ------------------------------------------------------------------------ */
	const app = auraPrimeApp
	const bodyEl = document.querySelector('body')

	/* ---------------------------------------------------------------------------
	 * Check if the site is scrolled.
	 * ------------------------------------------------------------------------ */
	const siteScolled = () => {
		const setDataAttribute = (scrollY, offset) => {
			const dataAttribute = 'data-aura-site-scolled'

			if (scrollY > offset) {
				bodyEl.setAttribute(dataAttribute, 'true')
			} else {
				bodyEl.setAttribute(dataAttribute, 'false')
			}
		}

		let offset = 0

		if (bodyEl.classList.contains('admin-bar')) {
			offset += document.querySelector('#wpadminbar').clientHeight
		}

		setDataAttribute(window.scrollY, offset)

		window.addEventListener('scroll', () => {
			setDataAttribute(window.scrollY, offset)
		})
	}

	/* ---------------------------------------------------------------------------
	 * Sticky header.
	 * ------------------------------------------------------------------------ */
	const stickyHeader = () => {
		const dataAttribute = 'data-aura-sticky-header'
		let oldScrollPosition = window.scrollY

		const setDataAttribute = offset => {
			const newScrollPosition = window.scrollY
			let scrollDirection = 'down'

			if (newScrollPosition < oldScrollPosition) {
				scrollDirection = 'up'
			}

			if (newScrollPosition > offset && scrollDirection === 'up') {
				bodyEl.setAttribute(dataAttribute, 'true')
			} else {
				bodyEl.setAttribute(dataAttribute, 'false')
			}

			oldScrollPosition = newScrollPosition
		}

		let offset = 0
		const headerEl = document.querySelector('.aura-header')

		if (headerEl) {
			offset += headerEl.clientHeight
		}

		if (bodyEl.classList.contains('admin-bar')) {
			offset += document.querySelector('#wpadminbar').clientHeight
		}

		setDataAttribute(offset)

		window.addEventListener('scroll', () => {
			setDataAttribute(offset)
		})
	}

	/* ---------------------------------------------------------------------------
	 * Fix hash links in menus
	 * ------------------------------------------------------------------------ */
	const menuHashLinkFix = () => {
		$('.aura-menu a[href="#"]').on('click', function(e) {
			e.preventDefault()
		})
	}

	/* ---------------------------------------------------------------------------
	 * Collapsible Navigation Menu Widget.
	 * ------------------------------------------------------------------------ */
	const navMenuWidget = () => {
		const buttonClass = 'aura-nav-menu-widget__submenu-button'
		const dataAttribute = 'data-aura-submenu'

		$('.aura-nav-menu-widget .menu-item-has-children').each(function() {
			// Add sub menu button.
			$(this).append(
				`<div class="${buttonClass}"><span>${app.navMenuWidget.open}</span></div>`
			)

			// Activate expandOnClickNavigation() on menu buttons.
			$(`> .${buttonClass}`, this).on('click', function(e) {
				e.preventDefault()
				$(this).expandOnClickNavigation()
			})

			// Activate expandOnClickNavigation() on the parents with # href attribute.
			$('> a', this).on('click', function(e) {
				if ('#' === $(this).attr('href')) {
					e.preventDefault()
					$(this).expandOnClickNavigation()
				}
			})

			$.fn.expandOnClickNavigation = function() {
				const menuEl = $(this).parent()
				const buttonEl = menuEl.children(`.${buttonClass} span`)
				const subMenuEl = menuEl.children('.sub-menu')
				const allSubMenuEl = menuEl.find('.sub-menu')
				const childrenMenuEl = menuEl.find('.menu-item-has-children')

				if ('expanded' === menuEl.attr(dataAttribute)) {
					// Change status to collapsed.
					menuEl.attr(dataAttribute, 'collapsed')
					// slideUp all sub menus.
					allSubMenuEl.slideUp(250)
					// Change status of all children to collapsed.
					childrenMenuEl.attr(dataAttribute, 'collapsed')
					// Change button text.
					buttonEl.text(app.navMenuWidget.open)
				} else {
					// Change status to expanded.
					menuEl.attr(dataAttribute, 'expanded')
					// slideUp sub-menu that is a direct child.
					subMenuEl.slideDown(250)
					// Change button text.
					buttonEl.text(app.navMenuWidget.close)
				}
			}
		})
	}

	/* ---------------------------------------------------------------------------
	 * Overlays.
	 * ------------------------------------------------------------------------ */
	const overlays = () => {
		const strings = {
			overlay: '.aura-overlay',
			overlayInner: '.aura-overlay__inner',
			open: 'data-aura-overlay--open',
			close: 'data-aura-overlay--close',
			toggle: 'data-aura-overlay--toggle',
			active: 'is-active',
			scrollEnabled: 'aura-scroll--enabled',
			scrollDisabled: 'aura-scroll--disabled'
		}

		const scrollBarWidth =
			window.innerWidth - document.documentElement.clientWidth

		// Open on click.
		document.querySelectorAll(`[${strings.open}]`).forEach(triggerEl => {
			triggerEl.addEventListener('click', e => {
				e.preventDefault()
				const id = triggerEl.getAttribute(strings.open)
				openOverlay(getOverlayEl(id))
			})
		})

		// Close on click.
		document.querySelectorAll(`[${strings.close}]`).forEach(triggerEl => {
			triggerEl.addEventListener('click', e => {
				e.preventDefault()
				const id = triggerEl.getAttribute(strings.close)
				closeOverlay(getOverlayEl(id))
			})
		})

		// Toggle on click.
		document.querySelectorAll(`[${strings.toggle}]`).forEach(triggerEl => {
			triggerEl.addEventListener('click', e => {
				e.preventDefault()
				const id = triggerEl.getAttribute(strings.toggle)
				const overlayEl = getOverlayEl(id)

				if (overlayEl.classList.contains(strings.active)) {
					closeOverlay(overlayEl)
				} else {
					openOverlay(overlayEl)
				}
			})
		})

		// Get Overlay element.
		const getOverlayEl = id => {
			return document.querySelector(`.aura-overlay[data-id="${id}"]`)
		}

		// Open Overlay.
		const openOverlay = overlayEl => {
			const overlayInnerEl = overlayEl.querySelector(strings.overlayInner)

			bodyEl.classList.add(strings.scrollDisabled)
			bodyEl.style.paddingRight = scrollBarWidth
			overlayEl.classList.add(strings.active)
			overlayInnerEl.classList.remove(strings.scrollDisabled)
		}

		// Close Overlay.
		const closeOverlay = overlayEl => {
			const overlayInnerEl = overlayEl.querySelector(strings.overlayInner)

			bodyEl.classList.remove(strings.scrollDisabled)
			bodyEl.style.paddingRight = 0
			overlayEl.classList.remove(strings.active)
			overlayInnerEl.classList.add(strings.scrollDisabled)
		}
	}
})(jQuery)
