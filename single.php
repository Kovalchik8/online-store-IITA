<?php get_header(); ?>
<?php get_template_part( 'components/component', 'navbar-main' ); ?>
<?php the_post(); ?>

<section class="post-single section--page">

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h3 class="headline headline--post-single"><?php echo the_title(); ?></h3>
        <p class="headline-sign"><?php echo get_the_date(); ?></p>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-12 align-center">
        <div class="post-single__img lazy" data-bg="url(' <?php echo get_the_post_thumbnail_url(); ?> ')">
        </div>
      </div>
      <div class="col-12 post-single__content">
        <?php the_content(); ?>
        <div class="post-single__buttons">
          <?php 
            $prev = get_previous_post_link( '%link', '%title');   
            echo str_replace( '<a ', '<a class="post-single__prev-post btn btn--black" ', $prev );

            $next = get_next_post_link( '%link', '%title');   
            echo str_replace( '<a ', '<a class="post-single__next-post btn btn--black" ', $next );
          ?>
        </div>
      </div>
    </div>
  </div>

</section>

<?php get_footer(); ?>

