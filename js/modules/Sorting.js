class Sorting {
  constructor() {
    this.isSortingRunning = false;
    this.sortingPriceBtn = $('.sorting__price'); 
    this.sortingDateBtn = $('.sorting__date');
    this.sortingValue = [
      {
        name: 'price',
        active: false,
        order: "DESC"
      },
      {
        name: 'date',
        active: false,
        order: "DESC"
      }
    ];
    this.primarySortingValue = this.sortingValue;
    this.sizesBtn = $('.filters__size');
    this.colorsBtn = $('.filters__color');
    this.filterSizes = [];
    this.filterColors = [];
    this.filterPrice = [];
    this.getMorePostsBtn = $(".archive__more-posts .btn");
    this.priceFilterBtn = $('.filters__price-header .btn');
    this.resetBtn = $('.filters__reset');
    this.postsPerOnce = 4;

    this.events();
  }

  events() {
    $(document).ready(this.documentOnLoad.bind(this));
    this.sortingPriceBtn.on('click', this.sortingPriceBtnOnClick.bind(this));
    this.sortingDateBtn.on('click', this.sortingDateBtnOnClick.bind(this));
    this.getMorePostsBtn.on('click', this.getMorePostsBtnOnClick.bind(this));
    this.sizesBtn.on('click', this.sizesBtnOnClick.bind(this));
    this.colorsBtn.on('click', this.colorsBtnOnClick.bind(this));
    this.priceFilterBtn.on('click', this.priceFilterBtnOnClick.bind(this));
    this.resetBtn.on('click', this.resetBtnOnClick.bind(this));
  }

  // on document load
  documentOnLoad() {
    if ($('.shopping').hasClass('archive') && $('.archive__item').length < this.postsPerOnce) {
        this.getMorePostsBtn.attr('disabled', true);
    } else if ($('.shopping').hasClass('category') && $('.category__item').length < this.postsPerOnce) {
      this.getMorePostsBtn.attr('disabled', true);
    }
  }

  // reset all filters and sortings
  resetBtnOnClick() {
    location.reload(); // *troll face*
  }

  // filter by price
  priceFilterBtnOnClick() {
    if (this.isSortingRunning)
      return;

    var values = $('#amount').val().split(' - ');
    this.filterPrice[0] = values[0];
    this.filterPrice[1] = values[1];

    this.sortItems();
  }

  // filter by colors
  colorsBtnOnClick(e) {
    if (this.isSortingRunning)
      return;

    var colors = [];
    var target = $(e.target);
    (target.hasClass('filters__color')) ? target.toggleClass('active') : target.closest('.filters__color').toggleClass('active');

    this.colorsBtn.each(function (index) {
      if ($(this).hasClass('active'))
        colors.push($(this).find('.color').text());
    });

    this.filterColors = colors;

    this.sortItems();
  }

  // filter by sizes
  sizesBtnOnClick(e) {
    if (this.isSortingRunning)
      return;

    var sizes = [];
    var target = $(e.target);

    target.toggleClass('active');

    this.sizesBtn.each(function(index) {
      if ($(this).hasClass('active') )
        sizes.push($(this).text());
    });

    this.filterSizes = sizes;

    this.sortItems();
  }

  // sorting by date
  sortingDateBtnOnClick() {
    if (this.isSortingRunning)
      return;

    $('.sorting__curret').html('');
    var index = 1;

    if (this.sortingValue[index].order == 'ASC') {
      $('.sorting__curret--date').html('<i class="fas fa-caret-down"></i>');
      this.sortingValue[index].order = "DESC";
    } else {
      $('.sorting__curret--date').html('<i class="fas fa-caret-up"></i>');
      this.sortingValue[index].order = "ASC";
    }

    this.setActiveSortingValue('date');

    this.sortItems();
  }

  // sorting by price
  sortingPriceBtnOnClick() {
    if (this.isSortingRunning)
      return;
      
    $('.sorting__curret').html('');
    var index = 0;

    if (this.sortingValue[index].order == 'ASC') {
      $('.sorting__curret--price').html('<i class="fas fa-caret-down"></i>');
      this.sortingValue[index].order = "DESC";
    } else {
      $('.sorting__curret--price').html('<i class="fas fa-caret-up"></i>');
      this.sortingValue[index].order = "ASC";
    }

    this.setActiveSortingValue('price');

    this.sortItems();
  }

  //button get more items
  getMorePostsBtnOnClick() {

    var offset = $('.shopping__item').length;
    var category = $('.category').attr('data-id');
    
    var sortingValue = this.getSortingValues();
    
    var data = {
      action: 'getSortedItems',
      offset: offset,
      metaKey: sortingValue[0],
      order: sortingValue[1],
      category: category,
      sizes: this.filterSizes,
      colors: this.filterColors,
      price: this.filterPrice
    }
      
    this.getMorePostsBtn.attr("disabled", true); 

    $.post(shopData.admin_ajax, data).done( result => {
      var items = JSON.parse(result);

      $('.shopping__list').append(`
        ${items.clothes.map(item=>`
          <div class="shopping__item" data-id="${item.id}">
            <a href="${item.link}">
              <img data-src="${item.image}" class="img-fluid lazy" alt="">
              <div class="clothes-layer">
                ${item.sizes.map(item=>`
                <span>${item}</span>
                `).join('')}
              </div>
            </a>
            <div class="shopping__name">${item.title}</div>
            <div class="shopping__price">${item.price} грн</div>
          </div>
        `).join('')}
      `);

      var myLazyLoad = new LazyLoad({
        elements_selector: ".lazy"
      });

      if (items.clothes.length >= this.postsPerOnce)
        this.getMorePostsBtn.removeAttr("disabled");
    });

  }

  // get sorted items
  sortItems() {

    this.isSortingRunning = true;    

    $('.shopping__list').html('<div class="archive-category-loader"><i class="fas fa-spinner fa-pulse"></i></div>');

    var sortingValue = this.getSortingValues();

    var data = {
      action: 'getSortedItems',
      metaKey: sortingValue[0],
      order: sortingValue[1],
      category: $('.category').attr('data-id'),
      sizes: this.filterSizes,
      colors: this.filterColors,
      price: this.filterPrice,
    }

    $.post(shopData.admin_ajax, data, (result) => {
      
      var items = JSON.parse(result);

      if (!items.clothes.length) { // no results

        setTimeout(() => {
          $('.archive__list').html(`
            <div class="results-empty">Результаты не найдены, попробуйте изменить параметры поиска.</div>
          `)

          this.getMorePostsBtn.attr("disabled", true);
        }, 500);

      } else { // has results

        setTimeout(() => {
        $('.shopping__list').html(`
        ${items.clothes.map(item=>`
          <div class="shopping__item" data-id="${item.id}">
            <a href="${item.link}">
              <img data-src="${item.image}" class="img-fluid lazy" alt="">
              <div class="clothes-layer">
                ${item.sizes.map(item => `
                <span>${item}</span>
                `).join('')}
              </div>
            </a>
            <div class="shopping__name">${item.title}</div>
            <div class="shopping__price">${item.price} грн</div>
          </div>
          `).join('')}
        `);

        var myLazyLoad = new LazyLoad({
          elements_selector: ".lazy"
        });
          
        }, 500);
      }

      (items.clothes.length < this.postsPerOnce) ? this.getMorePostsBtn.attr("disabled", true): this.getMorePostsBtn.removeAttr("disabled");
      this.isSortingRunning = false;

    });
  }

  // set active sorting item
  setActiveSortingValue(name) {
    for (let i = 0; i < this.sortingValue.length; i++) {
      if (this.sortingValue[i].name != name) {
        this.sortingValue[i].active = false;
      } else {
        this.sortingValue[i].active = true;
      }
    }
  }

  // get sorting values
  getSortingValues() {
    for (let i = 0; i < this.sortingValue.length; i++) {
      if (this.sortingValue[i].active == true) {
        return [this.sortingValue[i].name, this.sortingValue[i].order];
      }
    }
    return ['', ''];
  }

}

export default Sorting;