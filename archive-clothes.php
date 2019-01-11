
<?php get_header(); ?>
<?php get_template_part( 'components/component', 'navbar-main' ); ?>

<section class="archive shopping section--no-headline">

  <h3 class="headline archive__title">Каталог</h3>

  <div class="container"> 
    <div class="row">

      <?php get_template_part( 'components/component', 'filters' ) ?>

        <div class="archive__list shopping__list">
          <?php  while ($wp_query->have_posts()) : $wp_query->the_post(); 

            $id_first_image = acf_photo_gallery('gallery', get_the_ID() )[0]['id'];
            $url = wp_get_attachment_image_src( $id_first_image, 'medium' )[0]; 
            $title = mb_strimwidth(get_the_title(), 0, 22, '...'); 
            $sizes = get_field('clothes_sizes');?>

            <div class="archive__item shopping__item" data-id="<?php echo get_the_ID()?>">
              <a href="<?php echo the_permalink() ?>">
                <img class="img-fluid lazy" data-src="<?php echo $url ?>" />
                <div class="clothes-layer">
                  <?php foreach($sizes as $size) { 
                    echo '<span>'. $size .'</span>';
                  }
                  ?>
                </div>
              </a>
              <div class="shopping__name"><?php echo $title; ?></div>
              <div class="shopping__price"><?php echo get_field('price') ?> грн</div>
            </div>
          
          
          <?php endwhile; ?>
      
        </div>

        <div class="archive__more-posts more-posts">
            <button class="btn btn--black">Еще товары</button>
        </div>
      
      </div>
    
  </div>
    
      
</section>

<?php get_footer(); ?>