<?php

// Theme actions.
require get_theme_file_path( 'inc/actions/theme/after-setup-theme.php' );
require get_theme_file_path( 'inc/actions/theme/enqueue-scripts.php' );
require get_theme_file_path( 'inc/actions/theme/pre-get-posts.php' );

// Admin and auth actions.
require get_theme_file_path( 'inc/actions/admin/disable-admin-bar.php' );
require get_theme_file_path( 'inc/actions/admin/redirect-subscribers.php' );
require get_theme_file_path( 'inc/actions/auth/login-enqueue-scripts.php' );

// REST API.
require get_theme_file_path( 'inc/actions/rest-api/init.php' );

// Filters.
//require get_theme_file_path( 'inc/filters/google-maps.php' );
require get_theme_file_path( 'inc/filters/login/header-text.php' );
require get_theme_file_path( 'inc/filters/login/header-url.php' );
require get_theme_file_path( 'inc/filters/posts/insert-post-data.php' );

// Template tags.
require get_theme_file_path( 'inc/template-tags/page-banner.php' );

