<div class="row post-row">
  <div class="col-md-12">

    <div class="post-image-col">
      <a href="<?php the_permalink(); ?>">
        <div class="image-wrapper">
          <div class="div-cover" style="background-image: url(<?php echo mythumb( 'large' ); ?>)">
          </div>
        </div>
      </a>
    </div>

    <div class="post-title">
      <a href="<?php the_permalink(); ?>">
        <h2><?php the_title(); ?></h2>
      </a>
    </div>

    <div class="post-text">
      <div class="post-info">
        <div class="kiji-date">
          <time datetime="<?php echo get_the_date( 'Y-m-d' ); ?>">
            <i class="fas fa-edit"></i>
            ：<?php echo get_the_date(); ?>
          </time>
          <?php if ( get_the_modified_date( 'Ymd' ) > get_the_date( 'Ymd' ) ): ?>
            <span class="modified_date">
              |
              <time datetime="<?php echo get_the_modified_date( 'Y-m-d' ); ?>">
                <i class="fas fa-redo"></i>
                ：<?php echo get_the_modified_date(); ?>
              </time>
            </span>
          <?php endif; ?>
        </div>
      </div>
      <div class="post-excerpt">
        <?php the_excerpt(); ?>
      </div>
      <div class="more-btn-wrapper">
        <a href="<?php the_permalink(); ?>" class="more-btn">
          続きを読む
        </a>
      </div>
    </div>

  </div>
</div>
