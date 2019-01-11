<!-- template for after order page -->

<?php get_header(); ?>
<?php get_template_part( 'components/component', 'navbar-main' ); ?>

<?php 
  the_post();
  $id = get_the_ID(); 
?>

<section class="thanks section--page">

  <div class="container">
    <div class="row">
      <div class="offset-md-2 col-md-8">
        <h3>Спасибо!</h3>
        <p>Ваш заказ №<span class="thanks__order-number"><?php echo get_the_content() ?></span> успешно оформлен!</p>
        <p>Мы свяжемся с вами в ближайшее время для подтверждения.</p>
     
    
        <ul class="nav nav-pills thanks__info mb-3" id="pills-tab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="pills-payment-tab" data-toggle="pill" href="#pills-payment" role="tab" aria-controls="pills-payment" aria-selected="true">Оплата</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-delivery-tab" data-toggle="pill" href="#pills-delivery" role="tab" aria-controls="pills-delivery" aria-selected="false">Доставка</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-refund-tab" data-toggle="pill" href="#pills-refund" role="tab" aria-controls="pills-refund" aria-selected="false">Возврат</a>
          </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade show active" id="pills-payment" role="tabpanel" aria-labelledby="pills-home-tab">
              <span>
                Оплатить Ваш заказ можно переводом на карту ПриватБанка. После оформления и подтверждения заказа номер карты будет указан в SMS.
              </span> 
              <span>
                Также вы можете воспользоваться удобными платежными online сервисами <a target="_blank" href="https://privatbank.ua/sendmoney?payment=bb38a94ba66c092435dfa1ac858a82200efb3b90">SendMoney</a> или <a target="_blank" href="https://www.ipay.ua/ru/p2p/default/constructor/48ded373f9946267c806bf1813ed995d">IPay</a>.
              </span>

              <div class="thanks__payment">
                <a target='_blank' href="https://privatbank.ua/sendmoney?payment=bb38a94ba66c092435dfa1ac858a82200efb3b90" class="btn btn--green">Оплатить через SendMoney</a>
                <a target='_blank' href="https://www.ipay.ua/ru/p2p/default/constructor/48ded373f9946267c806bf1813ed995d" class="btn btn--green">Оплатить через IPay</a>
              </div>

              <span>
                После оплаты, обязательно сообщите нам об этом (на любой контактный номер или с помощью <a data-fancybox href="#ModalPaymentReport">формы</a>).
              </span>

          </div>
          <div class="tab-pane fade" id="pills-delivery" role="tabpanel" aria-labelledby="pills-delivery-tab">
            <span>
              Доставка по Украине абсолютно бесплатная до 5 рабочих дней. Задержки могут быть только в выходные и праздничные дни.
            </span>
          </div>
          <div class="tab-pane fade" id="pills-refund" role="tabpanel" aria-labelledby="pills-refund-tab">
            <span>
              В течение 14 дней Вы можете осуществить возврат любых товаров, которые Вам не подошли, при условии сохранения товарного вида.
            </span>
          </div>
        </div>

        <div class="thanks__go-shopping">
          <a href="<?php echo site_url('/clothes/') ?>" class="btn btn--black">Продолжить покупки</a>
        </div>

      </div>

    </div>
  </div>

</section>

<?php get_footer(); ?>

<script>
  $(function() {
    
    // delete current page
    setTimeout(() => {
      let data = {
        action: 'deleteCurrentPage',
        id: <?php echo $id ?>
      }

      $.post(shopData.admin_ajax, data, function (result) {

        console.log(result);

      });
    }, 1000);

  })
</script>
