<?php

function no_subs_admin_bar(): void {
	$our_current_user = wp_get_current_user();

	if (
		count( $our_current_user->roles ) === 1 and
		$our_current_user->roles[0] === "subscriber"
	) {
		show_admin_bar( false );
	}
}

add_action( "wp_loaded", "no_subs_admin_bar" );