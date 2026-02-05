<?php

function our_login_title() {
	return get_bloginfo( "name" );
}

add_filter( "login_headertext", "our_login_title" );