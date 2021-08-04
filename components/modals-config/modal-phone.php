<div class="collapse multi-collapse" id="collapse-phone">
    <form onsubmit="editPhone();return false;">
        <div class="form-floating mb-3">
            <input type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{3}" class="form-control telephone" id="phone" required value="<?= $user->GetPhone(); ?>">
            <label for="phone">Teléfono</label>
        </div>
        <div id="result-panel-modal-conf-event-phone"></div>
        <div class="width-100">
            <button type="submit" class="btn btn-primary width-100">Cambiar teléfono</button>
        </div>
    </form>
</div>