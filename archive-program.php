<!-- Include the header template-->
<?php get_header(); ?>

<!-- Page banner section -->
<?php page_banner( [
	"title"    => "All Programs",
	"subtitle" => "There is something for everyone. Have a look around.",
] ); ?>

<div class="container container--narrow page-section">
    <!-- Posts list -->
    <ul class="link-list min-list">
		<?php while ( have_posts() ) : the_post() ?>
            <li>
                <a href="<?php the_permalink(); ?>">
					<?php the_title(); ?>
                </a>
            </li>
		<?php endwhile; ?>
    </ul>

    <!-- Pagination -->
	<?php echo paginate_links(); ?>
</div>

<!-- Include the footer template -->
<?php get_footer(); ?>
