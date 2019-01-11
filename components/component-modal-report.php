<div id="ModalPaymentReport" class="modal-report modal modal-with-alert">

  <div class="modal__title">
    Сообщите нам об оплате
  </div>

  <form id="FormPaymentReport" autocomplete="on">
    <div class="form-row">
      <div class="col-md-6">
        <div class="form-group">
          <label>Номер заказа*</label>
          <input name="order" type="tel" class="form-control" required>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <label>Ваше имя*</label>
          <input name="name" type="text" class="form-control" required>
        </div>
      </div>
    </div>
    
    <div class="form-group">
      <label>Номер телефона*</label>
      <input name="tel" type="tel" class="form-control" value="+380" required>
    </div>
    <div class="modal__submit">
      <button type="submit" class="btn btn--black">Отправить</button>
      <div class="modal__loader"></div>
    </div>
    <div class="modal__result"></div>
  </form>

</div>