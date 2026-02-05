<?php

require_once __DIR__ . '/custom-fields.php';
require_once __DIR__ . '/like.php';
require_once __DIR__ . '/search.php';

add_action( 'rest_api_init', 'custom_field' );
add_action( 'rest_api_init', 'search_route' );
add_action( 'rest_api_init', "like_routes" );
