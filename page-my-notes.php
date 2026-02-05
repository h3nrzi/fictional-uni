<?php
if ( ! is_user_logged_in() ) {
	wp_redirect( esc_url( site_url( "/" ) ) );
	exit;
} ?>

<!-- Include the header template-->
<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
    <!-- Page banner section -->
	<?php page_banner(); ?>

    <div class="container container--narrow page-section">
        <div class="create-note">
            <h2 class="headline headline--medium"><?php echo esc_html__( 'یادداشت جدید بسازید', 'fictional-uni' ); ?></h2>
            <input class="new-note-title" type="text" placeholder="<?php echo esc_attr__( 'عنوان', 'fictional-uni' ); ?>">
            <textarea class="new-note-body" name="" placeholder="<?php echo esc_attr__( 'یادداشت شما', 'fictional-uni' ); ?>"></textarea>
            <span class="submit-note"><?php echo esc_html__( 'ایجاد یادداشت', 'fictional-uni' ); ?></span>
        </div>

        <ul class="min-list link-list" id="my-notes">
			<?php
			$user_notes = new WP_Query( [
				"post_type"      => "note",
				"posts_per_page" => - 1,
				"author"         => get_current_user_id(),
			] );
			while ( $user_notes->have_posts() ) : $user_notes->the_post(); ?>
                <li data-id="<?php the_ID(); ?>">
                    <input class="note-title-field" value="<?php echo str_replace( __( 'خصوصی: ', 'fictional-uni' ), "", esc_attr( get_the_title() ) ); ?>" type="text" readonly>
                    <span class="edit-note">
                        <i class="fa fa-pencil" aria-hidden="true"></i> <?php echo esc_html__( 'ویرایش', 'fictional-uni' ); ?>
                    </span>
                    <span class="delete-note">
                        <i class="fa fa-trash-o" aria-hidden="true"></i> <?php echo esc_html__( 'حذف', 'fictional-uni' ); ?>
                    </span>
                    <textarea class="note-body-field" readonly>
                        <?php echo esc_attr( wp_strip_all_tags( get_the_content() ) ); ?>
                    </textarea>
                    <span class="update-note btn btn--blue btn--small">
                        <i class="fa fa-arrow-right" aria-hidden="true"></i> <?php echo esc_html__( 'ذخیره', 'fictional-uni' ); ?>
                    </span>
                </li>
			<?php endwhile; ?>
        </ul>
    </div>
<?php endwhile; ?>

<!-- Include the footer template -->
<?php get_footer(); ?>
