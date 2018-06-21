<?php get_header(); ?>

<div class="breadcrumb-box">
  <div class="container-fluid d-flex justify-content-between">
    <h1><span>&quot;<?php echo get_search_query(); ?>&quot;の検索結果</span></h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?php echo home_url(); ?>">ホーム</a></li>
        <li class="breadcrumb-item">
          <span class="breadcrumb-active">検索結果</span>
        </li>
      </ol>
    </div>
</div>

<div class="container-fluid category-page">
  <div class="row">
    <div class="col-md-8" id="contents">
      <div class="article-list">
        <?php if(have_posts()): while(have_posts()): the_post(); ?>
          <?php get_template_part( 'article_list' ); ?>
        <?php endwhile; endif; ?>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="pagination-index">
            <?php echo paginate_links( array(
              'type' => 'list',
              'prev_text' => '&laquo;',
              'next_text' => '&raquo;',
              'end_size' => '0',
              'mid_size' => '1'
            ) ); ?>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <?php get_sidebar(); ?>
    </div>

  </div>
</div>

<?php get_footer(); ?>
