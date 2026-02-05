<!-- Include the header template-->
<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
    <!-- Page banner section -->
	<?php page_banner(); ?>

    <div class="container container--narrow page-section">
        <!-- Event metabox -->
        <div class="metabox metabox--position-up metabox--with-home-link">
            <p>
                <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link( "event" ); ?>">
                    <i class="fa fa-home" aria-hidden="true"></i>
					<?php echo esc_html__( 'همه رویدادها', 'fictional-uni' ); ?>
                </a>
                <span class="metabox__main">
					<?php the_title(); ?>
				</span>
            </p>
        </div>

        <!-- Event description -->
        <div class="generic-content">
			<?php the_content(); ?>
        </div>

        <!-- Related programs -->
		<?php $related_programs = get_field( "related_programs" ); ?>
		<?php if ( $related_programs ) : ?>
            <hr class="section-break">
            <h2 class="headline headline--medium"><?php echo esc_html__( 'برنامه‌های مرتبط', 'fictional-uni' ); ?></h2>
            <ul class="link-list min-list">
				<?php foreach ( $related_programs as $program ) : ?>
                    <li>
                        <a href="<?php echo get_the_permalink( $program ); ?>">
							<?php echo get_the_title( $program ); ?>
                        </a>
                    </li>
				<?php endforeach; ?>
            </ul>
		<?php endif; ?>
    </div>
<?php endwhile; ?>

<!-- Include the footer template -->
<?php get_footer(); ?>
