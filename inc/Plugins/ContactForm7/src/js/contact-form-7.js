/* globals jQuery, Lightpick, moment, autosize */

;(function($) {
	;('use strict')

	var auraPrimeContactForm7 = auraPrimeContactForm7 || {}

	/* ---------------------------------------------------------------------------
	 * Initialize functions
	 * ------------------------------------------------------------------------ */
	$(document).ready(function() {
		auraPrimeContactForm7.checkboxRadioMarkup()
		auraPrimeContactForm7.rating()
		auraPrimeContactForm7.disbaleNumberInputExponentials()
		auraPrimeContactForm7.autosizeTextarea()
		auraPrimeContactForm7.datepicker()
		auraPrimeContactForm7.materialFloatingLabels()
		auraPrimeContactForm7.fileInput()
	})

	/* ---------------------------------------------------------------------------
	 * Change markup for checkbox and radio fields.
	 * ------------------------------------------------------------------------ */
	auraPrimeContactForm7.checkboxRadioMarkup = function() {
		var id = 0

		$(
			'.aura-cf7__field--type-checkbox, .aura-cf7__field--type-radio, .aura-cf7__field--type-rating'
		).each(function() {
			var $this = $(this)
			var $items = $this.find('.wpcf7-list-item')

			$items.each(function() {
				id++

				// Change tag of .wpcf7-list-item-label to label.
				var $label = $(this).find('.wpcf7-list-item-label')
				$label.replaceWith(
					$(
						'<label class="wpcf7-list-item-label"><span></span>' +
							$label.html() +
							'</label>'
					)
				)

				// Add ID to label and input.
				var fullId = 'aura-field-' + id
				$(this)
					.find('input')
					.attr('id', fullId)
				$(this)
					.find('.wpcf7-list-item-label')
					.attr('for', fullId)
			})
		})
	}

	/* ---------------------------------------------------------------------------
	 * Disable Exponentials on number input fields.
	 * ------------------------------------------------------------------------ */
	auraPrimeContactForm7.disbaleNumberInputExponentials = function() {
		$('.aura-cf7__field input[type="number"]').on('keypress', function(e) {
			if ('e' === e.key || '+' === e.key || '-' === e.key) {
				e.preventDefault()
			}
		})
	}

	/* ---------------------------------------------------------------------------
	 * Rating field.
	 * ------------------------------------------------------------------------ */
	auraPrimeContactForm7.rating = function() {
		document
			.querySelectorAll('.aura-cf7__field--type-rating input[type="radio"]')
			.forEach(radioInput => {
				radioInput.addEventListener('click', e => {
					// Add `has-selection` class to the grand parent of the target element.
					e.target.parentElement.parentElement.classList.add('has-selection')

					// Remove checked class from all elements.
					e.target.parentElement.parentElement.childNodes.forEach(child => {
						child.classList.remove('selected')
					})

					// Add selected class to the target element.
					e.target.parentElement.classList.add('selected')
				})
			})
	}

	/* ---------------------------------------------------------------------------
	 * Autosize Textarea
	 * ------------------------------------------------------------------------ */
	auraPrimeContactForm7.autosizeTextarea = function() {
		var target = '.aura-cf7__field--type-textarea textarea'
		autosize($(target))

		// On successful form submission.
		$(document).bind('wpcf7mailsent', function() {
			// Give Contact Form 7 some time to reset the form after submission
			// and then continue.
			setTimeout(function() {
				autosize.update($(target))
			}, 50)
		})
	}

	/* ---------------------------------------------------------------------------
	 * Datepicker
	 * ------------------------------------------------------------------------ */
	auraPrimeContactForm7.datepicker = function() {
		var container = '.aura-cf7__field'

		$('.aura-cf7__field--type-date .wpcf7-form-control').each(function() {
			var fieldEl = this

			$(fieldEl).attr('readonly', true)

			new Lightpick({
				field: fieldEl,
				format: 'MMM Do, YYYY',
				minDate: moment(),
				onSelect: function() {
					$(fieldEl).trigger('input')
				},
				onOpen: function() {
					$(fieldEl)
						.closest(container)
						.attr('data-aura-has-datepicker', '')
				},
				onClose: function() {
					$(fieldEl)
						.closest(container)
						.removeAttr('data-aura-has-datepicker')
				}
			})
		})
	}

	/* ---------------------------------------------------------------------------
	 * Material floating labels
	 * ------------------------------------------------------------------------ */
	auraPrimeContactForm7.materialFloatingLabels = function() {
		var container = '.aura-cf7__field'
		var field =
			'.aura-cf7__form--type-material .aura-cf7__field .wpcf7-form-control'

		// On load.
		$(field).each(function() {
			has_focus($(this))
			has_value($(this))
		})

		// On change.
		$(field).on('input', function() {
			has_value($(this))
		})

		// On form submission.
		$(document).bind('wpcf7submit', function(e) {
			$(field, e.target).each(function() {
				is_invalid($(this))
			})
		})

		// On successful form submission.
		$(document).bind('wpcf7mailsent', function(e) {
			// Give Contact Form 7 some time to reset the form after submission
			// and then continue.
			setTimeout(function() {
				$(field, e.target).each(function() {
					has_value($(this))
				})
			}, 50)
		})

		// If field has focus.
		function has_focus($field) {
			if ($field.is('select') || $field.is('[readonly]')) {
				return
			}

			$field.focus(function() {
				if ($field.attr('readonly')) {
					return
				}

				$field.closest(container).attr('data-aura-has-focus', '')
			})

			$field.blur(function() {
				$field.closest(container).removeAttr('data-aura-has-focus')
			})
		}

		// If field has value.
		function has_value($field) {
			var has_value = false

			if ('' !== $field.val()) {
				has_value = true
			}

			if (true === has_value) {
				$field.closest(container).attr('data-aura-has-value', '')
			} else {
				$field.closest(container).removeAttr('data-aura-has-value')
			}
		}

		// If field is invalid.
		function is_invalid($field) {
			if ($field.hasClass('wpcf7-not-valid')) {
				$field.closest(container).attr('data-aura-invalid', '')
			} else {
				$field.closest(container).removeAttr('data-aura-invalid')
			}
		}
	}

	/* ---------------------------------------------------------------------------
	 * File input
	 * ------------------------------------------------------------------------ */
	auraPrimeContactForm7.fileInput = function() {
		const fileFields = document.querySelectorAll('.aura-cf7__field--type-file')

		if (!fileFields) {
			return
		}

		fileFields.forEach(fileField => {
			const input = fileField.querySelector('.wpcf7-form-control')
			const button = fileField.querySelector('.aura-button')

			button.addEventListener('click', e => {
				e.preventDefault()
				console.log('shady')
				input.click()
			})

			input.addEventListener('change', e => {
				button.querySelector('.aura-button__text').textContent =
					e.target.files[0].name
			})
		})
	}
})(jQuery)
