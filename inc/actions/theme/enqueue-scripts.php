<?php

function university_files(): void {
	// Javascript
	wp_enqueue_script( 'main-university-js', get_theme_file_uri( '/build/index.js' ), [ "jquery" ], '1.0', true );

	// Localize script with site URL
	wp_localize_script( "main-university-js", "university_data", [
		"root_url" => get_site_url(),
		"nonce"    => wp_create_nonce( "wp_rest" ),
		"i18n"     => [
			"searchPlaceholder" => "به دنبال چه چیزی هستید؟",
			"searchError"       => "خطای غیرمنتظره‌ای رخ داد؛ لطفاً دوباره تلاش کنید.",
			"sectionPrograms"   => "رشته‌ها",
			"sectionEvents"     => "رویدادها",
			"sectionGeneral"    => "اطلاعات عمومی",
			"sectionProfessors" => "اساتید",
			"sectionCampuses"   => "پردیس‌ها",
			"noPrograms"        => "هیچ رشته‌ای با این جستجو مطابقت ندارد.",
			"noEvents"          => "هیچ رویدادی با این جستجو مطابقت ندارد.",
			"noGeneral"         => "هیچ اطلاعات عمومی مطابق این جستجو پیدا نشد.",
			"noProfessors"      => "هیچ استادی با این جستجو مطابقت ندارد.",
			"noCampuses"        => "هیچ پردیسی با این جستجو مطابقت ندارد.",
			"viewAllPrograms"   => "مشاهده همه رشته‌ها",
			"viewAllEvents"     => "مشاهده همه رویدادها",
			"viewAllCampuses"   => "مشاهده همه پردیس‌ها",
			"learnMore"         => "بیشتر بخوانید",
			"authorBy"          => "توسط",
			"notesEdit"         => "ویرایش",
			"notesDelete"       => "حذف",
			"notesCancel"       => "لغو",
			"notesSave"         => "ذخیره",
			"notesDeleteError"  => "امکان حذف یادداشت وجود ندارد. لطفاً دوباره تلاش کنید.",
			"notesSaveError"    => "امکان ذخیره یادداشت وجود ندارد. لطفاً دوباره تلاش کنید.",
			"notesCreateError"  => "امکان ایجاد یادداشت وجود ندارد. لطفاً دوباره تلاش کنید.",
		],
	] );

	// Google Map script
	//wp_enqueue_script( 'google_map', "//maps.googleapis.com/map/api/js?key=123456789", null, '1.0', true );

	// Fonts
	wp_enqueue_style( 'custom-persian-fonts', 'https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;700&display=swap', [], null );

	// Icons
	wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );

	// Styles
	wp_enqueue_style( 'university-main-styles', get_theme_file_uri( '/build/style-index.css' ) );
	wp_enqueue_style( 'university-extra-styles', get_theme_file_uri( '/build/index.css' ) );

	wp_enqueue_style( 'university-rtl-styles', get_theme_file_uri( '/rtl.css' ) );
}

add_action( 'wp_enqueue_scripts', 'university_files' );
