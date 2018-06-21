<?php get_header(); ?>

<?php if( get_header_image() ): ?>
  <div class="parallax-container">
    <div class="hero image-wrapper">
      <div class="div-cover" style="background-image:url(<?php header_image(); ?>)">
      </div>
      <div class="container-fluid" id="parallax-object">
        <div class="row">
          <div class="col-md-12">
            <div class="hero-caption">
              <h2>HODA'S WEB ENGINEERING BLOG</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>

<div class="main-content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8" id="contents">
        <?php get_template_part( 'slider' ); ?>
        <div class="article-list">
          <?php if(have_posts()): while(have_posts()): the_post(); ?>
            <?php get_template_part( 'article_list' ); ?>
          <?php endwhile; endif; ?>
        </div>
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
      <div class="col-md-4">
        <?php get_sidebar(); ?>
      </div>
    </div>
  </div>
</div>

<?php get_footer();
