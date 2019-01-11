<?php get_header(); ?>
<?php get_template_part( 'components/component', 'navbar-main' ); ?>

<section class="cart section--page">

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h3 class="headline">Корзина</h3>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">

      <!-- cart content -->
      <div class="col-lg-5">
        <div class="cart__items"></div>
        <div class="cart__buttons">
          <a class="btn btn--black cart__go-shopping" href="<?php echo site_url('/clothes/') ?>">К покупкам</a>
          <button class="btn btn--green clean-cookies">Очистить корзину</button>
        </div>
      </div>

      <!-- order -->
      <div class="col-lg-6 offset-lg-1 cart__order">

      <?php
          $name = $email = $tel = $delivery = $city = $office = $id = '';
          if (is_user_logged_in()) {
            $personalData = new WP_Query( array(
              'post_type' => 'PersonalData',
              'posts_per_page' => 1,
              'author' => get_current_user_id()
            )); 

            if ($personalData->have_posts()) {
              while($personalData->have_posts()) {
                $personalData->the_post();
                $id = get_the_ID();
                $name = get_field('user_name');
                $email = get_field('user_email');
                $tel = get_field('user_tel');
                $delivery = get_field('user_delivery_service');
                $city = get_field('user_city');
                $office = get_field('user_delivery_office');
              }
            }
          }
          
        ?>

        <form id="CartOrder">

          <div class="cart__contacts">
            <span class="form-title">Контактные данные</span>
            <div class="form-row">
              <div class="form-group col-md-12">
                <label>ФИО*</label>
                <input type="text" name='name' class="form-control" value="<?php echo $name; ?>" >
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Эл. почта*</label>
                <input type="email" name='email' class="form-control" value="<?php echo $email; ?>">
              </div>
              <div class="form-group col-md-6">
                <label>Телефон*</label>
                <input type="tel" name='tel' class="form-control" value="<?php echo $tel ?>">
              </div>
            </div>
          </div>

          <div class="cart__delivery">
            <span class="form-title">Адрес доставки</span>
            <label>Служба доставки*</label>
            <div class="form-group">
              <select name='delivery' class="form-control">
                <option value='Новая почта' selected>Новая почта</option>
                <option value='Интайм'>Интайм</option>
                <option value='Укр почта'>Укр почта</option>
              </select>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Город*</label>
                <input type="text" name='city' class="form-control" value="<?php echo $city; ?>" placeholder="">
              </div>
              <div class="form-group col-md-6">
                <label>Номер отделения*</label>
                <input type="tel" name="office" class="form-control" value="<?php echo $office; ?>">
              </div>
            </div>
              
          </div>

          <button type="submit" class="btn btn--black">Оформить заказ</button>
          <div class="cart__form-loader"></div>

        </form>

      </div>
    </div>
  </div>

</section>

<?php get_footer(); ?>

<script>
  <?php if (is_user_logged_in() && $delivery != '') { ?>
    $("select[name=delivery]").val('<?php echo $delivery ?>');
  <?php } ?>
</script>