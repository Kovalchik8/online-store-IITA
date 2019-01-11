<?php 

require get_theme_file_path('/includes/search-route.php');
require get_theme_file_path('/includes/userdata-route.php');

// include css and js files
function shopFiles () {
  // css
  wp_enqueue_style( 'shop-main-stylesheet', get_stylesheet_uri(), NULL, microtime() );

  // js
  wp_enqueue_script( 'shop-main-js', get_theme_file_uri('/js/scripts-bundled.js'), NULL, microtime(), true );
  wp_localize_script( 'shop-main-js', 'shopData', array(
    'admin_ajax' => admin_url('admin-ajax.php'),
    'theme_folder' => get_template_directory_uri(),
    'root_url' => get_site_url(),
    'nonce' => wp_create_nonce( 'wp_rest' ),
  ));
}

add_action( 'wp_enqueue_scripts', 'shopFiles' );

// dynamil slick slider on home page
function slickByCategory ($categoryName) {

    $clothes = new WP_Query( array(
        'post_type' => 'clothes',
        'category_name' => $categoryName,
        'order' => 'ASC',
      ));
  ?>

  <div class="container-fluid section-slider__slick">

    <div class="section-slider__slick-slider">

    <?php while ( $clothes->have_posts() ) {

      $clothes->the_post(); 
      $id = acf_photo_gallery('gallery', $clothes->post->ID )[0]['id'];
      $url = wp_get_attachment_image_src( $id, 'medium' )[0];
      $title = mb_strimwidth(get_the_title(), 0, 20, '...');
      $sizes = get_field('clothes_sizes');
      ?>

      <div class="section-slider__item modal-trigger">
      <a href="<?php echo the_permalink() ?>">
        <img data-src="<?php  echo $url ?>" class="img-fluid lazy" alt="">
        <div class="clothes-layer">
          <?php foreach($sizes as $size) { 
            echo '<span>'. $size .'</span>';
          }
          ?>
        </div>
      </a>
      <div class="section-slider__desc">
        <span class="section-slider__name"><?php echo $title; ?></span>
        <span class="section-slider__price modal-trigger__price"><?php echo get_field('price'); ?> грн</span>
      </div>
    </div>

    <?php } ?>

    </div>

  </div>

<?php }

// shop features
function shop_features () {
  add_theme_support( 'post-thumbnails' );
}

add_action( 'after_setup_theme', 'shop_features' );

// query filters
function shop_query_filter($query) {
  if ( !is_admin() && $query->is_main_query() ) {
    if ($query->is_category()) {
      $query->set( 'post_type', array( 'clothes' ) );
      $query->set('posts_per_page', 4);
      $query->set( 'meta_query', array(
        array(
          'key' => 'related_color_item',
          'value' => '0',
          'compare' => '==',
        )
      ));
    } else if ( $query->is_archive('clothes') ) {
      $query->set('posts_per_page', 4);
      $query->set( 'meta_query', array(
        array(
          'key' => 'related_color_item',
          'value' => '0',
          'compare' => '==',
        )
      ));
    }
  }
  
}

add_action('pre_get_posts','shop_query_filter');

// send email
add_action('wp_ajax_nopriv_sendMail', 'sendMail');
add_action('wp_ajax_sendMail', 'sendMail');

function sendMail () {

    $to = "storojs72@gmail.com";
    // $to = "koval4ik8@email.ua";
    
    ($_POST['name']) ? $name = '<p>Имя: '.$_POST['name'].'</p>' : $name = '';
    ($_POST['tel']) ? $tel = '<p>Телефон: '.$_POST['tel'].'</p>' : $tel = '';
    ($_POST['email']) ? $email = '<p>Почта: '.$_POST['email'].'</p>' : $email = '';
    ($_POST['order']) ? $order = '<p>Номер заказа: '.$_POST['order'].'</p>' : $order = '';
    ($_POST['message']) ? $text = '<p>Cообщение: '.$_POST['message'].'</p>' : $text = '';
    ($_POST['link']) ? $link = '<p>Ссылка: <a target="_blank" href=' .$_POST['link']. '>' .$_POST['link']. '</a></p>' : $link = '';

    $message = $name . $tel . $email . $order . $text . $link;

    $headers  = "Content-type: text/html; charset=utf8 \r\n";

    if (mail($to, $_POST['subject'], $message, $headers) ) {
      echo "<div class='alert alert-success' role='alert'>"
            . $_POST['feedback'] .
            "</div>";
    } else {
      echo "<div class='alert alert-danger' role='alert'>
             Ошибка. Повторите попытку позже.
            </div>"; 
    }

    die();
}

// send cart order
add_action('wp_ajax_nopriv_sendCartOrder', 'sendCartOrder');
add_action('wp_ajax_sendCartOrder', 'sendCartOrder');

function sendCartOrder () {

    $to = "storojs72@gmail.com";
    // $to = "koval4ik8@email.ua";

    $messageToClient = stripslashes($_POST['mailClient']);
    $messageToOwner = stripslashes($_POST['mailOwner']);

    $headers  = "Content-type: text/html; charset=utf8 \r\n";
    
    if (mail($to, $_POST['subject'], $messageToOwner, $headers) ) {
      
      mail($_POST['email'], 'Ваш заказ', $messageToClient, $headers);

      echo "<div class='alert alert-success' role='alert'>"
            . $_POST['feedback'] .
            "</div>";
    } else {
      echo "<div class='alert alert-danger' role='alert'>
             Ошибка. Повторите попытку позже.
            </div>";
    }

    die();
}


// cart content
add_action( 'wp_ajax_nopriv_cartContent', 'cartContent' );
add_action( 'wp_ajax_cartContent', 'cartContent' );

function cartContent() {

  $ids = $_POST['requestIds'];
  $results = array(
      'clothes' => array(),
    );
  
  global $post;
  foreach ($ids as $id) :
    $post = get_post($id);
    setup_postdata( $post );
    $id = acf_photo_gallery('gallery', get_the_ID() )[0]['id'];
    array_push($results['clothes'], array(
      'id' => get_the_ID(),
      'title' => get_the_title(),
      'link' => get_the_permalink(),
      'image' => wp_get_attachment_image_src( $id, 'medium' )[0],
      'price' => get_field('price'),
      'sizes' => get_field('clothes_sizes')
    ));
  endforeach;

  echo json_encode($results);
  die();

}

// get order number from database
add_action( 'wp_ajax_nopriv_getOrderNumber', 'getOrderNumber' );
add_action( 'wp_ajax_getOrderNumber', 'getOrderNumber' );

function getOrderNumber() {
  global $wpdb;
  $orderNumber = $wpdb->get_results( "SELECT * FROM custom_table WHERE id = 1", OBJECT );
  echo $orderNumber[0]->order_number;
  die();
}

// set order number to database
add_action( 'wp_ajax_nopriv_setOrderNumber', 'setOrderNumber' );
add_action( 'wp_ajax_setOrderNumber', 'setOrderNumber' );

function setOrderNumber() {

  global $wpdb;
  $wpdb->update( 
      'custom_table', 
      array( 
        'order_number' => $_POST['orderNumber'],
      ), 
      array( 'id' => 1 ), 
      array( 
        '%d'
      ), 
      array( '%d' ) 
    );
  
  // create order page
  $args = array(
    'post_type' => 'page', 
    'post_title'    => 'order-' .$_POST['orderNumber'], 
    'post_content'  => $_POST['orderNumber'],
    'post_status'   => 'publish',
    'post_author'   => 1 //The author, 1 is generally the ID of the site creator
  );

  $page['id'] =  wp_insert_post( $args );
  $page['link'] = get_permalink($page['id']);

  echo json_encode($page);

  die();
}

// detele current after-order page
add_action( 'wp_ajax_nopriv_deleteCurrentPage', 'deleteCurrentPage' );
add_action( 'wp_ajax_deleteCurrentPage', 'deleteCurrentPage' );

function deleteCurrentPage() {

  wp_delete_post($_POST['id'], true);

  echo 'page is deleted';

  die();
}

// get sorted items
add_action( 'wp_ajax_nopriv_getSortedItems', 'getSortedItems' );
add_action( 'wp_ajax_getSortedItems', 'getSortedItems' );

function getSortedItems() {

  $results = array(
    'clothes' => array(),
    'archive' => true
  );

  if (!$_POST['colors']) {
    $metaQuery = array('relation' => 'AND', 
      array (
        'key' => 'related_color_item',
        'value' => '0',
        'compare' => '==',
      )
    );
  } else {
    $metaQuery = array('relation' => 'AND', 
      array (
        'key' => 'related_color_item',
        'compare' => 'EXISTS',
      )
    );
  }

  $args = array(
    'post_type' => 'clothes',
    'posts_per_page'=> 4,
    'order' => $_POST['order'],
  );

  if ($_POST['offset'])
    $args['offset'] = $_POST['offset'];

  // sorting by price
  if ($_POST['metaKey'] == 'price') {
    $args['meta_key'] = 'price';
    $args['orderby'] = 'meta_value_num';
    array_push($metaQuery, array (
      'key' => 'price',
      'compare' => 'EXISTS',
    ));

  }

  if ($_POST['category']) {
    $args['cat'] = $_POST['category'];
    $results['archive'] = false;
  }

  // filter by sizes
  if ($_POST['sizes']) {
    $requiredSizes = $_POST['sizes'];
    $metaQuerySizes = array('relation' => 'OR');
    foreach( $requiredSizes as $item ){
      $metaQuerySizes[] = array(
          'key'     => 'clothes_sizes',
          'value'   => $item,
          'compare' => 'LIKE',
      );
    }
    array_push($metaQuery, $metaQuerySizes);
  }

  // filter by colors
  if ($_POST['colors']) {
    $requiredColors = $_POST['colors'];
    $metaQueryColors = array('relation' => 'OR');
    foreach( $requiredColors as $item ){
      $metaQueryColors[] = array(
          'key'     => 'color',
          'value'   => $item,
          'compare' => 'LIKE',
      );
    }
    array_push($metaQuery, $metaQueryColors);
  }

  // filter by price
  if ($_POST['price']) {
    $requiredPrice = $_POST['price'];
    $metaQueryPrice= array('relation' => 'AND');
    $metaQueryPrice[] = array(
        'key'     => 'price',
        'value'   => $requiredPrice[0],
        'compare' => '>=',
        'type'    => 'NUMERIC'
    );
    $metaQueryPrice[] = array(
        'key'     => 'price',
        'value'   => $requiredPrice[1],
        'compare' => '<=',
        'type'    => 'NUMERIC'
    );
    array_push($metaQuery, $metaQueryPrice);
  }

  $args['meta_query'] = $metaQuery;

  $the_query = new WP_Query($args); 

  while($the_query->have_posts()) {
    $the_query->the_post();

    if (get_post_type() == 'clothes') {
      $id = acf_photo_gallery('gallery', get_the_ID() )[0]['id'];
      array_push($results['clothes'], array(
        'id' => get_the_ID(),
        'title' =>mb_strimwidth(get_the_title(), 0, 22, '...'),
        'link' => get_the_permalink(),
        'image' => wp_get_attachment_image_src( $id, 'medium' )[0],
        'price' => get_field('price'),
        'sizes' => get_field('clothes_sizes')
      ));
    }

  }

  echo json_encode($results);
  die();
}

// add current-cat class to category list
function tax_cat_active($output, $args) {
    if (is_single()) {
        global $post;
        $terms = get_the_terms($post->ID, 'category');
        if (!empty($terms)) {
            foreach( $terms as $term )
                if ( preg_match( '#cat-item-' . $term ->term_id . '#', $output ) )
                    $output = str_replace('cat-item-'.$term ->term_id, 'cat-item-'.$term ->term_id . ' current-cat', $output);
        }
    }
    return $output;
}
add_filter('wp_list_categories', 'tax_cat_active', 10, 2); 

// login/registration page
add_action('login_enqueue_scripts', 'loginCss');

function loginCss() {
  wp_enqueue_style( 'shop-main-stylesheet', get_stylesheet_uri(), NULL, microtime() );
}

add_filter('login_headerurl', 'ourHeaderUrl');

function ourHeaderUrl() {
  return esc_url(site_url('/'));
}

// UI for subscribers
add_action('admin_init', 'redirectSubscriber');

function redirectSubscriber() {
  $currentUser = wp_get_current_user();
  if (count($currentUser->roles) == 1 AND !defined('DOING_AJAX') AND $currentUser->roles[0] == 'subscriber') {
    wp_redirect( get_site_url('/') );
    exit;
  }
}

add_action('wp_loaded', 'noAdminbarForSubscribers');

function noAdminbarForSubscribers() {
  $currentUser = wp_get_current_user();
  if (count($currentUser->roles) == 1 AND $currentUser->roles[0] == 'subscriber') {
    show_admin_bar( false );
  }
}

// redirect user to main page after log out
add_action('wp_logout','auto_redirect_after_logout');

function auto_redirect_after_logout(){
  wp_redirect( home_url() );
  exit();
}

// change size of login with fb button
add_filter('flp/button/size',function(){ return 'medium';});

?>