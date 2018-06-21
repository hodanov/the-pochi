<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">

<script src="<?php echo get_template_directory_uri(); ?>/assets/js/analytics.js"></script>

<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<?php if( is_home() ): // Structured data for top page?>
  <script type="application/ld+json">
  {
    "@context": "http://schema.org/",
    "@type": "Blog",
    "name": "<?php bloginfo( 'name' ); ?>",
    "image": "<?php echo get_template_directory_uri(); ?>/assets/img/my_icatch_image.jpg",
    "url": "<?php echo esc_url( home_url( '/' ) ); ?>",
    "description": "<?php bloginfo( 'description' ); ?>",
    "license": "https://creativecommons.org/licenses/by-nc-sa/3.0/us/deed.en_US"
  }
</script>
<?php endif; // ↑Structured data for a top page?>

<?php if( is_single() || is_page() ): // ↓Structured data for a single page ?>
  <script type="application/ld+json">
  {
    "@context": "http://schema.org/",
    "@type": "BlogPosting",
    "mainEntityOfPage":  {
      "@type": "WebPage",
      "@id": "<?php the_permalink(); ?>"
    },
    "headline": "<?php the_title(); ?>",
    "image": "<?php echo mythumb( 'large' ); ?>",
    "datePublished": "<?php echo get_the_date(); ?>",
    "dateModified": "<?php echo get_the_modified_date(); ?>",
    "description": "<?php echo get_the_excerpt(); ?>",
    "author": {
      "@type": "Person",
      "name": "<?php $author = get_userdata($post->post_author); echo $author->display_name; ?>"
    },
    "publisher": {
      "@type": "Organization",
      "name": "<?php bloginfo( 'name' ); ?>",
      "logo": {
        "@type": "imageObject",
        "url": "<?php echo get_template_directory_uri(); ?>/assets/img/hodalog_logo_600x60.png"
      }
    }
  }
</script>
<?php endif; // ↑Structured data for a single page?>

<title><?php wp_title( '|', true, 'right'); bloginfo( 'name' ); ?></title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Capriola">
<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); echo '?' . filemtime( get_stylesheet_directory() . '/style.css'); ?>" />

<?php if( is_single() || is_page() ): // ↓Meta-data for a single page ?>
  <meta name="description" content="<?php echo get_the_excerpt(); ?>">
  <?php if( has_tag() ): ?>
    <?php $tags = get_the_tags();
    $kwds = array();
    foreach($tags as $tag){
      $kwds[] = $tag->name;
    } ?>
    <meta name="keywords" content="<?php echo implode( ',', $kwds ); ?>">
  <?php endif; ?>

  <meta property="og:type" content="article">
  <meta property="og:title" content="<?php the_title(); ?>">
  <meta property="og:url" content="<?php the_permalink(); ?>">
  <meta property="og:description" content="<?php echo get_the_excerpt(); ?>">
  <meta property="og:image" content="<?php echo mythumb( 'large' ); ?>">
  <meta property="article:author" content="https://www.facebook.com/YOUR-FACEBOOK-ACCOUNT">
<?php endif; // ↑Meta-data for a single page?>

<?php if( is_home() ): // ↓Meta-data for a top page?>
  <meta name="description" content="<?php bloginfo( 'description' ); ?>">

  <?php $allcats = get_categories();
  $kwds = array();
  foreach($allcats as $allcat){
    $kwds[] = $allcat->name;
  } ?>
  <meta name="keywords" content="<?php echo implode( ',', $kwds ); ?>">
  <meta property="og:type" content="website">
  <meta property="og:title" content="<?php bloginfo( 'name' ); ?>">
  <meta property="og:url" content="<?php echo esc_url( home_url( '/' ) ); ?>">
  <meta property="og:description" content="<?php bloginfo( 'description' ); ?>">
  <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/assets/img/my_icatch_image.jpg">
<?php endif; // ↑Meta-data for a top page?>

<?php if( is_category() || is_tag() ): // ↓Meta-data for a category page?>
  <?php if( is_category() ){
    $termid = $cat;
    $taxname = 'category';
  }
  elseif( is_tag() ){
    $termid = $tag_id;
    $taxname = 'post_tag';
  } ?>

  <meta name="description" content="<?php single_term_title(); ?>に関する記事の一覧です。">

  <?php $childcats = get_categories( array( 'child_of' => $termid ) );
    $kwds = array();
    $kwds[] = single_term_title('', false);
    foreach($childcats as $childcat){
      $kwds[] = $childcat->name;
    } ?>
  <meta name="keywords" content="<?php echo implode( ',', $kwds ); ?>">
  <meta property="og:type" content="website">
  <meta property="og:title" content="<?php single_term_title(); ?>に関する記事 | <?php bloginfo( 'name' ); ?>">
  <meta property="og:url" content="<?php echo get_term_link( $termid, $taxname ); ?>">
  <meta property="og:description" content="<?php single_term_title(); ?>に関する記事の一覧です。">
  <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/assets/img/my_icatch_image.jpg">
<?php endif; // ↑Meta-data for a category page　?>

<meta property="og:site_name" content="<?php bloginfo( 'name' ); ?>">
<meta property="og:locale" content="ja_jP">
<meta property="fb:app_id" content="">

<meta name="twitter:site" content="">
<meta name="twitter:card" content="summary">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

  <header>
    <div class="navbar-fixed">
      <nav>
        <div class="nav-wrapper container-fluid">
          <a id="logo-container" href="<?php echo get_home_url(); ?>" class="brand-logo">HODALOG</a>
          <div id="menu-bar-btn"><i class="fas fa-bars"></i></div>
          <?php wp_nav_menu( array(
            'theme_location' => 'sitenav',
            'menu_class' => ''
          ) ); ?>
        </div>
      </nav>
    </div>
    <?php wp_nav_menu( array(
      'theme_location' => 'sitenav2',
      'menu_id' => 'side-nav'
    ) ); ?>
  </header>
