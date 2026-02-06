<!-- Include the header template-->
<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
	<!-- Page banner section -->
	<?php page_banner(); ?>

	<div class="container container--narrow page-section">
		<?php $the_parent_id = wp_get_post_parent_id( get_the_ID() ); ?>
		<?php if ( $the_parent_id ) : ?>
			<div class="metabox metabox--position-up metabox--with-home-link">
				<p>
					<a class="metabox__blog-home-link" href="<?php echo get_permalink( $the_parent_id ); ?>">
						<i class="fa fa-home" aria-hidden="true"></i>
						<?php echo esc_html__( 'بازگشت به', 'fictional-uni' ); ?> <?php echo get_the_title( $the_parent_id ); ?>
					</a>
					<span class="metabox__main">
						<?php the_title(); ?>
					</span>
				</p>
			</div>
		<?php endif; ?>

		<div class="generic-content">
			<?php get_search_form(); ?>
		</div>
	</div>
<?php endwhile; ?>

<!-- Include the footer template -->
<?php get_footer(); ?>
