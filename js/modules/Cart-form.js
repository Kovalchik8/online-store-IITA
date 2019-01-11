class CartForm {
  constructor() {
    this.btnCartForm = $('.cart__order button[type=submit]');
    this.form = $('#CartOrder');
    this.inputOffice = this.form.find('input[name=office]');
    this.orderPostId = 98;
    this.events();
  }

  events() {
    this.btnCartForm.on('click', this.btnCartFormOnClick.bind(this));
    this.inputOffice.on('keydown', this.inputOfficeOnKeydown.bind(this));
  }

  btnCartFormOnClick(e) {
    e.preventDefault();

    var cartItems = $('.cart__item:not(.deleted)');

    // cart is empty
    if (!cartItems.length) {
      $('.cart__empty').css('color', '#f21e1e').addClass("animated shake").one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd", function () {
        $(this).removeClass('animated shake');
      });
    
    // cart is not empty
    } else {

      this.formParams = {
        action: 'sendCartOrder',
        subject: 'Новый заказ с сайта интернет магазина',
        feedback: 'Заказ оформлен',
        name: this.form.find('input[name=name]').val(),
        email: this.form.find('input[name=email]').val(),
        tel: this.form.find('input[name=tel]').val(),
        delivery: this.form.find('select[name=delivery]').val(),
        city: this.form.find('input[name=city]').val(),
        office: this.form.find('input[name=office]').val()
      }

      if (this.formParams.name && !this.validateName(this.formParams.name))
        this.formParams.name = null;

      if (this.formParams.email && !this.validateEmail(this.formParams.email))
        this.formParams.email = null;

      if (this.formParams.tel && !this.validatePhone(this.formParams.tel))
        this.formParams.tel = null;

      if (!this.formParams.name || !this.formParams.email || !this.formParams.tel || !this.formParams.city || !this.formParams.office) {
        this.checkFormInput(this.form.find('input[name=name]'), this.formParams.name);
        this.checkFormInput(this.form.find('input[name=email]'), this.formParams.email);
        this.checkFormInput(this.form.find('input[name=tel]'), this.formParams.tel);
        this.checkFormInput(this.form.find('input[name=city]'), this.formParams.city);
        this.checkFormInput(this.form.find('input[name=office]'), this.formParams.office);

        return;
      }

      // order number
      var orderNumber = this.getOrderNumber(); 
      (orderNumber) ? orderNumber++ : orderNumber = 11111112;
        
      // list of cart items
      var cartListTable = `
       <table style="line-height:1.8;max-width:600px;border-collapse:collapse;width:100%;border-top:1px solid #dddddd;border-left:1px solid #dddddd;">
          <thead>
            <tr>
              <td style="font-size:14px;border-right:1px solid #dddddd;border-bottom:1px solid #dddddd;text-align:center;background-color:#efefef;font-weight:bold;padding:7px;color:#222222">Покупатель: </td>
              <td style="font-size:14px;border-right:1px solid #dddddd;border-bottom:1px solid #dddddd;text-align:left;padding:7px;color:#222222">${this.formParams.name} / ${this.formParams.tel}</td>
            </tr>
            <tr>
              <td style="font-size:14px;border-right:1px solid #dddddd;border-bottom:1px solid #dddddd;background-color:#efefef;font-weight:bold;text-align:center;padding:7px;color:#222222">Доставка: </td>
              <td style="font-size:14px;border-right:1px solid #dddddd;border-bottom:1px solid #dddddd;text-align:left;padding:7px;color:#222222">${this.formParams.delivery} / ${this.formParams.city} / Отделение ${this.formParams.office}</td>
            </tr>
          </thead>
          <tbody>`;

      // loop through all cart items
      cartItems.each(function(index){

        var title = $(this).find('.cart__title').text(),
            size = $(this).find('.cart__sizes').attr('data-size'),
            count = $(this).find('.cart__number').val(),
            price = $(this).find('.cart__price span').text(),
            itemTotalPrice = parseInt(count) * parseInt(price),
            linkImg = $(this).find('img').attr('src'),
            link = $(this).find('.cart__title').attr('href');

        cartListTable += `
        <tr>
          <td style="font-size:13px;border-right:1px solid #dddddd;border-bottom:1px solid #dddddd;text-align:center;padding:7px">
            <a target=_blank href=${link}> <img style="max-width:100px;" src="${linkImg}"></a>
          </td>
          <td style="position:relative;vertical-align:top;font-size:13px;border-right:1px solid #dddddd;border-bottom:1px solid #dddddd;padding:7px">
            <b>Модель:</b> <a target=_blank href=${link}> ${title} </a> <br>
            <b>Размер:</b> ${size}<br>
            <b>Цена за единицу:</b> ${price} грн<br>
            <b>Количество:</b> ${count}<br>
            <b>Стоимость:</b> ${itemTotalPrice} грн<br>
          </td>
        </tr>
        `;

      });

      // the end of cart list table
      var totalPrice = $('.cart__total-price span').text();
      cartListTable += `
          </tbody>
        </table>
        <p style="padding:10px 7px 10px 7px;margin:0;max-width:590px;text-align:right;font-size:16px;font-weight:bold">Сумма к оплате: ${totalPrice}</p>
      `;

      var dateTime = this.getDateTime();

      // mail to client
      var mailToClient = `
        <h3>Здравствуйте!</h3>
        <p>Благодарим Вас за покупку на нашем сайте.</p>
        <p>Мы свяжемся с Вами в ближайшее время для подтверждения.</p>
        <p>Ваш заказ № <b>${orderNumber}</b> от ${dateTime[0]} (${dateTime[1]})</p>
      `;

      mailToClient += cartListTable;

      mailToClient += `
        <p>Будем рады ответить на любые Ваши вопросы по телефонам:</p>
        <p>+38 (099) 260-74-80 (Vodafone, Viber)<br>  +38 (063) 523-47-64 (Lifecell)<br>  +38 (068) 819-96-73 (Kyivstar)</p>
        <p>Оплатить Ваш заказ можно переводом на карту ПриватБанка (номер карты придет Вам в СМС после подтверждения заказа).<br> Также Вы можете воспользоваться удобными платежными online сервисами  <a target="_blank" href="https://privatbank.ua/sendmoney?payment=bb38a94ba66c092435dfa1ac858a82200efb3b90">SendMoney</a> или <a target="_blank" href="https://www.ipay.ua/ru/p2p/default/constructor/48ded373f9946267c806bf1813ed995d">IPay</a>.</p>
        <p>После оплаты, обязательно сообщите нам об этом (на любой контактный номер или с помощью формы на сайте в разделе Информация)</p>
      `;

      // mail to owner
      var mailToOwner = `
        <p style="max-width:600px;text-align:center;">Заказ №<b>${orderNumber}</b></p>
      `;
      mailToOwner += cartListTable;

      this.formParams.mailOwner = mailToOwner;
      this.formParams.mailClient = mailToClient;
      this.btnCartForm.prop('disabled', 'true'); // make button disabled while email sending is in a process

      this.sendCartOrder(this.form, this.formParams, cartItems, this.btnCartForm);

      this.setOrderNumber(orderNumber);
      
    }
    
  }

  sendCartOrder(currentForm, data, items, clickedBtn) {

    currentForm.find("input").each(function (index) {
      $(this).siblings('label').css('color', '#212529');
    });
    var loader = currentForm.find('.cart__form-loader');

    $.post(shopData.admin_ajax, data, function (result) {

      loader.html('<i class="fas fa-spinner fa-pulse"></i>').slideDown();

      setTimeout(function () {

        loader.css('display', 'none').html(result).slideDown();

        setTimeout(function () {

          // clean cart and its Cookies if mail succeed
          if ( $('.cart__form-loader .alert-success').css('display') == 'block' ) {

            $('.cart__items').html(`<div class="cart__empty cart__empty--slide"><span>Ваша Корзина пуста</span></div>`).queue(function () {
              $('.cart__empty--slide').slideDown();
              $(this).dequeue();
            });

            Cookies.remove('cart_list');
            $('.navbar__feature--cart span').text('0');
            
          }

          // clean all inputs
          currentForm.find("input").each(function (index) {
            $(this).val("");
          });

          // make btn clickable again
          clickedBtn.removeAttr('disabled');

        }, 1000);

      }, 2000);

    });

  }

  getOrderNumber() {
    var data = {
      action: 'getOrderNumber',
    }
    var number;

    jQuery.ajaxSetup({
      async: false
    });

    $.post(shopData.admin_ajax, data, function (result) {

      number = result;

    });

    jQuery.ajaxSetup({
      async: true
    });

    return number;

  }

  setOrderNumber(number) {
    var data = {
      action: 'setOrderNumber',
      orderNumber: number
    }
    var page;

    jQuery.ajaxSetup({ 
      async: false
    });

    $.post(shopData.admin_ajax, data, function (result) {
    
      page = $.parseJSON(result);

    });

    jQuery.ajaxSetup({
      async: true
    });

    // redirect user to thanks page
    if (page['link'].length)
      setTimeout(() => {
        $(location).attr('href', page['link']);
      }, 3000);

  }

  getDateTime() {
    var d = new Date();

    // date
    var month = d.getMonth() + 1;
    var day = d.getDate();

    var date =  (('' + day).length < 2 ? '0' : '') + day + '.' +
                (('' + month).length < 2 ? '0' : '') + month + '.' +
                d.getFullYear();

    // time
    var time = d.getHours() + ":" + d.getMinutes();

    return [date, time];
  }

  // validator for name input 
  validateName(name) {
    var indexOfSpace = name.indexOf(' ');
    var nameTrimmed = name.replace(/[\s\-\(\)]/g, '');
    if (nameTrimmed.length && indexOfSpace != -1 && name.length - 1 != indexOfSpace) {
      return true;
    } else {
      return false;
    }
  }

  // validator for email input
  validateEmail(email) {
    return email.match(/\S+@\S+\.\S+/) != null;
  }

  // validator for phone number inputs
  validatePhone(number) {
    number = number.replace(/[\s\-\(\)]/g, ''); // remove spaces, dashes
    return number.match(/^((\+?3)?8)?0\d{9}$/) != null;
  }

  // check form input value before submit
  checkFormInput(input, inputValue) {

    (!inputValue) ? input.siblings('label').css('color', '#f21e1e').addClass("animated shake").one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd", function () {
      $(this).removeClass('animated shake');
    }): input.siblings('label').css('color', '#212529');

  }

  // allow only numbers for office input
  inputOfficeOnKeydown(e) {
    // Allow: backspace, delete, tab, escape, enter and .
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
      // Allow: Ctrl+A, Command+A
      (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
      // Allow: home, end, left, right, down, up
      (e.keyCode >= 35 && e.keyCode <= 40)) {
      // let it happen, don't do anything
      return;
    }
    // Ensure that it is a number and stop the keypress
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
      e.preventDefault();
    }
  }


}

export default CartForm;