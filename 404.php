<?php get_header(); ?>
<?php get_template_part( 'components/component', 'navbar-main' ); ?>

<section class="page-404 section--page">

  <div class="container">
    <div class="row">
      <div class="offset-md-2 col-md-8">
      
        <div class="page-404__title">404</div>
        <div class="page-404__text">
         Запрашиваемая страница больше не существует или Вы перешли по неправильной ссылке.<br>
          <a href="<?php echo site_url('/clothes') ?>" class="btn btn--black">К покупкам</a>
        </div>

      </div>
    </div>
  </div>

</section>

<?php get_footer(); ?>