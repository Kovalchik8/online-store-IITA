class Navbar {

  constructor() {
    this.categories = $('.expandable-catalog__categories .categories a');
    this.categoryImage = $('.expandable-catalog__image');
    this.events();
  }

  events() {
    $(document).ready(this.documentOnReady.bind(this));
    this.categories.on('mouseover', this.categoriesOnHover.bind(this));
  }

  documentOnReady() {
    // animation for home page banner
    setTimeout(() => {
      $('.header__title').addClass("animated fadeInDownBig");
      $('.header__content .btn').addClass("animated fadeInUpBig");
      $('.header__content').addClass('active');
      $('.header__separator').addClass('visible');
      $('.header__advantage').each(function (index) {
        setTimeout(() => {
          $(this).addClass("animated zoomInLeft");
        }, 400 * index);
      });
    }, 300);
    
  }

  categoriesOnHover(e) {
    this.categoryImage.css('background-image', "url('')").html('<i class="fas fa-spinner fa-pulse"></i>');
    
    var currentCategory = $(e.target).closest('li'),
        classes = currentCategory.attr("class").split(' '),
        imageUrl = shopData.theme_folder + '/img/category/' + classes[1] + '.jpg';

    setTimeout(() => {
      this.categoryImage.html('').css('background-image', 'url(' + imageUrl + ')');;
    }, 200);

  }

}

export default Navbar;