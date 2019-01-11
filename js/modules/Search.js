class Search {

  constructor() {
    this.searchBtn = $('.navbar__feature--search');
    this.searchOverlay = $('.search-overlay');
    this.searchCloseBtn = $('.search-overlay .fa-times');
    this.searchInput = $('.search-overlay__top input');
    this.searchResults = $('.search-overlay__results');
    this.isSearchOpen = false;
    this.isSpinnerVisible = false;
    this.prevSearchValue;
    this.events();
  }

  events() {
    this.searchBtn.on('click', this.searchBtnOnClick.bind(this) );
    this.searchCloseBtn.on('click', this.searchCloseBtnOnClick.bind(this));
    this.searchInput.on('keyup', this.searchTimeout.bind(this));
    $(document).on('keydown', this.keydownEvent.bind(this));
  }


  keydownEvent(e) {
    let code = e.keyCode;
    if (code == 27 && this.isSearchOpen)
      this.searchCloseBtnOnClick();
  }
  
  searchTimeout() {

    if (this.searchInput.val()) {

      if (!this.isSpinnerVisible && this.prevSearchValue != this.searchInput.val()) {
        this.searchResults.html('<div class="spinner-wrapper"><i class="fas fa-spinner fa-pulse"></i></div.');
        this.isSpinnerVisible = true;
      }

      if (this.prevSearchValue != this.searchInput.val()) {
        clearTimeout(this.searchTimer);
        this.searchTimer = setTimeout(this.resultActs.bind(this), 750);
        this.prevSearchValue = this.searchInput.val();
      }

    } else {
      clearTimeout(this.searchTimer);
      this.searchResults.html('');
      this.prevSearchValue = '';
      this.isSpinnerVisible = false;
    }

  }

  resultActs() {

    //  var requestMy = shopData.root_url + "/wp-json/shop/v1/search?term=" + this.searchInput.val();
    //  console.log(requestMy);

    // search request
    $.getJSON(shopData.root_url + "/wp-json/shop/v1/search?term=" + this.searchInput.val(), (results) => {
      
      // search results
      if (!results.clothes.length && !results.general.length) {

        this.searchResults.html(`
        <p class="search-overlay__no-result">Пожалуйста, уточните свой запрос (артикул или название).</p> 
        `)

      } else {
      
        this.searchResults.html(`
        <div class="row">
          <div class="offset-md-2 col-md-8">
            ${results.clothes.length ? '<ul class="list-clothes">' : ''}
              ${results.clothes.map(item => `<li><a href="${item.link}"><img src="${item.image}" class="img-fluid"></a><div class="list-clothes__desc"><a href="${item.link}" class="list-clothes__title">${item.title}</a><div class="list-clothes__sizes">${item.sizes.map(size => `<span class="list-clothes__size">${size}</span>`).join('')}</div><div class="list-clothes__quantity"><div class="list-clothes__less">-</div><input type="number" max="999" value="1" class="list-clothes__number" readonly><div class="list-clothes__more">+</div></div></div><div class="list-clothes__right"><span class="list-clothes__price">${item.price} грн</span><button class="btn btn--black list-clothes__add-to-cart" data-id="${item.id}">В корзину <i class="fas fa-shopping-bag"></i></button></div>`).join('')}
              ${results.clothes.length ? '</ul>' : ''}
          </div>
          <div class="offset-md-2 col-md-8">
            ${results.general.length ? '<ul class="list-general">' : ''}
              ${results.general.map(item => `<li><a href="${item.link}"><img src="${item.image}" class="img-fluid"><div class="list-general__content"><span>${item.title}</span><span>${item.excerpt}</span></div></a>`).join('')}
              ${results.general.length ? '</ul>' : ''}
          </div>
        </div>  
        `)

        //sizes on click
        $('.list-clothes__size:first-child').addClass('active');
        $('.list-clothes__size').on('click', (e) => {
          var currentSize = $(e.target);
          currentSize.siblings('.list-clothes__size').each(function () {
            $(this).removeClass('active');
          })
          currentSize.addClass('active');
        })

        // more on click
        $('.list-clothes__more').on('click', (e) => {
          var currentMoreBtn = $(e.target);
          var number = currentMoreBtn.siblings('.list-clothes__number');
          var currentNumber = parseInt(number.val());
          if (currentNumber > 998) return;
          number.val(++currentNumber);
        })

        // less on click
        $('.list-clothes__less').on('click', (e) => {
          var currentLessBtn = $(e.target);
          var number = currentLessBtn.siblings('.list-clothes__number');
          var currentNumber = parseInt(number.val());
          if (currentNumber < 2) return;
          number.val(--currentNumber);
        })


        // in cart btn on click
        $('.list-clothes__add-to-cart').on('click', function(e) {
          $(this).attr('disabled', true);

          var currentBtn = $(this);
          var data = [];
          var arrCookies = Cookies.getJSON('cart_list');
          var currentSearchItem = $(this).closest('li');
          var currentItem = {};
          var uniqueId = true;

          if (arrCookies)
            data = arrCookies;

          currentItem.id = parseInt($(e.target).attr('data-id'));
          currentItem.size = currentSearchItem.find('.list-clothes__size.active').text();
          currentItem.count = currentSearchItem.find('.list-clothes__number').val();

          if (data.length)
            for (let i = 0; i < data.length; i++) {
              if (currentItem.id == data[i].id && currentItem.size == data[i].size)
                uniqueId = false;
            }

          if (uniqueId) {
            data.push(currentItem);

            Cookies.set('cart_list', JSON.stringify(data));
            $('.navbar__feature--cart span').text(data.length);

            if (currentBtn.siblings('.alert').css('display') != 'block') {

              currentBtn.after("<div class='alert alert--cart alert-success' role='alert'>Добавлен в корзину</div>");
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
              currentBtn.after("<div class='alert alert--cart alert-success' role='alert'>Уже в корзине</div>");
              currentBtn.siblings('.alert').slideDown(300);
              setTimeout(() => {
                currentBtn.siblings('.alert').slideUp(300);
                currentBtn.siblings('.alert').queue(function () {
                  $(this).remove();
                })
              }, 2000);
            }
          }

          setTimeout(() => {
            $(this).removeAttr('disabled');
          }, 2000);

        }); 

      }
      
    });

    this.isSpinnerVisible = false;

  }

  searchBtnOnClick() {
    this.searchOverlay.addClass('show');
    this.isSearchOpen = true;
    $('body').css('overflow-y', 'hidden');
    setTimeout(() => {
      this.searchInput.focus();
    }, 300);
  }

  searchCloseBtnOnClick() { 
    this.searchOverlay.removeClass('show');
    this.isSearchOpen = false;
    $('body').css('overflow-y', 'scroll');
    if ($(location).attr('href') == shopData.root_url + '/cart/' || $(location).attr('href') == shopData.root_url + '/cart/#0')
      location.reload();
  }

}

export default Search;