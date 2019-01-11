<?php 

  add_action('rest_api_init', 'userPrivateOffice');

  function userPrivateOffice() {
    register_rest_route(  'shop/v1', 'manageUserPrivateData', array(
      'methods' => 'POST',
      'callback' => 'insertPrivateData'
    ) );

    function insertPrivateData($data) {

      if (is_user_logged_in()) {
        $current_user = wp_get_current_user();
        $name = sanitize_text_field( $data['name'] );
        $email =  sanitize_text_field( $data['email'] );
        $tel = sanitize_text_field( $data['tel'] );
        $delivery = sanitize_text_field( $data['delivery'] );
        $city = sanitize_text_field( $data['city'] );
        $office = sanitize_text_field( $data['office'] );
        
        return wp_insert_post( array(
          'post_type' => 'PersonalData',
          'post_status' => 'private',
          'post_title' => $current_user->user_login,
          'author' => get_current_user_id(),
          'ID' => $data['id'],
          'meta_input' => array(
            'user_name' => $name,
            'user_email' => $email,
            'user_tel' => $tel,
            'user_delivery_service' => $delivery,
            'user_city' => $city,
            'user_delivery_office' => $office
          )
        ));

      } else {

        die('Something went wrong. This user is not logged in');
      }
      
    }

  }

?>