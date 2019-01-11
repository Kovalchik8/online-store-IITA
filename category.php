
<?php get_header(); ?>
<?php get_template_part( 'components/component', 'navbar-main' ); 
  $category = get_queried_object();
?>

<section class="category shopping section--no-headline" data-id="<?php echo $category->term_id; ?>">

  <h3 class="headline category__title"><?php echo $category->name; ?></h3>

  <div class="container">
    <div class="row">

      <?php get_template_part( 'components/component', 'filters' ) ?>

        <div class="category__list shopping__list">

          <?php  while ($wp_query->have_posts()) : $wp_query->the_post(); 

            $id_first_image = acf_photo_gallery('gallery', get_the_ID() )[0]['id'];
            $url = wp_get_attachment_image_src( $id_first_image, 'medium' )[0];
            $title = mb_strimwidth(get_the_title(), 0, 22, '...');
            $sizes = get_field('clothes_sizes');?>

            <div class="category__item shopping__item" data-id="<?php echo get_the_ID()?>">
              <a href="<?php echo the_permalink() ?>">
                <img src="<?php echo $url; ?>" class="img-fluid lazy" alt="">
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
  </div>

</section>

<?php get_footer(); ?>