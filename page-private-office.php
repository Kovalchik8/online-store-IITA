<?php 
  if(!is_user_logged_in()) {
    wp_redirect( esc_url( site_url( '/' ) ) );
  }
?>
<?php get_header(); ?>
<?php get_template_part( 'components/component', 'navbar-main' ); ?>

<section class="office section--page">

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h3 class="headline">Личный кабинет</h3>
        <p class="headline-sign">Здесь Вы можете оставить свои личные данные. Это ускорит процесс оформления заказа.</p>
        <p></p>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">

      <!-- private data -->
      <div class="offset-md-1 col-md-5">

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

        <form class="office__form" data-id="<?php echo $id ?>" autocomplete='off'>

          <div class="cart__contacts">
            <span class="form-title">Контактные данные</span>
            <div class="form-row">
              <div class="form-group col-md-12">
                <label>ФИО*</label>
                <input type="text" name='name' class="form-control" value="<?php echo $name ?>" readonly>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Эл. почта*</label>
                <input type="email" name='email' class="form-control" value="<?php echo $email ?>" readonly>
              </div>
              <div class="form-group col-md-6">
                <label>Телефон*</label>
                <input type="tel" name='tel' class="form-control" value="<?php echo $tel ?>" readonly>
              </div>
            </div>
          </div>

          <div class="cart__delivery">
            <span class="form-title">Адрес доставки</span>
            <label>Служба доставки*</label>
            <div class="form-group">
              <select name='delivery' class="form-control" disabled>
                <option value='Новая почта'>Новая почта</option>
                <option value='Интайм'>Интайм</option>
                <option value='Укр почта'>Укр почта</option>
              </select>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Город*</label>
                <input type="text" name='city' class="form-control" placeholder="" value="<?php echo $city ?>" readonly>
              </div>
              <div class="form-group col-md-6">
                <label>Номер отделения*</label>
                <input type="tel" name="office" class="form-control" value="<?php echo $office ?>" readonly>
              </div>
            </div>
              
          </div>
          
        </form>

        <div class="office__buttons">
          <button class="btn btn--black office__edit">Редактировать</button>
          <button class="btn btn--black office__save">Сохранить</button>
          <button class="btn btn--black office__cancel">Отмена</button>
        </div>

      </div>
      
      <!-- rules -->
      <div class="col-md-4">
        <div class="product-single__terms">
           <div class="accordion" id="AccordionProductTerms">

            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#TermsCollapseOne" aria-expanded="true" aria-controls="TermsCollapseOne">
              Оплата <i class="fas fa-caret-down"></i>
            </button>

            <div id="TermsCollapseOne" class="collapse show expandable-help__menu-text" aria-labelledby="headingOne" data-parent="#AccordionProductTerms">
              Оплатить Ваш заказ можно переводом на карту ПриватБанка. После оформления и подтверждения заказа номер карты будет указан в SMS. <br>
              Также вы можете воспользоваться удобными платежными online сервисами <a target="_blank" href="https://privatbank.ua/sendmoney?payment=bb38a94ba66c092435dfa1ac858a82200efb3b90">SendMoney</a> или <a target="_blank" href="https://www.ipay.ua/ru/p2p/default/constructor/48ded373f9946267c806bf1813ed995d">IPay</a>.<br>
              После оплаты, обязательно сообщите нам об этом (на любой контактный номер или с помощью <a data-fancybox href="#ModalPaymentReport">формы</a> ).
            </div>

            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#TermsCollapseTwo" aria-expanded="false" aria-controls="TermsCollapseTwo">
              Доставка <i class="fas fa-caret-down"></i>
            </button>

            <div id="TermsCollapseTwo" class="collapse expandable-help__menu-text" aria-labelledby="headingOne" data-parent="#AccordionProductTerms">
              Доставка по Украине абсолютно бесплатная до 5 рабочих дней. Задержки могут быть только в выходные и праздничные дни.
              <div class="expandable-help__delivery">
                <div class="expandable-help__delivery-item">
                  <span>Новая почта</span>
                  <img style="padding: 8px 0" src="<?php echo get_theme_file_uri('/img/delivery/delivery-novaposhta.svg') ?>" alt="">
                </div>
                <div class="expandable-help__delivery-item">
                  <span>Интайм</span>
                  <img src="<?php echo get_theme_file_uri('/img/delivery/delivery-intaim.svg') ?>" alt="">
                </div>
                <div class="expandable-help__delivery-item">
                  <span>Укр почта</span>
                  <img src="<?php echo get_theme_file_uri('/img/delivery/delivery-urkpochta.svg') ?>" alt="">
                </div>

              </div>
            </div>

            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#TermsCollapseThree" aria-expanded="false" aria-controls="TermsCollapseThree">
              Возврат <i class="fas fa-caret-down"></i>
            </button>

            <div id="TermsCollapseThree" class="collapse expandable-help__menu-text" aria-labelledby="headingOne" data-parent="#AccordionProductTerms">
              В течение 14 дней Вы можете осуществить возврат любых товаров, которые Вам не подошли, при условии сохранения товарного вида.
            </div>

          </div>
        </div>
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