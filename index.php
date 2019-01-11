<?php get_header(); ?>
<?php get_template_part( 'components/component', 'navbar-main' ); ?>

<section class="blog-page section--page">

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h3 class="headline">Блог IITA</h3>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="offset-md-2 col-md-8 blog-page__articles">

        <?php 
          while(have_posts()) { // 10 by default (see settings->reading)
            the_post(); 
            $excerpt = wp_trim_words( get_the_content(), 20, '...' );
            $imageUrl = get_the_post_thumbnail_url( get_the_ID(), 'medium');
            ?>

            <div class="blog-page__article">
              <a href="<?php echo get_the_permalink() ?>">
                <img src="<?php echo $imageUrl; ?>" alt="" class="img-fluid">
              </a>
              <div class="blog-page__content">
                <h3><?php the_title(); ?></h3>
                <span><?php echo $excerpt ?></span>
                <a href="<?php echo get_the_permalink() ?>" class="btn btn--black">Читать полностью</a>
              </div>
            </div>
            
          <?php }
          
          echo '<div class="paginate-links">';
            echo paginate_links( array(
            'prev_text' => '<i class="fas fa-caret-left"></i>',
            'next_text' => '<i class="fas fa-caret-right"></i>',
            ) );
          echo '</div>';
        ?>

      </div>
    </div>
  </div>

  
</section>

<?php get_footer(); ?>