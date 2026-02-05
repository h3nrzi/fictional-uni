<!-- Include the header template-->
<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
    <!-- Page banner section -->
	<?php page_banner(); ?>

    <div class="container container--narrow page-section">
        <!-- Program metabox -->
        <div class="metabox metabox--position-up metabox--with-home-link">
            <p>
                <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link( "program" ); ?>">
                    <i class="fa fa-home" aria-hidden="true"></i>
					<?php echo esc_html__( 'همه برنامه‌ها', 'fictional-uni' ); ?>
                </a>
                <span class="metabox__main">
					<?php the_title(); ?>
				</span>
            </p>
        </div>

        <!-- Program content -->
        <div class="generic-content">
			<?php the_field( "main_body_content" ); ?>
        </div>

        <!-- Related professors -->
		<?php $related_professors = new WP_Query( [
			"posts_per_page" => - 1,
			"post_type"      => "professor",
			"orderby"        => "title",
			"order"          => "ASC",
			"meta_query"     => [
				[
					"key"     => "related_programs",
					"compare" => "LIKE",
					"value"   => '"' . get_the_ID() . '"',
				],
			],
		] );
		if ( $related_professors->have_posts() ) : ?>
            <hr class="section-break">
            <h2 class="headline headline--medium">
				<?php
				printf(
					esc_html__( 'اساتید %s', 'fictional-uni' ),
					esc_html( get_the_title() )
				);
				?>
			</h2>
            <ul class="professor-cards">
				<?php while ( $related_professors->have_posts() ) : $related_professors->the_post(); ?>
					<?php get_template_part( "template-parts/content", "professor" ); ?>
				<?php endwhile; ?>
            </ul>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>

        <!-- Related events -->
		<?php
		$today          = date( "Ymd" );
		$related_events = new WP_Query( [
			"posts_per_page" => 2,
			"post_type"      => "event",
			"meta_key"       => "event_date",
			"orderby"        => "meta_value_num",
			"order"          => "ASC",
			"meta_query"     => [
				[
					"key"     => "event_date",
					"compare" => ">=",
					"value"   => $today,
					"type"    => "numeric",
				],
				[
					"key"     => "related_programs",
					"compare" => "LIKE",
					"value"   => '"' . get_the_ID() . '"',
				],
			],
		] );
		if ( $related_events->have_posts() ) : ?>
            <hr class="section-break">
            <h2 class="headline headline--medium">
				<?php
				printf(
					esc_html__( 'رویدادهای پیش‌روی %s', 'fictional-uni' ),
					esc_html( get_the_title() )
				);
				?>
            </h2>
			<?php while ( $related_events->have_posts() ) : $related_events->the_post(); ?>
				<?php get_template_part( "template-parts/content", "event" ); ?>
			<?php endwhile; ?>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>

        <!-- Related campuses -->
		<?php $related_campuses = get_field( "related_campus" );
		if ( $related_campuses ) : ?>
            <hr class="section-break">
            <h2 class="headline headline--medium">
				<?php
				printf(
					esc_html__( '%s در این پردیس‌ها ارائه می‌شود:', 'fictional-uni' ),
					esc_html( get_the_title() )
				);
				?>
            </h2>
            <ul class="link-list min-list">
				<?php foreach ( $related_campuses as $campus ) : ?>
                    <li>
                        <a href="<?php echo get_the_permalink( $campus ); ?>">
							<?php echo get_the_title( $campus ); ?>
                        </a>
                    </li>
				<?php endforeach; ?>
            </ul>
		<?php endif; ?>
    </div>
<?php endwhile; ?>

<!-- Include the footer template -->
<?php get_footer(); ?>
