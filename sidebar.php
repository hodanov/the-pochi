<div id="sidebar">
  <div id="side">

    <?php dynamic_sidebar( 'sidebar' ); ?>

    <?php $myposts = get_posts( array(
      'post_type' => 'post',
      'posts_per_page' => '10'
    ) );
    if( $myposts ): ?>
    <aside class="recent">
      <h2><span>New</span></h2>
      <ul>
        <?php foreach($myposts as $post): setup_postdata($post); ?>
          <li>
            <a href="<?php the_permalink(); ?>">
              <div class="row">
                <div class="col-4">
                  <div class="image-wrapper">
                    <div class="div-cover" style="background-image: url(<?php echo mythumb( 'medium' ); ?>)">
                    </div>
                  </div>
                </div>
                <div class="col-8">
                  <div class="text">
                    <p><?php the_title(); ?></p>
                  </div>
                </div>
              </div>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    </aside>
    <?php wp_reset_postdata(); endif; ?>

    <?php dynamic_sidebar( 'sidebar_bottom' ); ?>

  </div>
</div>
