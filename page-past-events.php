<!-- Include the header template-->
<?php get_header(); ?>

<!-- Page banner section -->
<?php page_banner( [
	"title"    => esc_html__( 'رویدادهای گذشته', 'fictional-uni' ),
	"subtitle" => esc_html__( 'مروری بر رویدادهای گذشته ما', 'fictional-uni' ),
] ); ?>

<div class="container container--narrow page-section">
    <!-- Past events list -->
	<?php
	$today       = date( "Ymd" );
	$past_events = new WP_Query( [
		"paged"      => get_query_var( "paged", 1 ),
		"post_type"  => "event",
		"meta_key"   => "event_date",
		"orderby"    => "meta_value_num",
		"order"      => "ASC",
		"meta_query" => [
			[
				"key"     => "event_date",
				"compare" => "<",
				"value"   => $today,
				"type"    => "numeric",
			],
		],
	] );
	while ( $past_events->have_posts() ) : $past_events->the_post();
		get_template_part( "template-parts/content", "event" );
	endwhile; ?>

    <!-- Pagination -->
	<?php echo paginate_links( [ "total" => $past_events->max_num_pages ] ); ?>
</div>

<!-- Include the footer template -->
<?php get_footer(); ?>
