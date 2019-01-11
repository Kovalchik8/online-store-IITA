    
    <footer class="footer" id="Footer">
    
      <div class="container">
        <div class="row">

          <div class="col-lg-4 col-md-12 footer__about-us footer__item">
            <div class="footer__title">О нас</div>
            <div class="footer__about-us-text">
              Дорогие покупатели, предлагаем Вашему вниманию оптимальную по соотношению цена/качество одежду от украинских производителей. Мы делаем все возможное, чтобы Вы были довольны своими покупками. 
            </div>
          </div>

          <div class="col-lg-4 col-md-6 footer__contacts footer__item">
            <div class="footer__title">Контакты</div>
            <ul>
              <li>
                <a href="tel:+380992607480"> +38 (099) 260 74 80 </a>
                <span class="footer__mobile-icon footer__mobile-icon--vadafon lazy" data-bg="url(' <?php echo get_theme_file_uri('/img/mobile-logo/mobile-logo-Vodafon.png') ?> ')"></span>
                <span class="footer__mobile-icon footer__mobile-icon--viber lazy" data-bg="url(' <?php echo get_theme_file_uri('/img/mobile-logo/mobile-logo-Viber.png') ?> ')"></span>
                <span class="footer__mobile-icon footer__mobile-icon--telegram lazy" data-bg="url(' <?php echo get_theme_file_uri('/img/mobile-logo/mobile-logo-Telegram.png') ?> ')"></span>
              </li>
              <li>
                <a href="tel:+380635234764"> +38 (063) 523 47 64 </a>
                <span class="footer__mobile-icon footer__mobile-icon--lifecell lazy" data-bg="url(' <?php echo get_theme_file_uri('/img/mobile-logo/mobile-logo-Lifecell.png') ?> ')"></span>
                </li>
              <li>
                <a href="tel:+380688199673"> +38 (068) 819 96 73 </a>
                <span class="footer__mobile-icon footer__mobile-icon--kyivstar lazy" data-bg="url(' <?php echo get_theme_file_uri('/img/mobile-logo/mobile-logo-Kyivstar.png') ?> ')"></span>
              </li>
            </ul>
          </div>

          <div class="col-lg-2 col-md-2 col-6 footer__social footer__item">
            <div class="footer__title">Соцсети</div>
            <ul>
              <li><a href="#"><i class="fab fa-facebook-square"></i></a></li>
              <li><a href="#"><i class="fab fa-instagram"></i></a></li>
            </ul>
          </div>

          <div class="col-lg-2 col-md-3 col-6 footer__menu footer__item">
            <div class="footer__title">Меню</div>
            <ul>
              <li><a href="<?php echo site_url(); ?>">Главная</a></li>
              <li><a href="<?php echo site_url('/clothes/'); ?>">Каталог</a></li>
              <li><a href="<?php echo site_url('/blog/'); ?>">Блог</a></li>
              <li><a href="<?php echo site_url('/information/'); ?>">Информация</a></li>
            </ul>
          </div>
        
        </div>
      </div>

    </footer>

    <?php get_template_part( 'components/component', 'modal-feedback' ) ?>
    <?php get_template_part( 'components/component', 'modal-question' ) ?>
    <?php get_template_part( 'components/component', 'modal-sizes' ) ?>
    <?php get_template_part( 'components/component', 'modal-report' ) ?>
    <?php get_template_part( 'components/component', 'search-overlay' ) ?>


    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script> 

    <!-- Lazy load -->
    <script src="https://cdn.jsdelivr.net/npm/vanilla-lazyload@10.19.0/dist/lazyload.min.js"></script>

    <!-- Slick slider -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <!-- Fancy box -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.2/jquery.fancybox.min.js"></script>

    <!-- jq cookie -->
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>

    <!-- jq ui -->
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>

    <!-- jq touch punch -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>


    <?php wp_footer(); ?>
    
  </body>
</html>
