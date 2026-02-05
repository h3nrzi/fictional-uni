<?php

require get_theme_file_path( 'inc/actions/wp-enqueue-scripts.php' );
require get_theme_file_path( 'inc/actions/after-setup-theme.php' );
require get_theme_file_path( 'inc/actions/pre-get-posts.php' );
require get_theme_file_path( 'inc/actions/rest-api/rest-api-init.php' );
require get_theme_file_path( 'inc/actions/admin-init.php' );
require get_theme_file_path( 'inc/actions/wp-loaded.php' );
require get_theme_file_path( 'inc/actions/login_enqueue_scripts.php' );

//require get_theme_file_path( 'inc/filters/google-maps.php' );
require get_theme_file_path( 'inc/filters/login-headerurl.php' );
require get_theme_file_path( 'inc/filters/login-headertext.php' );
require get_theme_file_path( 'inc/filters/wp-insert-post-data.php' );

require get_theme_file_path( 'inc/page-banner.php' );


