<footer class="site-footer">
    <div class="site-footer__inner container container--narrow">
        <div class="group">
            <!-- COLUMN 1 -->
            <div class="site-footer__col-one">
                <h1 class="school-logo-text school-logo-text--alt-color">
                    <a href="<?php echo site_url( "/" ); ?>">
						<?php printf(
							'<strong>%s</strong> %s',
							esc_html__( 'خیالی', 'fictional-uni' ),
							esc_html__( 'دانشگاه', 'fictional-uni' )
						); ?>
                    </a>
                </h1>
                <p>
                    <a class="site-footer__link" href="#">555.555.5555</a>
                </p>
            </div>

            <!-- COLUMN 2 & 3 -->
            <div class="site-footer__col-two-three-group">
                <div class="site-footer__col-two">
                    <h3 class="headline headline--small"><?php echo esc_html__( 'کاوش', 'fictional-uni' ); ?></h3>
                    <nav class="nav-list">
                        <ul>
                            <li><a href="<?php echo site_url( "/about-us" ); ?>"><?php echo esc_html__( 'درباره ما', 'fictional-uni' ); ?></a></li>
                            <li><a href="#"><?php echo esc_html__( 'برنامه‌ها', 'fictional-uni' ); ?></a></li>
                            <li><a href="#"><?php echo esc_html__( 'رویدادها', 'fictional-uni' ); ?></a></li>
                            <li><a href="#"><?php echo esc_html__( 'پردیس‌ها', 'fictional-uni' ); ?></a></li>
                        </ul>
                    </nav>
                </div>

                <div class="site-footer__col-three">
                    <h3 class="headline headline--small"><?php echo esc_html__( 'یادگیری', 'fictional-uni' ); ?></h3>
                    <nav class="nav-list">
                        <ul>
                            <li><a href="#"><?php echo esc_html__( 'قوانین', 'fictional-uni' ); ?></a></li>
                            <li><a href="#"><?php echo esc_html__( 'حریم خصوصی', 'fictional-uni' ); ?></a></li>
                            <li><a href="#"><?php echo esc_html__( 'فرصت‌های شغلی', 'fictional-uni' ); ?></a></li>
                        </ul>
                    </nav>
                </div>
            </div>

            <!-- COLUMN 4 -->
            <div class="site-footer__col-four">
                <h3 class="headline headline--small"><?php echo esc_html__( 'با ما در ارتباط باشید', 'fictional-uni' ); ?></h3>
                <nav>
                    <ul class="min-list social-icons-list group">
                        <li><a href="#" class="social-color-facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="#" class="social-color-twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="#" class="social-color-youtube"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                        <li><a href="#" class="social-color-linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                        <li><a href="#" class="social-color-instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
