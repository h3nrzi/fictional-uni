<?php


/**
 * Register custom REST fields for additional data.
 */
function custom_field(): void {
	// Add author name to the REST API response for posts
	register_rest_field(
		'post',
		'author_name',
		[
			'get_callback' => static function () {
				return get_the_author();
			},
		]
	);

	// Add user note count to the REST API response for notes
	register_rest_field(
		'note',
		'user_note_count',
		[
			'get_callback' => static function () {
				return count_user_posts( get_current_user_id(), 'note' );
			},
		]
	);
}