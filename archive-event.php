<!-- Include the header template -->
<?php get_header(); ?>

<!-- Page banner section -->
<?php page_banner( [
	"title"    => "All Events",
	"subtitle" => "See what is going on in our world.",
] ); ?>

<div class="container container--narrow page-section">
    <!-- Events list -->
	<?php while ( have_posts() ) : the_post(); ?>
		<?php get_template_part( "template-parts/content", "event" ); ?>
	<?php endwhile; ?>

    <!-- Pagination -->
	<?php echo paginate_links(); ?>

    <hr class="section-break">

    <!-- Past events link -->
    <p>
        Looking for a recap of past events?
        <a href="<?php echo site_url( "/past-events" ); ?>">
            Check out our past events archive.
        </a>
    </p>
</div>

<!-- Include the footer template -->
<?php get_footer(); ?>