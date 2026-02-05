<!-- Include the header template-->
<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
	<!-- Page banner section -->
	<?php page_banner(); ?>

	<div class="container container--narrow page-section">
		<!-- Post metabox -->
		<div class="metabox metabox--position-up metabox--with-home-link">
			<p>
				<a class="metabox__blog-home-link" href="<?php echo site_url( "/blog" ); ?>">
					<i class="fa fa-home" aria-hidden="true"></i>
					<?php echo esc_html__( 'خانه وبلاگ', 'fictional-uni' ); ?>
				</a>
				<span class="metabox__main">
					<?php
					printf(
						wp_kses_post( __( 'نوشته شده توسط %1$s در %2$s در %3$s', 'fictional-uni' ) ),
						get_the_author_posts_link(),
						esc_html( get_the_time( "n/j/y" ) ),
						get_the_category_list( ", " )
					);
					?>
				</span>
			</p>
		</div>

		<!-- Post content -->
		<div class="generic-content">
			<?php the_content(); ?>
		</div>
	</div>
<?php endwhile; ?>

<!-- Include the footer template -->
<?php get_footer(); ?>
