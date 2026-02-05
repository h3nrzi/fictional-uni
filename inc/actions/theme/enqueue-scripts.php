<?php

function university_files(): void {
	// Javascript
	wp_enqueue_script( 'main-university-js', get_theme_file_uri( '/build/index.js' ), [ "jquery" ], '1.0', true );

	// Localize script with site URL
	wp_localize_script( "main-university-js", "university_data", [
		"root_url" => get_site_url(),
		"nonce"    => wp_create_nonce( "wp_rest" ),
	] );

	// Google Map script
	//wp_enqueue_script( 'google_map', "//maps.googleapis.com/map/api/js?key=123456789", null, '1.0', true );

	// Fonts
	wp_enqueue_style( 'custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i' );

	if ( is_rtl() ) {
		wp_enqueue_style( 'custom-rtl-fonts', 'https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;700&display=swap', [], null );
	}

	// Icons
	wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );

	// Styles
	wp_enqueue_style( 'university-main-styles', get_theme_file_uri( '/build/style-index.css' ) );
	wp_enqueue_style( 'university-extra-styles', get_theme_file_uri( '/build/index.css' ) );

	if ( is_rtl() ) {
		wp_enqueue_style( 'university-rtl-styles', get_theme_file_uri( '/rtl.css' ) );
	}
}

add_action( 'wp_enqueue_scripts', 'university_files' );
