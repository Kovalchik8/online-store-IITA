
<?php get_header(); ?>
<?php get_template_part( 'components/component', 'navbar-main' ); ?>
<?php the_post(); ?>

<section class="product-single section--no-border" >

  <div class="container">
    <div class="row">

      <div class="col-lg-2 col-4 product-single__images">

      <?php  $images = acf_photo_gallery('gallery', get_the_ID() );
      if ($images) {
        $id_first = $images[0]['id'];
        $first_image_url = $images[0]['full_image_url']; ?>
        
        <div class="product-single__slick">

        <?php  foreach($images as $image) {
            $id = $image['id'];
            $url = wp_get_attachment_image_src( $id, 'medium' )[0];
            $full_image_url= $image['full_image_url']; ?>

            <a href="<?php echo $full_image_url ?>" data-fancybox="images">
              <img class="img-fluid" src="<?php echo $url ?>" />
            </a>

         <?php } }?>

        </div>
        
      </div>
    
      <div class="col-lg-6 col-8 product-single__image-main">
        <a href="javascript:;" data-fancybox-trigger="images">
          <img class="img-fluid" srcset="<?php echo $first_image_url ?>, <?php echo wp_get_attachment_image_src( $id_first, 'medium' )[0]; ?> 768w" />
        </a>
      </div>

      <div class="col-lg-4 product-single__desc">
        <div class="product-single__category">
          
          <?php 
            $postcat = get_the_category( $post->ID );
            
            if ( !empty( $postcat ) ) {
              foreach($postcat as $cat) { ?>
                <a href="<?php echo esc_url( get_category_link( $cat->term_id ) ) ?>"><?php echo '#' . esc_html($cat->name ); ?></a>
            <?php } } ?>
            
        </div>
        <?php 
          $label = get_field('top_label');
          if (!empty($label))
          echo '<div class="product-single__label">' . $label . '</div>';
        ?>
        <div class="product-single__name"><?php the_title(); ?></div>
        <div class="product-single__price">
          <div><span><?php echo get_field('price'); ?></span> грн</div>
        </div>
        <div class="product-single__sizes">
          <?php $sizes = get_field('clothes_sizes');
          if ($sizes) {
            $active = false;
            foreach($sizes as $size) { ?>

              <div class="product-single__size <?php if(!$active) {echo 'active'; $active = true;} ?>"><?php echo $size ?></div>

            <?php } }  ?>
        </div>
        <div class="product-single__table">
          <a class="fancybox-no-touch" data-fancybox href="#ModalTableSizes"><i class="fas fa-ruler-horizontal"></i> Таблица размеров</a>
        </div>
        <div class="product-single__quantity">
          <div class="product-single__less">-</div>
          <input type="number" max="999" value="1" class="product-single__number" readonly>
          <div class="product-single__more">+</div>
        </div>

        <div class="product-single__buttons">
          <button class="product-single__in-cart btn btn--black" data-id="<?php echo get_the_ID()?>">В корзину</button>
          <form id="FormBuyOneClick" autocomplete="on">
            <div class="form-group">
              <input name="name" type="text" class="form-control" placeholder="Ваше имя*" required>
            </div>
            <div class="form-group">
              <input name="tel" type="tel" class="form-control" placeholder="Телефон" value="+380" required>
            </div>
          </form>
          <button class="product-single__buy-one-click btn btn--green">Купить в один клик</button>
          <div class="product-single__loader"></div>
        </div>

        <div class="product-single__terms">
           <div class="accordion" id="AccordionProductTerms">

            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#TermsCollapseOne" aria-expanded="true" aria-controls="TermsCollapseOne">
              Оплата <i class="fas fa-caret-down"></i>
            </button>

            <div id="TermsCollapseOne" class="collapse show expandable-help__menu-text" aria-labelledby="headingOne" data-parent="#AccordionProductTerms">
              Оплатить Ваш заказ можно переводом на карту ПриватБанка. После оформления и подтверждения заказа номер карты будет указан в SMS. <br>
              Также вы можете воспользоваться удобными платежными online сервисами <a target="_blank" href="https://privatbank.ua/sendmoney?payment=bb38a94ba66c092435dfa1ac858a82200efb3b90">SendMoney</a> или <a target="_blank" href="https://www.ipay.ua/ru/p2p/default/constructor/48ded373f9946267c806bf1813ed995d">IPay</a>.<br>
              После оплаты, обязательно сообщите нам об этом (на любой контактный номер или с помощью <a data-fancybox href="#ModalPaymentReport">формы</a>).
            </div>

            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#TermsCollapseTwo" aria-expanded="false" aria-controls="TermsCollapseTwo">
              Доставка <i class="fas fa-caret-down"></i>
            </button>

            <div id="TermsCollapseTwo" class="collapse expandable-help__menu-text" aria-labelledby="headingOne" data-parent="#AccordionProductTerms">
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
            </div>

            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#TermsCollapseThree" aria-expanded="false" aria-controls="TermsCollapseThree">
              Возврат <i class="fas fa-caret-down"></i>
            </button>

            <div id="TermsCollapseThree" class="collapse expandable-help__menu-text" aria-labelledby="headingOne" data-parent="#AccordionProductTerms">
              В течение 14 дней Вы можете осуществить возврат любых товаров, которые Вам не подошли, при условии сохранения товарного вида.
            </div>

          </div>
        </div>

        <!-- related colors -->
				<?php $relatedColors = get_field('related_colors');
				if ($relatedColors): ?>
					<div class="product-single__related">
						<div class="product-single__related-title">Другие цвета</div>
							<div class="product-single__related-items">
              <?php foreach($relatedColors as $item): 
                $id = acf_photo_gallery('gallery', $item->ID )[0]['id'];
                $firstImageUrl = wp_get_attachment_image_src( $id, 'medium' )[0];
							?>

								<div class="product-singled__reltated-item">
									<a href="<?php the_permalink( $item ); ?>">
										<img class="img-fluid lazy" src="<?php echo $firstImageUrl ?>" />
									</a>
								</div>

							<?php endforeach; ?>
							</div>
						</div>
				<?php endif; ?>

      </div>
  
    </div>
  </div>

  <div class="container product-info">
    <div class="row">
      <div class="col-lg-6 product-info__review">
        <?php $content = get_the_content(); 
        if (!empty($content)) {
         echo '<h3 class="product-info__title headline headline--product-info">Описание</h3>';
        echo $content; 
        } ?>

        </div>
        <div class="col-lg-6 product-info__parameters">
          <div class="product-info__table">
          <?php $desc = get_field('desc');
          if (!empty($desc)) {
            echo '<h3 class="product-info__title headline headline--product-info">Характеристики</h3>';
            echo $desc;
          } ?>
        </div>
      </div>
    </div>
</div>

</section>

<?php get_footer(); ?>