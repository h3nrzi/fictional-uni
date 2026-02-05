<!-- Include the header template-->
<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
    <!-- Page banner section -->
	<?php page_banner(); ?>

    <div class="container container--narrow page-section">
        <!-- Professor details -->
        <div class="generic-content">
            <div class="row group">
                <div class="one-third">
					<?php the_post_thumbnail( "professor_portrait" ); ?>
                </div>
                <div class="two-thirds">
					<?php
					$liked_count   = new WP_Query( [
						"post_type"  => "like",
						"meta_query" => [
							[
								"key"     => "liked_professor_id",
								"compare" => "=",
								"value"   => get_the_ID(),
							],
						],
					] );
					$exists_status = "no";
					if ( is_user_logged_in() ) {
						$exists_query = new WP_Query( [
							"author"     => get_current_user_id(),
							"post_type"  => "like",
							"meta_query" => [
								[
									"key"     => "liked_professor_id",
									"compare" => "=",
									"value"   => get_the_ID(),
								],
							],
						] );
						$exists_query->have_posts()
							? $exists_status = "yes"
							: $exists_status = "no";
					}
					?>
                    <span class="like-box"
                          data-like="<?php if ( isset( $exists_query->posts[0]->ID ) ) {
						      echo $exists_query->posts[0]->ID;
					      } ?>"
                          data-exists="<?php echo $exists_status ?>"
                          data-professorid="<?php the_ID(); ?>">
                        <i class="fa fa-heart-o" aria-hidden="true"></i>
                        <i class="fa fa-heart" aria-hidden="true"></i>
                        <span class="like-count"><?php echo $liked_count->found_posts; ?></span>
                    </span>
					<?php the_content(); ?>
                </div>
            </div>
        </div>
		<?php wp_reset_postdata(); ?>

        <!-- Related programs -->
		<?php $related_programs = get_field( "related_programs" ); ?>
		<?php if ( $related_programs ) : ?>
            <hr class="section-break">
            <h2 class="headline headline--medium">Subjects Taught</h2>
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
