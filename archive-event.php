<!-- Include the header template -->
<?php get_header(); ?>

<!-- Page banner section -->
<?php page_banner( [
	"title"    => esc_html__( 'همه رویدادها', 'fictional-uni' ),
	"subtitle" => esc_html__( 'ببینید در دنیای ما چه خبر است.', 'fictional-uni' ),
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
		<?php echo esc_html__( 'به دنبال مرور رویدادهای گذشته هستید؟', 'fictional-uni' ); ?>
        <a href="<?php echo site_url( "/past-events" ); ?>">
			<?php echo esc_html__( 'آرشیو رویدادهای گذشته را ببینید.', 'fictional-uni' ); ?>
        </a>
    </p>
</div>

<!-- Include the footer template -->
<?php get_footer(); ?>