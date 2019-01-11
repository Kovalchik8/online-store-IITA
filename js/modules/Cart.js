class Cart {

  constructor() { 
    this.btnInCartSingle = $('.product-single__in-cart');
    this.cartCountSpan = $('.navbar__feature--cart span');
    this.cartItems = $('.cart__items');
    this.cleanCartBtn = $('.clean-cookies');
    this.catalogUrl = shopData.root_url + '/clothes';
    this.cartList = [];
    this.events();
  }

  events() {
    $(document).ready(this.documentOnLoad.bind(this));
    this.btnInCartSingle.on('click', this.btnInCartSingleOnClick.bind(this));
    this.cleanCartBtn.on('click', this.cleanCartBtnOnClick.bind(this));
  }

  // clean cart content
  cleanCartBtnOnClick() {
    Cookies.remove('cart_list');
    this.cartCountSpan.text('0');
    if ($(location).attr('href') == shopData.root_url + '/cart/' || $(location).attr('href') == shopData.root_url + '/cart/#0')
      location.reload();
  }

  documentOnLoad(e) {
    var arrCookies = Cookies.getJSON('cart_list');
    if (arrCookies)
      this.cartList = arrCookies;

    (this.cartList.length) ? this.cartCountSpan.text(this.cartList.length): this.cartCountSpan.text('0');

    if (this.cartList.length) { 

      this.cleanCartBtn.css('display', 'block');
      this.cartItems.html('<div class="cart__loader"><i class="fas fa-spinner fa-pulse"></i></div>')

      this.cartContent(this.cartList, this.catalogUrl);

    } else {
      this.cartItems.html(`<div class="cart__empty"><span>Ваша Корзина пуста</span></div>`);
    }
  }

  btnInCartSingleOnClick(e) {
    var currentBtn = $(e.target);
    currentBtn.attr('disabled', true);

    var currentItem = {};
    var uniqueId = true;

    currentItem.id = parseInt($(e.target).attr('data-id'));
    currentItem.size = $('.product-single__size.active').text();
    currentItem.count = $('.product-single__number').val();

    for (let i = 0; i < this.cartList.length; i++) {
      if (currentItem.id == this.cartList[i].id && currentItem.size == this.cartList[i].size)
        uniqueId = false;
    }
  
    if (uniqueId) {
      this.cartList.push(currentItem);
      if (currentBtn.siblings('.alert').css('display') != 'block') {

        currentBtn.after("<div class='alert alert--cart alert-success' role='alert'>Товар добавлен в корзину</div>"); 
        currentBtn.siblings('.alert').slideDown(300);
        setTimeout(() => {
          currentBtn.siblings('.alert').slideUp(300);
          currentBtn.siblings('.alert').queue(function () {
            $(this).remove();
          })
        }, 2000);

      }
      
    } else {

      if (currentBtn.siblings('.alert').css('display') != 'block') {
        currentBtn.after("<div class='alert alert--cart alert-success' role='alert'>Товар уже в корзине</div>");
        currentBtn.siblings('.alert').slideDown(300);
        setTimeout(() => {
          currentBtn.siblings('.alert').slideUp(300);
          currentBtn.siblings('.alert').queue(function () {
            $(this).remove();
          })
        }, 2000);
      }
    }
    
    Cookies.set('cart_list', JSON.stringify(this.cartList));
    this.cartCountSpan.text(this.cartList.length);

    currentBtn.removeAttr('disabled');

  }

  cartContent(requestIds, catalogUrl) {
    var ids = [];
    for (let i = 0; i < requestIds.length; i++)
      ids[i] = requestIds[i].id;
       
    $.post(shopData.admin_ajax, {
        'action': 'cartContent',
        'requestIds': ids
      },
      (response) => {
        var query = JSON.parse(response);
        if (query.clothes.length) {

          // set counts and sizes to items (items order is strict after ajax request)
          for (let i = 0; i < query.clothes.length; i++) {
            query.clothes[i].size = requestIds[i].size;
            query.clothes[i].count = requestIds[i].count;
          }

          $('.cart__items').html(`
            ${query.clothes.map(item => `<div class="cart__item" data-id="${item.id}"><div class="cart__close"></div><a href="${item.link}"><img class="img-fluid lazy" src="${item.image}"></a><div class="cart__features"><a class="cart__title" href="${item.link}">${item.title}</a><div data-size="${item.size}" class="cart__sizes">Размер: <span> ${item.size}</span></div><div class="cart__quantity"><div class="cart__less">-</div><input type="number" max="999" value="${item.count}" class="cart__number" readonly><div class="cart__more">+</div></div></div><div class="cart__price"><div><span>${item.price}</span><br> грн</div></div></div>`).join('')}<div class="cart__total-price">Всего: <span><i class="fas fa-spinner fa-pulse"></i></span></div> 
          `)
          
        }

        // count total price
        function countTotalPrice() {
          var prices = $('.cart__item:not(.deleted) .cart__price span');
          var totalPrice = 0;
          prices.each(function(index) {
            totalPrice += parseInt($(this).text()) * parseInt($(this).closest('.cart__item').find('.cart__number').val() );
          })
          $('.cart__total-price span').text(totalPrice + ' грн');
        }
        countTotalPrice();

        // more on click
        $('.cart__more').on('click', (e) => {
          var currentMoreBtn = $(e.target);
          var number = currentMoreBtn.siblings('.cart__number');
          var currentNumber = parseInt(number.val());
          if (currentNumber > 998) return;
          number.val(++currentNumber);
          countTotalPrice();
        })

        // less on click
        $('.cart__less').on('click', (e) => {
          var currentLessBtn = $(e.target);
          var number = currentLessBtn.siblings('.cart__number');
          var currentNumber = parseInt(number.val());
          if (currentNumber < 2) return;
            number.val(--currentNumber);
          countTotalPrice();
        })

        // close item on click
        $('.cart__close').on('click', (e) => {

          var currentItem = $(e.target).closest('.cart__item');
          var id = parseInt(currentItem.attr('data-id') );
          var size = currentItem.find('.cart__sizes').attr('data-size');

          for (let i = 0; i < requestIds.length; i++) {
            if (id == requestIds[i].id && size == requestIds[i].size) 
              requestIds.splice(i, 1);
          }

          Cookies.set('cart_list', JSON.stringify(requestIds));
          $('.navbar__feature--cart span').text(requestIds.length);

          currentItem.addClass('deleted').slideUp(200);

          if(!requestIds.length) {
            this.cleanCartBtn.css('display', 'none');
            setTimeout(() => {
              $('.cart__items').html(`<div class="cart__empty cart__empty--slide"><span>Ваша Корзина пуста</span></div>`).queue(function () {
                $('.cart__empty--slide').slideDown();
                $(this).dequeue();
              });
            }, 300);
          } else {
            countTotalPrice();
          }

        });

      });
  }

}

export default Cart;