<?php

function university_adjust_queries( $query ): void {
	if ( ! is_admin() and is_post_type_archive( 'program' ) and $query->is_main_query() ) {
		$query->set( 'orderby', 'title' );
		$query->set( 'order', 'ASC' );
		$query->set( 'posts_per_page', - 1 );
	}

	if ( ! is_admin() and is_post_type_archive( 'event' ) and $query->is_main_query() ) {
		$today = date( 'Ymd' );
		$query->set( 'meta_key', 'event_date' );
		$query->set( 'orderby', 'meta_value_num' );
		$query->set( 'order', 'ASC' );
		$query->set( 'meta_query', array(
			array(
				'key'     => 'event_date',
				'compare' => '>=',
				'value'   => $today,
				'type'    => 'numeric',
			),
		) );
	}

	if ( ! is_admin() and is_post_type_archive( 'campus' ) and $query->is_main_query() ) {
		$query->set( 'posts_per_page', - 1 );
	}
}

add_action( 'pre_get_posts', 'university_adjust_queries' );