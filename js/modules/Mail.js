class Mail {

  constructor() {
    this.borderColorOrigin = '#212529';
    this.borderColorError = '#f21e1e';

    this.modalFeedback = $('#ModalFeedback');
    this.formFeedback = $('#FormFeedback');

    this.modalQuestion = $('#ModalQuestion');
    this.formQuestion = $('#FormQuestion');

    this.modalPaymentReport = $('#ModalPaymentReport');
    this.formPaymentReport = $('#FormPaymentReport');

    this.formParams = {};
    this.events();
  }

  events() {
    this.formFeedback.find('button[type=submit]').on('click', this.formFeedbackSubmit.bind(this));
    this.formQuestion.find('button[type=submit]').on('click', this.formQuestionSubmit.bind(this));
    this.formPaymentReport.find('button[type=submit]').on('click', this.formPaymentReportSubmit.bind(this));
  }

  formFeedbackSubmit(e) {

    e.preventDefault();

    this.formFeedback.find('.modal__result').css('display', 'none');

    this.formParams = {
      action: 'sendMail',
      subject: 'Новый заказ на обратный звонок c сайта интернет магазина',
      feedback: 'Спасибо за обращение! Мы свяжемся с Вами в ближайшее время.',
      name: this.formFeedback.find('input[name=name]').val(),
      tel: this.formFeedback.find('input[name=tel]').val(),
    }

    if (this.formParams.tel && !this.validatePhone(this.formParams.tel))
      this.formParams.tel = null;

    if (!this.formParams.name || !this.formParams.tel) {
      this.checkFormInput(this.formFeedback.find('input[name=name]'), this.formParams.name);
      this.checkFormInput(this.formFeedback.find('input[name=tel]'), this.formParams.tel);

      return;
    }

    this.sendMail(this.formFeedback, this.formParams, this.modalFeedback);

  }

  formQuestionSubmit(e) {

    e.preventDefault();

    this.formQuestion.find('.modal__result').css('display', 'none');

    this.formParams = {
      action: 'sendMail',
      subject: 'Новый вопрос c сайта интернет магазина',
      feedback: 'Спасибо за обращение! Мы отправим ответ на вашу почту.',
      name: this.formQuestion.find('input[name=name]').val(),
      email: this.formQuestion.find('input[name=email]').val(),
      message: this.formQuestion.find('textarea[name=message]').val(),
    }

    if (this.formParams.email && !this.validateEmail(this.formParams.email)) 
      this.formParams.email = null;
    

    if (!this.formParams.name || !this.formParams.email || !this.formParams.message) {
      this.checkFormInput(this.formQuestion.find('input[name=name]'), this.formParams.name);
      this.checkFormInput(this.formQuestion.find('input[name=email]'), this.formParams.email);
      this.checkFormInput(this.formQuestion.find('textarea[name=message]'), this.formParams.message);

      return;
    }

    this.sendMail(this.formQuestion, this.formParams, this.modalQuestion);

  }

  formPaymentReportSubmit(e) {

    e.preventDefault();

    this.formPaymentReport.find('.modal__result').css('display', 'none');

    this.formParams = {
      action: 'sendMail',
      subject: 'Новое сообщение об оплате с сайта интернет магазина',
      feedback: 'Спасибо! После проверки оплаты, Ваш заказ будет отправлен по указанному при оформлении адресу доставки.',
      order: this.formPaymentReport.find('input[name=order]').val(),
      name: this.formPaymentReport.find('input[name=name]').val(),
      tel: this.formPaymentReport.find('input[name=tel]').val()
    }

    if (this.formParams.tel && !this.validatePhone(this.formParams.tel)) 
      this.formParams.tel = null;
    
    if (this.formParams.order && !this.validateOrderNumber(this.formParams.order)) 
      this.formParams.order = null;
    

    if (!this.formParams.order || !this.formParams.name || !this.formParams.tel) {
      this.checkFormInput(this.formPaymentReport.find('input[name=order]'), this.formParams.order);
      this.checkFormInput(this.formPaymentReport.find('input[name=name]'), this.formParams.name);
      this.checkFormInput(this.formPaymentReport.find('input[name=tel]'), this.formParams.tel);

      return;
    }

    this.sendMail(this.formPaymentReport, this.formParams, this.modalPaymentReport);

  }

  sendMail(currentForm, data, modal) {

    currentForm.find("input").each(function (index) {
      $(this).siblings('label').css('color', '#212529');
    });
    currentForm.find('textarea').siblings('label').css('color', '#212529');

    $.post(shopData.admin_ajax, data, function (result) {

      currentForm.find('.modal__loader').html('<i class="fas fa-spinner fa-pulse"></i>');

      setTimeout(function () {

        currentForm.find('.modal__result').html(result).slideDown();
        currentForm.find('.modal__loader').html('');

        setTimeout(function () {

          // clean all inputs
          currentForm.find("input").each(function (index) {
            $(this).val("");
          });
          currentForm.find('textarea').val("");
        }, 1000);

        // close modal
        setTimeout(() => {
          modal.find('.fancybox-close-small').trigger('click');
        }, 3000);

      }, 2000);

    });

  }

  // validator for phone number inputs
  validatePhone(number) {
    number = number.replace(/[\s\-\(\)]/g, ''); // remove spaces, dashes
    return number.match(/^((\+?3)?8)?0\d{9}$/) != null;
  }

  // validator for email input
  validateEmail(email) {
    return email.match(/\S+@\S+\.\S+/) != null;
  }

  // validator for order number
  validateOrderNumber(number) {
     return number.match(/^\d+$/) != null;
  }

  // check form input value after submit
  checkFormInput(input, inputValue ) {

    (!inputValue) ? input.siblings('label').css('color', this.borderColorError).addClass("animated shake").one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd", function () {
      $(this).removeClass('animated shake');
    }): input.siblings('label').css('color', this.borderColorOrigin);

  }

}

export default Mail;