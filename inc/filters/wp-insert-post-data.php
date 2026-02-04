<?php

function make_note_private( $data, $postarr ): array {
	if ( $data["post_type"] === "note" ) {
		if ( count_user_posts( get_current_user_id(), "note" ) >= 4 and ! $postarr["ID"] ) {
			die( "You have reached your note limit" );
		}

		$data["post_title"]   = sanitize_text_field( $data["post_title"] );
		$data["post_content"] = sanitize_textarea_field( $data["post_content"] );


		if ( $data["post_status"] != "trash" ) {
			$data["post_status"] = "private";
		}
	}

	return $data;
}

add_filter( "wp_insert_post_data", "make_note_private", 10, 2 );

