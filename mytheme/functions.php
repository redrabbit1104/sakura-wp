<?php

function mytheme_setup() {

	// （Ｃ）のCSSを有効化
	add_theme_support( 'wp-block-styles' );

	// 縦横比を維持したレスポンシブを有効化
	add_theme_support( 'responsive-embeds' );
	
	// （Ｅ）のCSSを有効化＆エディタに読み込み
	add_theme_support( 'editor-styles' );
	add_editor_style( 'editor-style.css' );

	// ページのタイトルを有効化
	add_theme_support( 'title-tag' );

	// link、style、scriptのHTML5対応を有効化
	add_theme_support( 'html5', array( 
		'style', 
		'script' 
	) );

	// アイキャッチ画像を有効化
	add_theme_support( 'post-thumbnails' );

	// 全幅・幅広を有効化
	add_theme_support( 'align-wide' );

	// メニューのロケーションを登録
	register_nav_menus( array(
		'primary' => 'ナビゲーション'
	) );

	// ２段組みを有効化
	add_theme_support( 'mycols' );

}

add_action( 'after_setup_theme', 'mytheme_setup' );


function mytheme_enqueue() {

	// Google Fontsを読み込み
	wp_enqueue_style( 
		'myfonts', 
		'https://fonts.googleapis.com/css?family=Josefin+Sans:300,700&display=swap', 
		array(), 
		null 
	);

	// Dashiconsを読み込み
	wp_enqueue_style( 
		'dashicons' 
	);

	// （Ｄ）テーマのCSSを読み込み
	wp_enqueue_style( 
		'mytheme-style', 
		get_stylesheet_uri(),
		array(),
		filemtime( get_theme_file_path( 'style.css' ) )
	);

}
add_action( 'wp_enqueue_scripts', 'mytheme_enqueue' );


function mytheme_widgets() {

	// ウィジェットエリアを登録
	register_sidebar( array(
		'id' => 'sidebar-1',
		'name' => 'フッターメニュー',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>'
	) );

}
add_action( 'widgets_init', 'mytheme_widgets' );

add_action( 'init', 'create_post_type' );
function create_post_type() {
    register_post_type( 'korean', [ // 投稿タイプ名の定義
        'labels' => [
            'name'          => '韓国語', // 管理画面上で表示する投稿タイプ名
            'singular_name' => 'korean',    // カスタム投稿の識別名
        ],
        'public'        => true,  // 投稿タイプをpublicにするか
        'has_archive'   => false, // アーカイブ機能ON/OFF
        'menu_position' => 5,     // 管理画面上での配置場所
				'menu_icon' => 'dashicons-universal-access', //メニューのアイコンを指定
				'supports' => ['thumbnail', 'title', 'editor','page-attributes'],     //title,editor,thumbnailなどを指定
				'has_archive' => true,
				'hierarchical' => true,
        'show_in_rest'  => true,  // 5系から出てきた新エディタ「Gutenberg」を有効にする
    ]);
		register_post_type( 'travel', [ // 投稿タイプ名の定義
			'labels' => [
					'name'          => 'トラベル', // 管理画面上で表示する投稿タイプ名
					'singular_name' => 'travel',    // カスタム投稿の識別名
			],
			'public'        => true,  // 投稿タイプをpublicにするか
			'has_archive'   => false, // アーカイブ機能ON/OFF
			'menu_position' => 6,     // 管理画面上での配置場所
			'menu_icon' => 'dashicons-universal-access', //メニューのアイコンを指定
			'supports' => ['thumbnail', 'title', 'editor','page-attributes'],     //title,editor,thumbnailなどを指定
			'has_archive' => true,
			'hierarchical' => true,
      'show_in_rest'  => true,  // 5系から出てきた新エディタ「Gutenberg」を有効にする
    ]);
}