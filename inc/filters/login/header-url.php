<?php

function our_header_url() {
	return esc_url( site_url( "/" ) );
}

add_filter( "login_headerurl", "our_header_url" );