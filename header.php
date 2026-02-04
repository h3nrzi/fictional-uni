<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( "charset" ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<!-- Site header -->
<header class="site-header">
    <div class="container">
        <!-- Logo -->
        <h1 class="school-logo-text float-left">
            <a href="<?php echo site_url( "/" ); ?>">
                <strong>Fictional</strong> University
            </a>
        </h1>

        <!-- Search + mobile menu triggers -->
        <a href="<?php echo esc_url( site_url( "/search" ) ); ?>" class="js-search-trigger site-header__search-trigger">
            <i class="fa fa-search" aria-hidden="true"></i>
        </a>
        <i class="site-header__menu-trigger fa fa-bars" aria-hidden="true"></i>

        <!-- Header menu -->
        <div class="site-header__menu group">
            <!-- Navigation menu -->
            <nav class="main-navigation">
                <ul>
                    <li<?php if ( is_page( "about-us" ) or wp_get_post_parent_id( 0 ) == 13 ) : ?> class="current-menu-item"<?php endif; ?>>
                        <a href="<?php echo site_url( "/about-us" ); ?>">About Us</a>
                    </li>
                    <li<?php if ( get_post_type() == "program" ) : ?> class="current-menu-item"<?php endif; ?>>
                        <a href="<?php echo get_post_type_archive_link( "program" ); ?>">Programs</a>
                    </li>
                    <li<?php if ( get_post_type() == "event" or is_page( "past-events" ) ) : ?> class="current-menu-item"<?php endif; ?>>
                        <a href="<?php echo get_post_type_archive_link( "event" ); ?>">Events</a>
                    </li>
                    <li<?php if ( get_post_type() == "campus" ) : ?> class="current-menu-item"<?php endif; ?>>
                        <a href="<?php echo get_post_type_archive_link( "campus" ); ?>">Campuses</a>
                    </li>
                    <li<?php if ( get_post_type() == "post" ) : ?> class="current-menu-item"<?php endif; ?>>
                        <a href="<?php echo site_url( "/blog" ); ?>">Blog</a>
                    </li>
                </ul>
            </nav>

            <!-- Auth buttons -->
            <div class="site-header__util">
				<?php if ( is_user_logged_in() ) : ?>
                    <a href="<?php echo esc_url( site_url( '/my-notes' ) ); ?>" class="btn btn--small btn--orange float-left push-right">My Notes</a>
                    <a href="<?php echo esc_url( wp_logout_url() ); ?>" class="btn btn--small btn--dark-orange float-left btn--with-photo">
                        <span class="site-header__avatar"><?php echo get_avatar( get_current_user_id(), 30 ); ?></span>
                        <span>Log Out</span>
                    </a>
				<?php else : ?>
                    <a href="<?php echo esc_url( wp_login_url() ); ?>" class="btn btn--small btn--orange float-left push-right">Login</a>
                    <a href="<?php echo esc_url( wp_registration_url() ); ?>" class="btn btn--small btn--dark-orange float-left">Sign Up</a>
				<?php endif; ?>
                <a href="<?php echo esc_url( site_url( "/search" ) ); ?>" class="search-trigger js-search-trigger">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>
</header>
