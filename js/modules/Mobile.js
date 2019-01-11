class Mobile  {
  constructor() {
    this.filtersCloseBtn = $('.filters__close');
    this.sortingFiltersBtn = $('.catalog-filters__filters');
    this.filtersIsVisible = false;

    this.catalogBtn = $('.catalog-filters__catalog');
    this.catalogIsVisible = false;
    this.catalogCloseBtn = $('.categories__close');

    this.events();
  }

  events() {
    // filters slide block on mobile
    this.filtersCloseBtn.on('click', () => {
      $('.filters').toggleClass('visible');
      this.filtersIsVisible = false;
    }); 
    this.sortingFiltersBtn.on('click', () => {
      $('.filters').toggleClass('visible');
      this.filtersIsVisible = true;
    });

    // categories slide block on mobile
    this.catalogCloseBtn.on('click', () => {
      $('.categories--mobile').toggleClass('visible');
      this.catalogIsVisible = false;
    });
    this.catalogBtn.on('click', () => {
      $('.categories--mobile').toggleClass('visible');
      this.catalogIsVisible = true;
    });

    $('html').on('click', this.htmlOnClick.bind(this));
  }

  // html on click 
  htmlOnClick(e) {
    var parent = $(e.target).closest('.filters');
    if (!$(e.target).hasClass('filters') && !$(e.target).hasClass('catalog-filters__filters') && this.filtersIsVisible && !parent.length) {
      $('.filters').removeClass('visible');
    }

    parent = $(e.target).closest('.categories--mobile');
    if (!$(e.target).hasClass('categories--mobile') && !$(e.target).hasClass('catalog-filters__catalog') && this.catalogIsVisible && !parent.length) {
      $('.categories--mobile').removeClass('visible');
    }
  }

}

export default Mobile;