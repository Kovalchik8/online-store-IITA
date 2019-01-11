class FancyBox {

  constructor() {
    this.iniFancyBox();
  }

  iniFancyBox() {

    $('[data-fancybox="images"]').fancybox({
      loop: true,
      buttons: [
        "fullScreen",
        "close"
      ],
      thumbs: {
        autoStart: true, // Display thumbnails on opening
      },
    });

    $('.fancybox-no-touch[data-fancybox]').fancybox({
      touch: false,
      afterClose: function() {
        $('.modal-with-alert .modal__result').css('display', 'none');
      },
    }); 

  }

}

export default FancyBox;