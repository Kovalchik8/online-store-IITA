<?php 

  // create new API request
  add_action('rest_api_init', 'searchCustomApi');

  function searchCustomApi() {
    register_rest_route( 'shop/v1', 'search', array(
      'methods' => WP_REST_SERVER::READABLE,
      'callback' => 'searchResults'
    ) );
  }

  function searchResults($data) {
    $mainQuery = new WP_Query( array(
      'post_type' => array('post', 'clothes'),
      's' => sanitize_text_field( $data['term'] ),
    ) );

    $results = array(
      'general' => array(),
      'clothes' => array(),
    );

    while($mainQuery->have_posts()) {
      $mainQuery->the_post();

      if (get_post_type() == 'post') {
        array_push($results['general'], array(
          'title' => get_the_title(),
          'link' => get_the_permalink(),
          'image' => get_the_post_thumbnail_url(),
          'excerpt' => wp_trim_words( get_the_content(), 20, '...' )
        ));
      }

      if (get_post_type() == 'clothes') {
        $id = acf_photo_gallery('gallery', get_the_ID() )[0]['id'];
        array_push($results['clothes'], array(
          'id' => get_the_ID(),
          'title' => get_the_title(),
          'link' => get_the_permalink(),
          'image' => wp_get_attachment_image_src( $id, 'medium' )[0],
          'price' => get_field('price'),
          'sizes' => get_field('clothes_sizes')
        ));
      }

      
    } // while($mainQuery->have_posts())

    return $results;
  }
        
?>