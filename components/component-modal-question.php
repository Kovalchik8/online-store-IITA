<div id="ModalQuestion" class="modal-question modal modal-with-alert">

  <div class="modal__title">
    Задать вопрос
  </div>

  <form id="FormQuestion" autocomplete="on">
    <div class="form-row">

      <div class="col-md-6">
        <div class="form-group">
          <label>Ваше имя*</label>
          <input name="name" type="text" class="form-control" required> 
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <label>Эл почта*</label>
          <input name="email" type="email" class="form-control" required>
        </div>
      </div>

    </div>

    <div class="form-group">
        <label>Сообщение*</label>
        <textarea name="message" class="form-control" rows="3" required></textarea>
      </div>
    
    <div class="modal__submit">
      <button type="submit" class="btn btn--black">Отправить</button>
      <div class="modal__loader"></div>
    </div>
    <div class="modal__result"></div>
  </form>

</div>