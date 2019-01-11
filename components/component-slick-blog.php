<?php 

  $articles = new WP_Query( array(
      'post_type' => 'post',
      'orderby' => 'date',
      'order' => 'DESC'
    ));

  ?>

<div class="container">
    
  <div class="slick-blog">

    <?php 
      while($articles->have_posts()) { 
        $articles->the_post();
        $articleExcerpt = wp_trim_words( get_the_content(), 45, '...' )?>
      
        <a href=" <?php echo the_permalink(); ?> " class="blog__item">
          <div class="blog__img lazy" data-bg="url('<?php echo get_the_post_thumbnail_url(); ?>')"></div>
          <div class="blog__title"><?php the_title(); ?></div>
          <div class="blog__excerpt"><?php echo $articleExcerpt; ?></div>
        </a>

    <?php } ?>

  </div>

</div>

