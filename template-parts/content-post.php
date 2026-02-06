<div class="post-item">
    <h2 class="headline headline--medium headline--post-title">
        <a href="<?php the_permalink(); ?>">
			<?php the_title(); ?>
        </a>
    </h2>
    <div class="metabox">
        <p>
			<?php
			printf(
				wp_kses_post( __( 'نوشته شده توسط %1$s در %2$s در %3$s', 'fictional-uni' ) ),
				get_the_author_posts_link(),
				esc_html( get_the_time( "Y/m/d" ) ),
				get_the_category_list( ", " )
			);
			?>
        </p>
    </div>
    <div class="generic-content">
		<?php the_excerpt(); ?>
        <p>
            <a class="btn btn--blue" href="<?php the_permalink(); ?>">
				<?php echo esc_html__( 'ادامه مطلب', 'fictional-uni' ); ?> &raquo;
            </a>
        </p>
    </div>
</div>
