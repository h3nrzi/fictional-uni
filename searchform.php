<form class="search-form" method="get" action="<?php echo esc_url( site_url( "/" ) ); ?>">
    <label class="headline headline--medium" for="s"><?php echo esc_html__( 'جستجوی جدید انجام دهید:', 'fictional-uni' ); ?></label>
    <div class="search-form-row">
        <input class="s" id="s" type="search" name="s" placeholder="<?php echo esc_attr__( 'دنبال چه چیزی هستید؟', 'fictional-uni' ); ?>">
        <input class="search-submit" type="submit" value="<?php echo esc_attr__( 'جستجو', 'fictional-uni' ); ?>">
    </div>
</form>
