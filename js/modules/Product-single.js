class ProductSingle {

  constructor() {
    this.sizes = $('.product-single__size');
    this.less= $('.product-single__less');
    this.more= $('.product-single__more');
    this.number = $('input.product-single__number');
    this.buyOneClickBtn = $('.product-single__buy-one-click');
    this.formOneClick = $('#FormBuyOneClick');
    this.formOneClickShow = false;
    this.events();
  }

  events() {
    this.sizes.on('click', this.sizesOnClick.bind(this));
    this.more.on('click', this.moreOnClick.bind(this));
    this.less.on('click', this.lessOnClick.bind(this));
    this.buyOneClickBtn.on('click', this.buyOneClickOnClick.bind(this));
  }

  sizesOnClick(e) {
    var currentSize = $(e.target);
    this.sizes.each(function(index) {
      $(this).removeClass('active');
    });
    currentSize.addClass('active');
  }

  moreOnClick() {
    var currentNumber = parseInt(this.number.val() );
    if (currentNumber > 998) return;
    this.number.val(++currentNumber);
  }

  lessOnClick() {
    var currentNumber = parseInt(this.number.val() );
    if (currentNumber < 2 ) return;
    this.number.val(--currentNumber);
  }

  buyOneClickOnClick(e) {

    // form slide down
    if (!this.formOneClickShow) {
      this.formOneClick.slideDown(300);
      this.formOneClickShow = true; 
      setTimeout(() => {
        this.formOneClick.find('input[name=name]').focus();
      }, 300);

    } else {

      // form submit
      e.preventDefault();
      this.formParams = {
        action: 'sendMail',
        subject: 'Купить в один клик с сайта интернет магазина',
        feedback: 'Спасибо за заказ! Мы свяжемся с Вами в ближайшее время.',
        name: this.formOneClick.find('input[name=name]').val(),
        tel: this.formOneClick.find('input[name=tel]').val(),
        link: $(location).attr('href')
      }

      if (this.formParams.tel && !this.validatePhone(this.formParams.tel))
        this.formParams.tel = null;

      if (!this.formParams.name || !this.formParams.tel) {
        this.checkFormInput(this.formOneClick.find('input[name=name]'), this.formParams.name);
        this.checkFormInput(this.formOneClick.find('input[name=tel]'), this.formParams.tel);

        return;
      }

      this.sendMail(this.formOneClick, this.formParams);
      this.buyOneClickBtn.prop('disabled', 'true');

    }
  }

  sendMail(currentForm, data) {

    currentForm.find("input").each(function (index) {
      $(this).css('border-color', '#ced4da');
    });
    var loader = currentForm.siblings('.product-single__loader');

    $.post(shopData.admin_ajax, data, function (result) {

      loader.html('<i class="fas fa-spinner fa-pulse"></i>').slideDown();

      setTimeout(function () {

        loader.css('display', 'none').html(result).slideDown();

        setTimeout(function () {

          // clean all inputs
          currentForm.find("input").each(function (index) {
            $(this).val("");
          });
        }, 1000);

      }, 2000);

    });

  }

  // validator for phone number inputs
  validatePhone(number) {
    number = number.replace(/[\s\-\(\)]/g, ''); // remove spaces, dashes
    return number.match(/^((\+?3)?8)?0\d{9}$/) != null;
  }

  // check form input value after submit
  checkFormInput(input, inputValue) {
    (!inputValue) ? input.css('border-color', '#f21e1e'): input.css('border-color', '#ced4da');
  }

}

export default ProductSingle;