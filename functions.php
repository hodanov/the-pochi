<?php
// Change Class of child elements of sub-menu to "dropdown-list"
function change_submenu_class($menu) {
  $menu = preg_replace('#class="sub-menu"#','class="dropdown-list"',$menu);
  return $menu;
}
add_filter('wp_nav_menu','change_submenu_class');

// Char counts of abstract (excerpt)
function my_length($length) {
  return 88;
}
add_filter('excerpt_mblength', 'my_length');

// Ellipsis of abstract (excerpt)
function my_more($more) {
  return '...[続きを読む]';
}
add_filter('excerpt_more', 'my_more');

// Wrap YouTube video content with div
function ytwrapper($return, $data, $url) {
  if ($data->provider_name == 'YouTube') {
    return '<div class="ytvideo">'.$return.'</div>';
  }
  else {
    return $return;
  }
}
add_filter('oembed_dataparse', 'ytwrapper', 10, 3);

// Icatch image
add_theme_support( 'post-thumbnails' );

// Import stylesheet for visual editor
add_editor_style();

// Thumbnails
function mythumb( $size ){
  if( has_post_thumbnail() ){
    $postthumb = wp_get_attachment_image_src( get_post_thumbnail_id(), $size );
    $url = $postthumb[0];
  }
  elseif ( get_header_image() ) {
    $url = header_image();
  }
  else{
    $url = get_template_directory_uri() . '/assets/img/my_icatch_image.jpg';
  }
  return $url;
}

// Change output of comment form
function wp34731_move_comment_field_to_bottom( $fields ) {
  $comment_field = $fields['comment'];
  unset( $fields['comment'] );
  $fields['comment'] = $comment_field;
  return $fields;
}
add_filter( 'comment_form_fields', 'wp34731_move_comment_field_to_bottom' );

// Change output of search form
function my_search_form( $form ) {
  $form = '
  <form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
    <div class="input-group">
      <input type="text" class="form-control" placeholder="Search for..." value="' . get_search_query() . '" name="s" id="s">
      <span class="input-group-btn">
        <button type="submit" id="searchsubmit" class="btn btn-secondary" value="'. esc_attr__( 'Search' ) .'"><i class="fas fa-search"></i></button>
      </span>
    </div>
  </form>';
  return $form;
}

add_filter( 'get_search_form', 'my_search_form', 100 );

// Custom menu
register_nav_menu( 'sitenav', 'global navigation' );
register_nav_menu( 'sitenav2', 'global navigation for phone' );
register_nav_menu( 'featured_posts_slider', 'featured posts slider' );

// Remove jQuery of WordPress
function my_init() {
  if ( !is_admin() ) {
    wp_deregister_script('jquery');
  }
}
add_action('wp_enqueue_scripts', 'my_init');

// Distinguish access from crawler(BOT)
function is_bot(){
  $ua = $_SERVER['HTTP_USER_AGENT'];
  $bots = array(
    "googlebot",
    "msnbot",
    "yahoo"
  );
  foreach( $bots as $bot){
    if (stripos( $ua, $bot ) !== false){
      return true;
    }
  }
  return false;
}

// Add customizing widget
register_sidebar( array(
  'id' => 'google_analytics_tag',
  'name' => 'Add google analytics tag',
  'description' => 'カスタムHTMLを利用してGoogle Analyticsタグ（gtag.js）を設定できます。',
  'before_widget' => false,
  'after_widget' => false,
  'before_title' => false,
  'after_title' => false
) );

register_sidebar( array(
  'id' => 'sidebar',
  'name' => 'Sidebar',
  'description' => 'サイドバー上部に表示する情報や広告を設定できます',
  'before_widget' => '<aside id="%1$s" class="mymenu widget %2$s">',
  'after_widget' => '</aside>',
  'before_title' => '<h2 class="widgettitle"><span>',
  'after_title' => '</span></h2>'
) );

register_sidebar( array(
  'id' => 'sidebar_bottom',
  'name' => 'Sidebar bottom',
  'description' => 'サイドバー下に表示する情報や広告を設定できます',
  'before_widget' => '<aside id="%1$s" class="myad2 mymenu widget %2$s">',
  'after_widget' => '</aside>',
  'before_title' => '<h2 class="widgettitle"><span>',
  'after_title' => '</span></h2>'
) );

register_sidebar( array(
  'id' => 'widget-in-article',
  'name' => 'Ad before article',
  'description' => '記事内最初の見出し前に広告などを設定できます',
  'before_widget' => '<div id="%1$s" class="myad mymenu widget %2$s">',
  'after_widget' => '</div>',
  'before_title' => '<h2 class="widgettitle"><span>',
  'after_title' => '</span></h2>'
) );
define('H2_REG', '/<h2.*?>/i');
function get_h2_included_in_body( $the_content ){
  if ( preg_match( H2_REG, $the_content, $h2results )) {
    return $h2results[0];
  }
}
function add_widget_before_1st_h2($the_content) {
  if ( is_single() &&
       is_active_sidebar( 'widget-in-article' )
  ) {
    ob_start();
    dynamic_sidebar( 'widget-in-article' );
    $ad_template = ob_get_clean();
    $h2result = get_h2_included_in_body( $the_content );
    if ( $h2result ) {
      $count = 1;
      $the_content = preg_replace(H2_REG, $ad_template.$h2result, $the_content, 1);
    }
  }
  return $the_content;
}
add_filter('the_content','add_widget_before_1st_h2');

register_sidebar( array(
  'id' => 'ad',
  'name' => 'Ad for closing of article',
  'description' => '記事内最後に表示する広告などを設定できます',
  'before_widget' => '<div id="%1$s" class="myad mymenu widget %2$s">',
  'after_widget' => '</div>',
  'before_title' => '<h2 class="widgettitle"><span>',
  'after_title' => '</span></h2>'
) );

// register_sidebar( array(
//   'id' => 'footer-copyright',
//   'name' => 'Copyright for Footer',
//   'description' => 'フッター部に情報を表示できます',
//   'before_widget' => '<div class="footer_widget">',
//   'after_widget' => '</div>',
//   'before_title' => '<p class="copyright">',
//   'after_title' => '</p>'
// ) );

// Widget search
add_theme_support( 'html5', array('search-form') );

// Custom header
add_theme_support( 'custom-header', array(
  'width' => 1280,
  'height' => 720,
  'header-text' => false
));

// Remove emoji function of Wordpress
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

// Remove self-ping-back
function no_self_ping( &$links ) {
    $home = get_option( 'home' );
    foreach ( $links as $l => $link )
        if ( 0 === strpos( $link, $home ) )
            unset($links[$l]);
}
add_action( 'pre_ping', 'no_self_ping' );

// Remove domain from URL of images and change to relative path
function delete_host_from_attachment_url( $url ) {
  $regex = '/^http(s)?:\/\/[^\/\s]+(.*)$/';
  if ( preg_match( $regex, $url, $m ) ) {
    $url = $m[2];
  }
  return $url;
}
add_filter( 'wp_get_attachment_url', 'delete_host_from_attachment_url' );
add_filter( 'attachment_link', 'delete_host_from_attachment_url' );

// Remove some codes from head
remove_action('wp_head', 'rsd_link');// リモート投稿用のタグを削除・link rel="EditURI" type="application/rsd+xml" title="RSD"
remove_action('wp_head', 'wlwmanifest_link');// リモート投稿用のタグを削除・link rel="wlwmanifest" type="application/wlwmanifest+xml"
remove_action('wp_head', 'wp_shortlink_wp_head');// 投稿IDを使った短いURLを表示・link rel=’shortlink’

// Add excerpt to static page
add_post_type_support( 'page', 'excerpt' );

// Distinguish access from smartphone
function is_mySmartphone(){
  $ua = $_SERVER['HTTP_USER_AGENT'];
  if ( strpos( $ua, 'iPhone' )
  || ( strpos( $ua, 'Android' ) && strpos( $ua, 'Mobile' ) )
  || strpos( $ua, 'Windows Phone' ) ){
    return true;
  }else{
    return false;
  }
}
