<?php

function create_like_controller( $data ) {
	if ( ! is_user_logged_in() ) {
		die( "Only logged in users can create a like." );
	}

	$professor_id = sanitize_text_field( $data["professor_id"] );

	if ( get_post_type( $professor_id ) !== "professor" ) {
		die( "Invalid professor ID" );
	}

	$user_like_query = new WP_Query( [
		'author'         => get_current_user_id(),
		'post_type'      => 'like',
		'posts_per_page' => 1,
		'meta_query'     => [
			[
				'key'     => 'liked_professor_id',
				'value'   => $professor_id,
				'compare' => '=',
			],
		],
	] );

	if ( $user_like_query->found_posts > 0 ) {
		die( "You already liked this professor" );
	}

	return wp_insert_post( [
		"post_type"   => "like",
		"post_status" => "publish",
		"post_title"  => "2nd PHP Test",
		"meta_input"  => [
			"liked_professor_id" => $professor_id,
		],
	] );
}

function delete_like_controller(): string {
	return "Thanks for trying to delete a like";
}

function like_routes(): void {
	register_rest_route(
		'api/v1',
		'manage-like',
		[
			'methods'             => WP_REST_Server::CREATABLE,
			'callback'            => 'create_like_controller',
			'permission_callback' => '__return_true',
		]
	);

	register_rest_route(
		'api/v1',
		'manage-like',
		[
			'methods'             => WP_REST_Server::DELETABLE,
			'callback'            => 'delete_like_controller',
			'permission_callback' => '__return_true',
		]
	);
}