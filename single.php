<?php get_header(); ?>

<div class="main-content">
  <div class="container-fluid single-page">
    <div class="row">

      <?php if (have_posts()): while(have_posts()): the_post(); ?>

        <div class="col-md-8" id="contents">
          <div class="row">
            <div class="col-md-12">
              <article <?php post_class( 'kiji' ); ?>>
                <div class="kiji-tag">
                  <?php the_tags( '<ul><li>', '</li><li>', '</li></ul>'); ?>
                </div>
                <h1><?php the_title(); ?></h1>
                <div class="post-info">
                  <div class="kiji-date">
                    <time datetime="<?php echo get_the_date( 'Y-m-d' ); ?>">
                      <i class="fas fa-edit"></i>:<?php echo get_the_date(); ?>
                    </time>
                    <?php if ( get_the_modified_date( 'Ymd' ) > get_the_date( 'Ymd' ) ): ?>|
                      <time datetime="<?php echo get_the_modified_date( 'Y-m-d' ); ?>">
                        <i class="fas fa-redo"></i>:<?php echo get_the_modified_date(); ?>
                      </time>
                    <?php endif; ?>
                  </div>
                </div>

                <?php if( has_post_thumbnail() && $page==1 ): ?>
                  <?php $image_id = get_post_thumbnail_id ();
                  $image_url = wp_get_attachment_image_src ($image_id, true);
                  ?>

                  <div class="image-wrapper icatch">
                    <div class="div-cover" style="background-image: url(<?php echo mythumb( 'full' ); ?>)">
                    </div>
                  </div>
                <?php endif; ?>

                <div>
                  <?php the_content(); ?>
                </div>

                <div class="share">
                  <?php get_template_part('sns'); ?>
                </div>

                <?php dynamic_sidebar( 'ad' ); ?>

              </article>
            </div>
          </div>

          <?php if ( has_category() ) {
            $cats = get_the_category();
            $catkwds = array();
            foreach ($cats as $cat) {
              $catkwds[] = $cat->term_id;
            }
          } ?>
          <?php $myposts = get_posts( array(
            'post_type' => 'post',
            'posts_per_page' => '3',
            'post__not_in' => array( $post->ID ),
            'category__in' => $catkwds,
            'orderby' => 'rand'
          ) );
          if( $myposts ): ?>
          <div class="row">
            <div class="col-md-12 recent-posts-wrapper">
              <div class="mymenu-thumb mymenu-related-list">
                <h3>この記事をよんでくれたあなたにオススメ！</h3>
                <div class="row">
                  <?php foreach($myposts as $post): setup_postdata($post); ?>
                    <div class="col-sm-4 mymenu-related">
                      <a href="<?php the_permalink(); ?>">
                        <div class="image-wrapper">
                          <div class="div-cover" style="background-image: url(<?php echo mythumb( 'large' ); ?>)">
                          </div>
                        </div>
                        <div class="text">
                          <?php the_title(); ?>
                          <div class="post-info">
                            <div class="kiji-date">
                              <time datetime="<?php echo get_the_date( 'Y-m-d' ); ?>">
                                <i class="fas fa-edit"></i>投稿: <?php echo get_the_date(); ?>
                              </time>
                            </div>
                          </div>
                        </div>
                      </a>
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>
          </div>
          <?php wp_reset_postdata(); endif; ?>

          <div class="row">
            <div class="col-md-12 comment-wrapper">
              <?php comments_template(); ?>
            </div>
          </div>

        </div>

        <div class="col-md-4">
          <?php get_sidebar(); ?>
        </div>

      </div>
      <!-- /.row -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.main-content -->

<?php endwhile; endif; ?>

<?php get_footer(); ?>
