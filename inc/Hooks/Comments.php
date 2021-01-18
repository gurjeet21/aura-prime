<?php
/**
 * Comments.
 *
 * @package MadeByAura\Prime\Hooks
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Hooks;

defined( 'ABSPATH' ) || die();

/**
 * Comments.
 */
class Comments {
	/**
	 * Instance.
	 *
	 * @var object  Class object.
	 */
	private static $instance;

	/**
	 * Instantiator.
	 *
	 * @return object  Class instance.
	 */
	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Constructor.
	 *
	 * @return void
	 */
	protected function __construct() {
		self::add_hooks();
	}

	/**
	 * Add hooks.
	 *
	 * @return void
	 */
	protected static function add_hooks() {
		// Add placeholders to comment form fields.
		add_filter( 'comment_form_default_fields', [ __CLASS__, 'add_field_placeholders' ], 20 );
		add_filter( 'comment_form_field_comment', [ __CLASS__, 'add_textarea_placeholder' ], 20 );
	}

	/**
	 * Add placeholders to the Name, Email and Website fields in the comment form.
	 *
	 * @param  array $fields  Comment form fields.
	 * @return array $fields
	 */
	public static function add_field_placeholders( $fields ) {
		$fields['author'] = str_replace(
			'<input',
			'<input placeholder="' . esc_attr_x( 'Name *', 'comment form placeholder', 'aura-prime' ) . '"',
			$fields['author']
		);

		$fields['email'] = str_replace(
			'<input',
			'<input placeholder="' . esc_attr_x( 'Email *', 'comment form placeholder', 'aura-prime' ) . '"',
			$fields['email']
		);

		$fields['url'] = str_replace(
			'<input',
			'<input placeholder="' . esc_attr_x( 'Website (optional)', 'comment form placeholder', 'aura-prime' ) . '"',
			$fields['url']
		);

		return $fields;
	}

	/**
	 * Add placeholder to the Comment field (textarea) in he comment form.
	 *
	 * @param  string $comment_field  Comment form textarea field.
	 * @return string $comment_field
	 */
	public static function add_textarea_placeholder( $comment_field ) {
		$comment_field = str_replace(
			'<textarea',
			'<textarea placeholder="' . esc_attr_x( 'Enter your comment here *', 'comment form placeholder', 'aura-prime' ) . '"',
			$comment_field
		);

		$comment_field = str_replace(
			'rows="8"',
			'rows="6"',
			$comment_field
		);

		return $comment_field;
	}
}
