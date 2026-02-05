<?php function page_banner( $args = null ): void { ?>

	<?php
	if ( ! isset( $args["title"] ) ) {
		$args["title"] = get_the_title();
	}

	if ( ! isset( $args["subtitle"] ) ) {
		$args["subtitle"] = get_field( "page_banner_subtitle" );
	}

	if ( ! isset( $args["photo"] ) ) {
		$page_banner = get_field( "page_banner_background_image" );

		$args["photo"] = ( $page_banner and ! is_archive() and ! is_home() )
			? $page_banner["sizes"]["page-banner"]
			: get_theme_file_uri( "/images/ocean.jpg" );
	} ?>

    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php echo $args["photo"] ?>);"></div>
        <div class="page-banner__content container container--narrow">
            <h1 class="page-banner__title">
				<?php echo $args["title"] ?>
            </h1>
            <div class="page-banner__intro">
                <p>
					<?php echo $args["subtitle"] ?>
                </p>
            </div>
        </div>
    </div>

<?php } ?>
