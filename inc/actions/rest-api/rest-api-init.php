<?php

require_once __DIR__ . '/rest-api-search.php';
require_once __DIR__ . '/rest-api-like.php';
require_once __DIR__ . '/rest-api-custom-fields.php';

add_action( 'rest_api_init', 'custom_field' );
add_action( 'rest_api_init', 'search_route' );
add_action( 'rest_api_init', "like_routes" );