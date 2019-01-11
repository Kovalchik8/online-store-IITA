<?php get_header(); ?>
<?php get_template_part( 'components/component', 'navbar-main' ); ?>

<section class="information section--page">

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h3 class="headline">Информация</h3>
        <p></p>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">

        <!-- payment -->
        <div class="information__feature col-lg-4"> 
          <i class="fas fa-money-bill-alt"></i>
          <h3>Оплата</h3>
          <span>
            Оплатить Ваш заказ можно переводом на карту ПриватБанка. После оформления и подтверждения заказа номер карты будет указан в SMS.
          </span>
          <span>
            Также вы можете воспользоваться удобными платежными online сервисами <a target="_blank" href="https://privatbank.ua/sendmoney?payment=bb38a94ba66c092435dfa1ac858a82200efb3b90">SendMoney</a> или <a target="_blank" href="https://www.ipay.ua/ru/p2p/default/constructor/48ded373f9946267c806bf1813ed995d">IPay</a>.
          </span>
          <span>
            После оплаты, обязательно сообщите нам об этом (на любой контактный номер или с помощью <a data-fancybox href="#ModalPaymentReport">формы</a>).
          </span>
        </div>

        <!-- delivery -->
        <div class="information__feature col-lg-4">
          <i class="fas fa-truck"></i>
          <h3>Доставка</h3>
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

        <!-- repayment -->
        <div class="information__feature col-lg-4">
          <i class="fas fa-undo"></i>
          <h3>Возврат</h3>
          <span>
            В течение 14 дней Вы можете осуществить возврат любых товаров, которые Вам не подошли, при условии сохранения товарного вида.
          </span>
        </div>
        
      </div>

      <div class="row">

        <!-- modals with forms -->
        <div class="col-lg-6 information__feedback">
          <div class="expandable-help__feedback">
            <a data-fancybox href="#ModalFeedback" class="btn btn--default fancybox-no-touch">Заказать обратный звонок</a>
            <a data-fancybox href="#ModalQuestion" class="btn btn--default fancybox-no-touch">Задать вопрос</a>
            <a data-fancybox href="#ModalPaymentReport" class="btn btn--default fancybox-no-touch">Сообщить об оплате</a>
          </div>
        </div>

        <!-- contacts -->
        <div class="col-lg-6 information__contacts">
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

      </div>

    </div>
  </div>

</section>

<?php get_footer(); ?>