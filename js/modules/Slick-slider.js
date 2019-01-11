
class SlickSlider {

  constructor() {
    this.sliderBlog = $(".slick-blog");
    this.sliderMain = $(".section-slider__slick-slider");
    this.sliderProductSingle = $(".product-single__slick");

    this.startSlick();
    this.sliderMainChange(); 
  }

  startSlick() {

    this.sliderBlog.slick({
      infinite: false,
      dots: true,
      arrows: false,
      slidesToShow: 2, 
      slidesToScroll: 1,
      adaptiveHeight: true,
      responsive: [
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
          }
        },
      ]
    });

    this.sliderMain.slick({
      infinite: false,
      slidesToShow: 7,
      slidesToScroll: 1,
      prevArrow: '<i class="fas fa-angle-left section-slider__prev"></i>',
      nextArrow: '<i class="fas fa-angle-right section-slider__next"></i>',
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 5,
          }
        },
        {
          breakpoint: 992,
          settings: {
            slidesToShow: 4,
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 3,
          }
        },
      ]
    });

    this.sliderProductSingle.slick({
      infinite: true,
      slidesToShow: 3,
      vertical: true,
      slidesToScroll: 1,
      prevArrow: '<i class="fas fa-angle-up product-single__prev"></i>',
      nextArrow: '<i class="fas fa-angle-down product-single__next"></i>',
      responsive: [
        {
          breakpoint: 992,
          settings: {
            slidesToShow: 2,
          }
        },
      ]
    });

  } 

  // On after single product slide change
  sliderMainChange() {

      this.sliderMain.on('afterChange', function (event, slick, currentSlide) {

        $(this).find('.section-slider__item:first-child').hasClass('slick-active') ? $(this).find('.section-slider__prev').css('opacity', '.4') : $(this).find('.section-slider__prev').css('opacity', '1');

        $(this).find('.section-slider__item:last-child').hasClass('slick-active') ? $(this).find('.section-slider__next').css('opacity', '.4') : $(this).find('.section-slider__next').css('opacity', '1');

      });

  }

}

export default SlickSlider;