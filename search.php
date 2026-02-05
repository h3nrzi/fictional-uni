<!-- Include the header template-->
<?php get_header(); ?>

<!-- Page banner section -->
<?php page_banner( [
	"title"    => esc_html__( 'نتایج جستجو', 'fictional-uni' ),
	"subtitle" => sprintf( esc_html__( 'شما جستجو کردید برای «%s»', 'fictional-uni' ), esc_html( get_search_query( false ) ) ),
] ); ?>

<div class="container container--narrow page-section">
	<?php if ( have_posts() ) : ?>
		<!-- Search results -->
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( "template-parts/content", get_post_type() ); ?>
		<?php endwhile; ?>

		<!-- Pagination -->
		<?php echo paginate_links(); ?>
	<?php else : ?>
		<h2 class="headline headline--small-plus"><?php echo esc_html__( 'هیچ نتیجه‌ای برای این جستجو پیدا نشد.', 'fictional-uni' ); ?></h2>
		<?php get_search_form(); ?>
	<?php endif; ?>
</div>

<!-- Include the footer template -->
<?php get_footer(); ?>
