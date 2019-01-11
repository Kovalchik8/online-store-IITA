
class PrivateOffice {
  constructor() {
    this.btnEdit = $('.btn.office__edit');
    this.btnSave = $('.btn.office__save');
    this.btnCancel = $('.btn.office__cancel');
    this.form = $('.office__form');
    this.inputOffice = this.form.find('input[name=office]');
    this.inputs = this.form.find('input');
    this.select = this.form.find('select');
    this.isClickEventDone = true; // one click for one ajax request
    this.events();
  }

  events() {
    this.btnEdit.on('click', this.btnEditOnClick.bind(this));
    this.btnCancel.on('click', this.btnCancelOnClick.bind(this));
    this.btnSave.on('click', this.btnSaveOnClick.bind(this));
    this.inputOffice.on('keydown', this.inputOfficeOnKeydown.bind(this));
  }

  // save button on click
  btnSaveOnClick() {
    this.data = {
      id: this.form.attr('data-id'),
      name: this.form.find('input[name=name]').val(),
      email: this.form.find('input[name=email]').val(),
      tel: this.form.find('input[name=tel]').val(),
      delivery: this.form.find('select[name=delivery]').val(),
      city: this.form.find('input[name=city]').val(),
      office: this.form.find('input[name=office]').val()
    }

    if (this.data.name && !this.validateName(this.data.name))
      this.data.name = 'nonvalid';

    if (this.data.email && !this.validateEmail(this.data.email))
      this.data.email = 'nonvalid';

    if (this.data.tel && !this.validatePhone(this.data.tel))
      this.data.tel = 'nonvalid';

    if (this.data.name == 'nonvalid' || this.data.email == 'nonvalid' || this.data.tel == 'nonvalid') {
      this.checkFormInput(this.form.find('input[name=name]'), this.data.name);
      this.checkFormInput(this.form.find('input[name=email]'), this.data.email);
      this.checkFormInput(this.form.find('input[name=tel]'), this.data.tel);

      return;
    }

    if (this.isClickEventDone) {
      this.isClickEventDone = false;
      this.form.find('label').css('color', '#212529');
      this.manageUserData();
    }
  }

  // manage user data
  manageUserData() {

    $.ajax({
      beforeSend: (xhr) => {
        xhr.setRequestHeader('X-WP-Nonce', shopData.nonce);
      },
      type: "POST",
      url: shopData.root_url + '/wp-json/shop/v1/manageUserPrivateData',
      data: this.data,
      success: (response) => {
        console.log(response);
        this.isClickEventDone = true;
        this.inputs.each(function (index) {
          $(this).prop('readonly', true);
        })
        this.select.prop('disabled', true);
        this.btnEdit.css('display', 'block');
        this.btnSave.css('display', 'none');
        this.btnCancel.css('display', 'none');
      },
      error: (response) => {
        console.log(response);
        this.isClickEventDone = true;
      }
    });
  }

  // cancel button
  btnCancelOnClick() {
    location.reload();
  }


  // edit personal data button
  btnEditOnClick() {

    this.inputs.each(function(index) {
      $(this).prop('readonly', false);
    })
    this.select.prop('disabled', false);

    this.btnEdit.css('display', 'none');
    this.btnSave.css('display', 'block');
    this.btnCancel.css('display', 'block');

  }

  // check form input value before submit
  checkFormInput(input, inputValue) {

    (inputValue == 'nonvalid') ? input.siblings('label').css('color', '#f21e1e').addClass("animated shake").one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd", function () {
      $(this).removeClass('animated shake');
    }): input.siblings('label').css('color', '#212529');

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

  // allow only numbers for office input
  inputOfficeOnKeydown(e) {
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
      (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
      (e.keyCode >= 35 && e.keyCode <= 40)) {
      return;
    }
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
      e.preventDefault();
    }
  }

}

export default PrivateOffice;