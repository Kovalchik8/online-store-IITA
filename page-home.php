<?php get_header(); ?>

<?php get_template_part( 'components/component', 'navbar-main' ); ?>

<!-- banner -->
<header class="header" id="Header">
  <div class="header__content">

    <h3 class="header__title">Наши преимущества</h3>

    <div class="header__advantages">
      <div class="header__advantage"> Бесплатная доставка</div> <div class="header__separator"></div>
      <div class="header__advantage"> Скидка 10% на заказ свыше 3 единиц</div> <div class="header__separator"></div>
      <div class="header__advantage"> Возврат в течение 14 дней</div>
    </div>

    <a class="btn btn--black" href="<?php echo site_url('/clothes') ?>">К покупкам <i class="fas fa-caret-right"></i></a>

  </div>
</header>

<!-- section new-collection -->
<section style="border-top: none;"  class="section-slider" id="NewCollection">

  <div class="container slider-header">
    <div class="row">
      <div class="col-md-6 slider-header__title">
        <div class="slider-header__name">Новинки</div>
      </div>
      <div class="col-md-6 slider-header__view-all">
        <?php 
          $category_id = get_cat_ID( 'Новинки' );
          $category_link = get_category_link( $category_id );
        ?>
        <a href="<?php echo $category_link ?>">смотреть все <i class="fas fa-long-arrow-alt-right"></i></a>
      </div>
    </div>
  </div>

  <?php slickByCategory('Новинки'); ?>

</section>

<!-- section recommended -->
<section class="recommended section-slider" id="Recommended">

  <div class="container slider-header">
    <div class="row">
      <div class="col-md-6 slider-header__title">
        <div class="slider-header__name">Рекомендуемые</div>
      </div>
      <div class="col-md-6 slider-header__view-all">
        <?php 
          $category_id = get_cat_ID( 'Рекомендуемые' );
          $category_link = get_category_link( $category_id );
        ?>
        <a href="<?php echo $category_link ?>">смотреть все <i class="fas fa-long-arrow-alt-right"></i></a>
      </div>
    </div>
  </div>

  <?php slickByCategory('Рекомендуемые'); ?>

</section>

<!-- section bestsellers -->
<section class="bestsellers section-slider" id="Bestsellers">

  <div class="container slider-header">
    <div class="row">
      <div class="col-md-6 slider-header__title">
        <div class="slider-header__name">Хиты продаж</div>
      </div>
      <div class="col-md-6 slider-header__view-all">
        <?php 
          $category_id = get_cat_ID( 'Хиты продаж' );
          $category_link = get_category_link( $category_id );
        ?>
        <a href="<?php echo $category_link ?>">смотреть все <i class="fas fa-long-arrow-alt-right"></i></a>
      </div>
    </div>
  </div>

  <?php slickByCategory('Хиты продаж'); ?>

</section>

<!-- section blog -->
<section class="blog" id="Blog">

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h3 class="headline">Блог IITA</h3>
      </div>
    </div>
  </div>

  <?php get_template_part( 'components/component', 'slick-blog' ) ?>

</section>

<?php get_footer(); ?> 