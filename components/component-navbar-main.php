
<nav class="navbar navbar-expand-lg navbar-light">
  <a class="navbar-brand" href=" <?php echo get_site_url(); ?> ">
  <img class="lazy" data-src="<?php echo get_theme_file_uri('/img/logo.png')  ?>" class="img-fluid">
  </a>

  <span class="navbar__feature navbar__feature--cart navbar__cart">
    <a href="<?php echo esc_url( site_url( '/cart' ) ); ?>"><i class="fas fa-shopping-bag"></i>
      <span></span>
    </a>
  </span>

  <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#NavBarMain" aria-controls="NavBarMain"
      aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="NavBarMain">
    <ul class="navbar-nav mr-auto ml-auto mt-2 mt-lg-0">

      <!-- categories -->
      <li class="nav-item nav-item--expandable">
        <a class="nav-link" href="<?php echo site_url('/clothes'); ?>">Каталог</a>

        <div class="container-fluid expandable expandable-catalog">
          <div class="container">
            <div class="row">

              <div class="col-md-8 expandable-catalog__categories">
                <ul class="categories"> 
                   <?php  wp_list_categories( array(
                      'orderby' => 'name',
                      'post_type' => 'clothes', 
                      'include' => array( 23, 24, 25 ),
                      'title_li' => '',
                    ) ) ?>
                </ul>

                <ul class="categories">
                   <?php  wp_list_categories( array(
                      'orderby' => 'name',
                      'post_type' => 'clothes', 
                      'exclude' => array( 1, 23, 24, 25 ),
                      'title_li' => '',
                    ) ) ?>
                </ul>
                
              </div>
              <div class="col-md-4 expandable-catalog__aside">
                <div class="expandable-catalog__image"></div>
              </div>

            </div>
          </div>
        </div>

      </li>

      <!-- information -->
      <li class="nav-item nav-item--expandable">
        <a class="nav-link" href="<?php echo site_url('/information/') ?>">Информация</a>

        <div class="container-fluid expandable expandable-help">
          <div class="container">
            <div class="row">

              <div class="col-md-5 expandable-help__menu">

                <!-- navigation pills -->
                <ul class="nav nav-pills thanks__info mb-3" id="pills-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="menu-pills-payment-tab" data-toggle="pill" href="#menu-pills-payment" role="tab" aria-controls="menu-pills-payment" aria-selected="true">Оплата</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="menu-pills-delivery-tab" data-toggle="pill" href="#menu-pills-delivery" role="tab" aria-controls="menu-pills-delivery" aria-selected="false">Доставка</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="menu-pills-refund-tab" data-toggle="pill" href="#menu-pills-refund" role="tab" aria-controls="menu-pills-refund" aria-selected="false">Возврат</a>
                  </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                  <div class="tab-pane fade show active" id="menu-pills-payment" role="tabpanel" aria-labelledby="menu-pills-payment-tab">
                      <span>
                        Оплатить Ваш заказ можно переводом на карту ПриватБанка. После оформления и подтверждения заказа номер карты будет указан в SMS.
                      </span><br>
                      <span>
                        Также вы можете воспользоваться удобными платежными online сервисами <a target="_blank" href="https://privatbank.ua/sendmoney?payment=bb38a94ba66c092435dfa1ac858a82200efb3b90">SendMoney</a> или <a target="_blank" href="https://www.ipay.ua/ru/p2p/default/constructor/48ded373f9946267c806bf1813ed995d">IPay</a>.
                      </span><br>
                      <span>
                        После оплаты, обязательно сообщите нам об этом (на любой контактный номер или с помощью <a data-fancybox href="#ModalPaymentReport">формы</a>).
                      </span>

                  </div>
                  <div class="tab-pane fade" id="menu-pills-delivery" role="tabpanel" aria-labelledby="menu-pills-delivery-tab">
                    <span>
                      Доставка по Украине абсолютно бесплатная до 5 рабочих дней. Задержки могут быть только в выходные и праздничные дни.
                      <div class="expandable-help__delivery">
                      <div class="expandable-help__delivery-item">
                        <span>Новая почта</span>
                        <img class="lazy" style="padding: 8px 0" data-src="<?php echo get_theme_file_uri('/img/delivery/delivery-novaposhta.svg') ?>" alt="">
                      </div>
                      <div class="expandable-help__delivery-item">
                        <span>Интайм</span>
                        <img class="lazy" data-src="<?php echo get_theme_file_uri('/img/delivery/delivery-intaim.svg') ?>" alt="">
                      </div>
                      <div class="expandable-help__delivery-item">
                        <span>Укр почта</span>
                        <img class="lazy" data-src="<?php echo get_theme_file_uri('/img/delivery/delivery-urkpochta.svg') ?>" alt="">
                      </div>

                    </div>
                    </span>
                  </div>
                  <div class="tab-pane fade" id="menu-pills-refund" role="tabpanel" aria-labelledby="menu-pills-refund-tab">
                    <span>
                      В течение 14 дней Вы можете осуществить возврат любых товаров, которые Вам не подошли, при условии сохранения товарного вида.
                    </span>
                  </div>
                </div>
              </div>

              <div class="col-md-4 expandable-help__contacts">
                <div class="expandable-help__phones">
                  <ul>
                    <li>
                      <a href="tel:+380992607480"> +38 (099) 260 74 80 </a>
                      <span class="expandable-help__mobile-icon expandable-help__mobile-icon--vadafon lazy" data-bg="url(' <?php echo get_theme_file_uri('/img/mobile-logo/mobile-logo-Vodafon.png') ?> ')"></span>
                      <span class="expandable-help__mobile-icon expandable-help__mobile-icon--viber lazy" data-bg="url(' <?php echo get_theme_file_uri('/img/mobile-logo/mobile-logo-Viber.png') ?> ')"></span>
                      <span class="expandable-help__mobile-icon expandable-help__mobile-icon--telegram lazy" data-bg="url(' <?php echo get_theme_file_uri('/img/mobile-logo/mobile-logo-Telegram.png') ?> ')"></span>
                    </li>
                    <li>
                      <a href="tel:+380635234764"> +38 (063) 523 47 64 </a>
                      <span class="expandable-help__mobile-icon expandable-help__mobile-icon--lifecell lazy" data-bg="url(' <?php echo get_theme_file_uri('/img/mobile-logo/mobile-logo-Lifecell.png') ?> ')"></span>
                    </li>
                    <li>
                      <a href="tel:+380688199673"> +38 (068) 819 96 73 </a>
                      <span class="expandable-help__mobile-icon expandable-help__mobile-icon--kyivstar lazy" data-bg="url(' <?php echo get_theme_file_uri('/img/mobile-logo/mobile-logo-Kyivstar.png') ?> ')"></span>
                    </li>
                  </ul>
                </div>
              </div>

              <div class="col-md-3 expandable-help__feedback">
                <a data-fancybox href="#ModalFeedback" class="btn btn--default fancybox-no-touch">Заказать обратный звонок</a>
                <a data-fancybox href="#ModalQuestion" class="btn btn--default fancybox-no-touch">Задать вопрос</a>
                <a data-fancybox href="#ModalPaymentReport" class="btn btn--default fancybox-no-touch">Сообщить об оплате</a>
              </div>

            </div>
          </div>
        </div>

      </li>
      
      <li class="nav-item">
        <a href="<?php echo site_url( '/blog' ) ?>" class="nav-link">Блог</a>
      </li>

    </ul>
    
    <ul class="navbar__features">
      
      <li class="navbar__feature navbar__feature--cart"><a href="<?php echo esc_url( site_url( '/cart' ) ); ?>"><i class="fas fa-shopping-bag"></i><span></span></a></li>
      <li class="navbar__feature navbar__feature--search"><i class="fas fa-search"></i></li>
      <?php
        if (is_user_logged_in()) { ?>
          <li class="navbar__feature"><a href="<?php echo site_url('/private-office') ?>">Личный кабинет</a></li>
          <li class="navbar__feature"><a href="<?php echo wp_logout_url(); ?>">Выйти</a></li>
      <?php } else { ?>
          <li class="navbar__feature lrm-login">Войти</li>
      <?php }  ?>
    </ul>

  </div>

  
    
</nav>

