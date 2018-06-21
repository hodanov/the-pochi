<?php
$location_name = 'featured_posts_slider';
$locations = get_nav_menu_locations();
$featured_posts = wp_get_nav_menu_items( $locations[ $location_name ] );
if( $featured_posts ):
  $slide_window_width = sizeof( $featured_posts ) * 100;
?>

<div id="featured-posts-slider">
  <div class="row">
    <div class="col-md-12">
      <div class="slide-window">
        <div class="slide-wrapper" style="width: <?php echo $slide_window_width; ?>%;">
          <?php foreach($featured_posts as $post):
            if( ($post->object == 'post') || ($post->object == 'page') ):
              $post = get_post( $post->object_id );
              setup_postdata($post); ?>
          <div class="image-wrapper slide">
            <a href="<?php the_permalink(); ?>" target="_blank">
              <div class="div-cover" style="background-image: url(<?php echo mythumb( 'large' ); ?>)">
              </div>
              <div class="slide-caption">
                <h2><?php the_title(); ?></h2>
              </div>
            </a>
          </div>
          <?php elseif( ($post->object == 'custom') ): ?>
          <div class="image-wrapper slide">
            <a href="<?php echo ($post->url); ?>" target="_blank">
              <div class="div-cover" style="background-image: url(<?php echo mythumb( 'large' ); ?>)">
              </div>
              <div class="slide-caption">
                <h2><?php echo ($post->title); ?></h2>
              </div>
            </a>
          </div>
          <?php endif; endforeach; ?>
        </div>
        <div class="slide-controller">
          <div class="slide-control-left" id="slide-control-left">
            <div class="slide-control-line"></div>
            <div class="slide-control-line"></div>
          </div>
          <div class="slide-control-right" id="slide-control-right">
            <div class="slide-control-line"></div>
            <div class="slide-control-line"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php wp_reset_postdata(); endif; ?>
