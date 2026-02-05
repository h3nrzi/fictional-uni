<?php

/**
 * Helper function to get the event description.
 *
 * This function returns the excerpt of the event if available,
 * otherwise, it trims the event content to 12 words.
 *
 * @return string The event description.
 */
function university_get_event_description(): string {
	return has_excerpt()
		? get_the_excerpt()
		: wp_trim_words( get_the_content(), 12 );
}

/**
 * Callback function for the custom REST API endpoint.
 *
 * This function handles search requests and returns results
 * categorized by post type, including general information, professors,
 * events, programs, and campuses.
 *
 * @param WP_REST_Request $request The REST API request object.
 *
 * @return array The search results categorized by post type.
 * @throws DateMalformedStringException
 */
function search_controller( WP_REST_Request $request ): array {
	// Sanitize the search term from the request
	$term = sanitize_text_field( (string) $request->get_param( 'term' ) );

	// Initialize the main query to search across multiple post types
	$main_query = new WP_Query( [
		'post_type'      => [ 'page', 'post', 'professor', 'program', 'campus', 'event' ],
		's'              => $term,
		'posts_per_page' => 50,
	] );

	// Initialize the results array
	$results = [
		'general_info' => [],
		'professors'   => [],
		'events'       => [],
		'programs'     => [],
		'campuses'     => [],
	];

	// Loop through the main query results
	while ( $main_query->have_posts() ) {
		$main_query->the_post();

		$type      = get_post_type();
		$title     = get_the_title();
		$permalink = get_the_permalink();

		// Categorize results based on post type
		if ( in_array( $type, [ 'post', 'page' ], true ) ) {
			$results['general_info'][] = [
				'title'       => $title,
				'permalink'   => $permalink,
				'post_type'   => $type,
				'author_name' => get_the_author(),
			];
			continue;
		}

		if ( $type === 'professor' ) {
			$results['professors'][] = [
				'title'     => $title,
				'permalink' => $permalink,
				'image'     => get_the_post_thumbnail_url( 0, 'professor-landscape' ),
			];
			continue;
		}

		if ( $type === 'program' ) {
			$results['programs'][] = [
				'id'        => get_the_ID(),
				'title'     => $title,
				'permalink' => $permalink,
			];

			// Fetch related campuses for the program
			$related_campuses = get_field( 'related_campus' );
			if ( $related_campuses ) {
				foreach ( $related_campuses as $campus ) {
					$results['campuses'][] = [
						'title'     => get_the_title( $campus ),
						'permalink' => get_the_permalink( $campus ),
					];
				}
			}

			continue;
		}

		if ( $type === 'campus' ) {
			$results['campuses'][] = [
				'title'     => $title,
				'permalink' => $permalink,
			];
			continue;
		}

		if ( $type === 'event' ) {
			$event_date_raw = get_field( 'event_date' );
			$event_date     = $event_date_raw ? new DateTime( $event_date_raw ) : null;

			$results['events'][] = [
				'title'       => $title,
				'permalink'   => $permalink,
				'month'       => $event_date ? $event_date->format( 'M' ) : '',
				'day'         => $event_date ? $event_date->format( 'd' ) : '',
				'description' => university_get_event_description(),
			];
		}
	}

	// Reset post data after the main query
	wp_reset_postdata();

	// If programs exist, fetch related professors and events
	if ( $results['programs'] ) {
		$programs_meta_query = [ 'relation' => 'OR' ];
		foreach ( $results['programs'] as $item ) {
			$programs_meta_query[][] = [
				'key'     => 'related_programs',
				'compare' => 'LIKE',
				'value'   => '"' . $item['id'] . '"',
			];
		}

		// Additional query to fetch professors and events related to programs
		$program_relationship_query = new WP_Query( [
			'post_type'  => [ 'professor', 'event' ],
			'meta_query' => $programs_meta_query,
		] );

		// Add related professors and events to the results
		while ( $program_relationship_query->have_posts() ) {
			$program_relationship_query->the_post();

			$type      = get_post_type();
			$title     = get_the_title();
			$permalink = get_the_permalink();

			if ( $type === 'professor' ) {
				$results['professors'][] = [
					'title'     => $title,
					'permalink' => $permalink,
					'image'     => get_the_post_thumbnail_url( 0, 'professor-landscape' ),
				];
				continue;
			}

			if ( $type === 'event' ) {
				$event_date_raw = get_field( 'event_date' );
				$event_date     = $event_date_raw ? new DateTime( $event_date_raw ) : null;

				$results['events'][] = [
					'title'       => $title,
					'permalink'   => $permalink,
					'month'       => $event_date ? $event_date->format( 'M' ) : '',
					'day'         => $event_date ? $event_date->format( 'd' ) : '',
					'description' => university_get_event_description(),
				];
			}
		}

		// Remove duplicate professors and events from the results
		$results['professors'] = array_values( array_unique( $results['professors'], SORT_REGULAR ) );
		$results['events']     = array_values( array_unique( $results['events'], SORT_REGULAR ) );
	}

	return $results;
}

/**
 * Register the custom REST API endpoint for search.
 */
function search_route(): void {
	register_rest_route(
		'api/v1',
		'search',
		[
			'methods'             => WP_REST_Server::READABLE,
			'callback'            => 'search_controller',
			'permission_callback' => '__return_true',
			'args'                => [
				'term' => [
					'type'              => 'string',
					'required'          => true,
					'sanitize_callback' => 'sanitize_text_field',
				],
			],
		]
	);
}