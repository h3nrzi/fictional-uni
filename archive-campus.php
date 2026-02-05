<!-- Include the header template -->
<?php get_header(); ?>

<!-- Page banner section -->
<?php page_banner( [
	"title"    => esc_html__( 'پردیس‌های ما', 'fictional-uni' ),
	"subtitle" => esc_html__( 'چندین پردیس در مکان‌های مناسب داریم.', 'fictional-uni' ),
] ); ?>

<div class="container container--narrow page-section">
    <!-- List of campus links -->
    <ul class="link-list min-list">
		<?php while ( have_posts() ) : the_post(); ?>
            <li>
                <a href="<?php the_permalink(); ?>">
					<?php the_title(); ?>
                </a>
            </li>
		<?php endwhile; ?>
    </ul>
    
    <!-- Map section -->
    <div class="acf-map">
		<?php // while ( have_posts() ) : the_post(); ?>
		<?php // $map_location = get_field( "map_location" ); ?>
        <div class="marker" data-lat="<?php // echo $map_location["lat"]; ?>" data-lng="<?php // echo $map_location["lng"]; ?>">
            <h3>
                <a href="<?php // the_permalink(); ?>">
					<?php // the_title(); ?>
                </a>
            </h3>
            <p><?php // echo $map_location["address"]; ?></p>
        </div>
		<?php // endwhile; ?>
    </div>
</div>

<!-- Include the footer template -->
<?php get_footer(); ?>