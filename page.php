<?php get_header(); ?>

<?php if (have_posts()): while(have_posts()): the_post(); ?>

  <?php if( has_post_thumbnail() && $page==1 ): ?>
    <?php $image_id = get_post_thumbnail_id ();
    $image_url = wp_get_attachment_image_src ($image_id, true); ?>
    <div class="parallax-container">
      <div class="hero image-wrapper">
        <div class="div-cover" style="background-image:url(<?php echo mythumb( 'full' ); ?>)">
        </div>
        <div class="container-fluid" id="parallax-object">
          <div class="row">
            <div class="col-md-12">
              <div class="hero-caption">
                <h1><?php the_title(); ?></h1>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <div class="main-content">
    <div class="container-fluid single-page">
      <div class="row">
        <div class="col-md-8 offset-md-2">
          <article <?php post_class( 'kiji' ); ?>>
            <div>
              <?php the_content(); ?>
            </div>
          </article>
        </div>
      </div>
    </div>
  </div>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
