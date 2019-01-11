<div class="col-lg-2 filters">
  
  <div class="filters__close">
    <i class="fas fa-long-arrow-alt-right"></i>
  </div>

  <div class="sorting sorting--mobile">
    <span class="sorting__sign">Сортировать по:</span>
    <span class="sorting__btn sorting__price">цене </span> <span class="sorting__curret sorting__curret--price"></span>
    <span class="sorting__btn sorting__date">дате </span> <span class="sorting__curret sorting__curret--date"></span>
  </div>
  
  <ul class="categories">
    <?php 
      (is_category() ) ? $active = '' : $active = 'active'; 
      (is_category('Новинки') ) ? $currentCatNew = 'current-cat' : $currentCatNew = ''; 
      (is_category('Хиты продаж') ) ? $currentCatHit = 'current-cat' : $currentCatHit = ''; 
      (is_category('Рекомендуемые') ) ? $currentCatRecommend = 'current-cat' : $currentCatRecommend = ''; 
    ?>
    <a href="<?php echo site_url( '/clothes/' ) ?>" class="categories__catalog <?php echo $active ?>">Каталог</a>
    <li class="cat-item cat-item-23 <?php echo $currentCatNew ?>">
      <a href="<?php echo get_category_link(23) ?>">Новинки</a>
    </li>
    <li class="cat-item cat-item-25 <?php echo $currentCatHit ?>">
      <a href="<?php echo get_category_link(25) ?>">Хиты продаж</a>
    </li>
    <li class="cat-item cat-item-24 <?php echo $currentCatRecommend ?>">
      <a href="<?php echo get_category_link(24) ?>">Рекомендуемые</a>
    </li>
    <?php  wp_list_categories( array(
      'orderby' => 'name',
      'post_type' => 'clothes', 
      'exclude'  => array( 1, 23, 25, 24 ),
      'title_li' => '',
    ) ) ?>
  </ul>

  <!-- price -->
  <div class="filters__title filters__title--price">Цена <span>(грн)</span></div>
  <div class="filters__price-header">
    <input type="text" id="amount" readonly style="border:0">
    <button class="btn btn--default btn--small">Ок</button>
  </div>
  
  <div id="slider-range"></div>

  <!-- sizes -->
  <div class="filters__title">Размер</div>
  <div class="filters__sizes">
    <span class="filters__size">XS</span>
    <span class="filters__size">S</span>
    <span class="filters__size">M</span>
    <span class="filters__size">L</span>
    <span class="filters__size">XL</span>
    <span class="filters__size">2XL</span>
    <span class="filters__size">3XL</span>
    <span class="filters__size">4XL</span>
    <span class="filters__size">УН</span> 
  </div>    

  <!-- colors -->
  <div class="filters__title">Цвет</div>
  <div class="filters__colors">
    <span class="filters__color filters__color--black"><span class="square"></span> <span class="color">черный</span> </span>
    <span class="filters__color filters__color--blue"><span class="square"></span> <span class="color">синий</span> </span>
    <span class="filters__color filters__color--white"><span class="square"></span> <span class="color">белый</span> </span>
    <span class="filters__color filters__color--gray"><span class="square"></span> <span class="color">серый</span> </span>
    <span class="filters__color filters__color--beige"><span class="square"></span> <span class="color">бежевый</span> </span>
    <span class="filters__color filters__color--red"><span class="square"></span> <span class="color">красный</span> </span>
    <span class="filters__color filters__color--yellow"><span class="square"></span> <span class="color">желтый</span> </span>
    <span class="filters__color filters__color--green"><span class="square"></span> <span class="color">зеленый</span> </span>
    <span class="filters__color filters__color--violet"><span class="square"></span> <span class="color">фиолетовый</span> </span>
    <span class="filters__color filters__color--orange"><span class="square"></span> <span class="color">оранжевый</span> </span>
    <span class="filters__color filters__color--brown"><span class="square"></span> <span class="color">коричневый</span> </span>
    <span class="filters__color filters__color--pink"><span class="square"></span> <span class="color">розовый</span> </span>
    <span class="filters__color filters__color--sky"><span class="square"></span> <span class="color">голубой</span> </span>
    <span class="filters__color filters__color--multicolor"><span class="square"></span> <span class="color">мультиколор</span> </span>
  </div>

  <!-- reset all filters and sortings -->
  <button class="btn btn--black filters__reset">Сбросить</button>
        
</div>

<ul class="categories categories--mobile">
  <div class="categories__close">
    <i class="fas fa-long-arrow-alt-left"></i>
  </div>
  <?php 
    (is_category() ) ? $active = '' : $active = 'active'; 
    (is_category('Новинки') ) ? $currentCatNew = 'current-cat' : $currentCatNew = ''; 
    (is_category('Хиты продаж') ) ? $currentCatHit = 'current-cat' : $currentCatHit = ''; 
    (is_category('Рекомендуемые') ) ? $currentCatRecommend = 'current-cat' : $currentCatRecommend = ''; 
  ?>
  <a href="<?php echo site_url( '/clothes/' ) ?>" class="categories__catalog <?php echo $active ?>">Вся одежда</a>
  <li class="cat-item cat-item-23 <?php echo $currentCatNew ?>">
    <a href="<?php echo get_category_link(23) ?>">Новинки</a>
  </li>
  <li class="cat-item cat-item-25 <?php echo $currentCatHit ?>">
    <a href="<?php echo get_category_link(25) ?>">Хиты продаж</a>
  </li>
  <li class="cat-item cat-item-24 <?php echo $currentCatRecommend ?>">
    <a href="<?php echo get_category_link(24) ?>">Рекомендуемые</a>
  </li>
  <?php  wp_list_categories( array(
    'orderby' => 'name',
    'post_type' => 'clothes', 
    'exclude'  => array( 1, 23, 25, 24 ),
    'title_li' => '',
  ) ) ?>
</ul>

<div class="col-lg-10">

  <div class="sorting">
    <span class="sorting__sign">Сортировать по:</span>
    <span class="sorting__btn sorting__price">цене </span> <span class="sorting__curret sorting__curret--price"></span>
    <span class="sorting__btn sorting__date">дате </span> <span class="sorting__curret sorting__curret--date"></span>
  </div>

  <div class="catalog-filters">
    <span class="catalog-filters__btn catalog-filters__catalog">Категории </span>
    <span class="catalog-filters__btn catalog-filters__filters">Фильтры <i class="fas fa-filter"></i></span>
  </div>