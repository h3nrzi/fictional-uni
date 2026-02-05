<!-- Include the header template-->
<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
    <!-- Page banner section -->
	<?php page_banner(); ?>

    <div class="container container--narrow page-section">
        <!-- Campus metabox -->
        <div class="metabox metabox--position-up metabox--with-home-link">
            <p>
                <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link( "campus" ); ?>">
                    <i class="fa fa-home" aria-hidden="true"></i>
					<?php echo esc_html__( 'همه پردیس‌ها', 'fictional-uni' ); ?>
                </a>
                <span class="metabox__main">
					<?php the_title(); ?>
				</span>
            </p>
        </div>

        <!-- Campus content -->
        <div class="generic-content">
			<?php the_content(); ?>
        </div>

        <!-- Campus map -->
        <div class="acf-map">
			<?php // $map_location = get_field( "map_location" ); ?>
            <div class="marker" data-lat="<?php // echo $map_location["lat"] ?>" data-lng="<?php // echo $map_location["lng"] ?>">
                <h3>
					<?php // the_title(); ?>
                </h3>
				<?php // echo $map_location["address"] ?>
            </div>
        </div>

        <!-- Related programs -->
		<?php
		$related_programs = new WP_Query( [
			"posts_per_page" => - 1,
			"post_type"      => "program",
			"orderby"        => "title",
			"order"          => "ASC",
			"meta_query"     => [
				[
					"key"     => "related_campus",
					"compare" => "LIKE",
					"value"   => '"' . get_the_ID() . '"',
				],
			],
		] );
		if ( $related_programs->have_posts() ) : ?>
            <hr class="section-break">
            <h2 class="headline headline--medium"><?php echo esc_html__( 'برنامه‌های موجود در این پردیس', 'fictional-uni' ); ?></h2>
            <ul class="min-list link-list">
				<?php while ( $related_programs->have_posts() ) : $related_programs->the_post(); ?>
                    <li>
                        <a href="<?php the_permalink(); ?>">
							<?php the_title(); ?>
                        </a>
                    </li>
				<?php endwhile; ?>
            </ul>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
    </div>
<?php endwhile; ?>

<!-- Include the footer template -->
<?php get_footer(); ?>
