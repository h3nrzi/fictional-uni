<?php

function university_map_key( $api ) {
	$api["key"] = "AIzaSyBh9b1rNCp6k015JeMHiRP4klDymBeoEWk";

	return $api;
}


add_filter( "acf/fields/google_map/api", "university_map_key" );