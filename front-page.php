<!-- Include the header template-->
<?php get_header(); ?>

<!-- Page banner section -->
<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri( '/images/library-hero.jpg' ) ?>);"></div>
    <div class="page-banner__content container t-center c-white">
        <h1 class="headline headline--large">
			<?php echo esc_html__( 'خوش آمدید!', 'fictional-uni' ); ?>
        </h1>
        <h2 class="headline headline--medium">
			<?php echo esc_html__( 'فکر می‌کنیم اینجا را دوست خواهید داشت.', 'fictional-uni' ); ?>
        </h2>
        <h3 class="headline headline--small">
			<?php echo esc_html__( 'چرا رشته‌ای را که به آن علاقه دارید بررسی نمی‌کنید؟', 'fictional-uni' ); ?>
        </h3>
        <a href="<?php echo get_post_type_archive_link( "program" ) ?>" class="btn btn--large btn--blue">
			<?php echo esc_html__( 'رشته مورد علاقه‌تان را پیدا کنید', 'fictional-uni' ); ?>
        </a>
    </div>
</div>

<div class="full-width-split group">
    <!-- Upcoming events -->
    <div class="full-width-split__one">
        <div class="full-width-split__inner">
            <h2 class="headline headline--small-plus t-center">
				<?php echo esc_html__( 'رویدادهای پیش رو', 'fictional-uni' ); ?>
            </h2>

			<?php $today      = date( "Ymd" );
			$home_page_events = new WP_Query( [
				"posts_per_page" => 2,
				"post_type"      => "event",
				"meta_key"       => "event_date",
				"orderby"        => "meta_value_num",
				"order"          => "ASC",
				"meta_query"     => [
					[
						"key"     => "event_date",
						"compare" => ">=",
						"value"   => $today,
						"type"    => "numeric",
					],
				],
			] ); ?>

            <!-- Posts list -->
			<?php while ( $home_page_events->have_posts() ) : $home_page_events->the_post() ?>
				<?php get_template_part( "template-parts/content", "event" ); ?>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>

            <p class="t-center no-margin">
                <a href="<?php echo get_post_type_archive_link( "event" ) ?>" class="btn btn--blue">
					<?php echo esc_html__( 'مشاهده همه رویدادها', 'fictional-uni' ); ?>
                </a>
            </p>
        </div>
    </div>

    <!-- Blog posts -->
    <div class="full-width-split__two">
        <div class="full-width-split__inner">
            <h2 class="headline headline--small-plus t-center">
				<?php echo esc_html__( 'از وبلاگ‌های ما', 'fictional-uni' ); ?>
            </h2>

			<?php $home_page_post = new WP_Query( [ "posts_per_page" => 2 ] ); ?>

            <!-- Posts list -->
			<?php while ( $home_page_post->have_posts() ) : $home_page_post->the_post() ?>
                <div class="event-summary">
                    <a class="event-summary__date event-summary__date--beige t-center" href="<?php the_permalink(); ?>">
                        <span class="event-summary__month">
                            <?php the_time( "M" ) ?>
                        </span>
                        <span class="event-summary__day">
                            <?php the_time( "d" ) ?>
                        </span>
                    </a>
                    <div class="event-summary__content">
                        <h5 class="event-summary__title headline headline--tiny">
                            <a href="<?php the_permalink(); ?>">
								<?php the_title(); ?>
                            </a>
                        </h5>
                        <p>
							<?php if ( has_excerpt() ) {
								echo get_the_excerpt();
							} else {
								echo wp_trim_words( get_the_content(), 18 );
							} ?>
                            <a href="<?php the_permalink(); ?>" class="nu gray">
								<?php echo esc_html__( 'بیشتر بخوانید', 'fictional-uni' ); ?>
                            </a>
                        </p>
                    </div>
                </div>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>

            <p class="t-center no-margin">
                <a href="<?php echo site_url( "/blog" ); ?>" class="btn btn--yellow">
					<?php echo esc_html__( 'مشاهده همه نوشته‌های وبلاگ', 'fictional-uni' ); ?>
                </a>
            </p>
        </div>
    </div>
</div>

<!-- Slider -->
<div class="hero-slider">
    <div data-glide-el="track" class="glide__track">
        <div class="glide__slides">
            <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri( '/images/bus.jpg' ) ?>);">
                <div class="hero-slider__interior container">
                    <div class="hero-slider__overlay">
                        <h2 class="headline headline--medium t-center"><?php echo esc_html__( 'حمل‌ونقل رایگان', 'fictional-uni' ); ?></h2>
                        <p class="t-center"><?php echo esc_html__( 'همه دانشجویان بلیت نامحدود اتوبوس رایگان دارند.', 'fictional-uni' ); ?></p>
                        <p class="t-center no-margin"><a href="#" class="btn btn--blue"><?php echo esc_html__( 'بیشتر بدانید', 'fictional-uni' ); ?></a></p>
                    </div>
                </div>
            </div>
            <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri( '/images/apples.jpg' ) ?>);">
                <div class="hero-slider__interior container">
                    <div class="hero-slider__overlay">
                        <h2 class="headline headline--medium t-center"><?php echo esc_html__( 'یک سیب در روز', 'fictional-uni' ); ?></h2>
                        <p class="t-center"><?php echo esc_html__( 'برنامه دندان‌پزشکی ما خوردن سیب را توصیه می‌کند.', 'fictional-uni' ); ?></p>
                        <p class="t-center no-margin"><a href="#" class="btn btn--blue"><?php echo esc_html__( 'بیشتر بدانید', 'fictional-uni' ); ?></a></p>
                    </div>
                </div>
            </div>
            <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri( '/images/bread.jpg' ) ?>);">
                <div class="hero-slider__interior container">
                    <div class="hero-slider__overlay">
                        <h2 class="headline headline--medium t-center"><?php echo esc_html__( 'غذای رایگان', 'fictional-uni' ); ?></h2>
                        <p class="t-center"><?php echo esc_html__( 'دانشگاه خیالی برای افراد نیازمند برنامه‌های ناهار ارائه می‌دهد.', 'fictional-uni' ); ?></p>
                        <p class="t-center no-margin"><a href="#" class="btn btn--blue"><?php echo esc_html__( 'بیشتر بدانید', 'fictional-uni' ); ?></a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="slider__bullets glide__bullets" data-glide-el="controls[nav]"></div>
    </div>
</div>

<!-- Include the footer template -->
<?php get_footer(); ?>
