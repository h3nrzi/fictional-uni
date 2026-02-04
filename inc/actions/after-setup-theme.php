<?php

function university_features(): void {
	// Menu locations
	// register_nav_menu( "header_menu_location", "Header Menu Location" );
	// register_nav_menu( "footer_location_one", "Footer Location One" );
	// register_nav_menu( "footer_location_two", "Footer Location Two" );


	// Title of each page
	add_theme_support( "title-tag" );

	// Thumbnails
	add_theme_support( "post-thumbnails" );
	add_image_size( "professor-landscape", 400, 260, true );
	add_image_size( "professor-portrait", 480, 650, true );
	add_image_size( "page-banner", 1500, 350, true );
}

add_action( "after_setup_theme", "university_features" );