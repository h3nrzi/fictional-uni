<?php

function redirect_subs_to_frontend(): void {
	$our_current_user = wp_get_current_user();

	if (
		count( $our_current_user->roles ) === 1 and
		$our_current_user->roles[0] === "subscriber"
	) {
		wp_redirect( site_url( "/" ) );
		exit;
	}
}


add_action( "admin_init", "redirect_subs_to_frontend" );