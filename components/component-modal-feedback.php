<div id="ModalFeedback" class="modal-feedback modal modal-with-alert">

  <div class="modal__title">
    Оставьте нам свои данные,<br> и мы перезвоним Вам в ближайшее время
  </div>

  <form id="FormFeedback" autocomplete="on">
    <div class="form-group">
      <label>Ваше имя*</label>
      <input name="name" type="text" class="form-control" required>
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