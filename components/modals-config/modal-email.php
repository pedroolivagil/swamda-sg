<div class="collapse multi-collapse" id="collapse-email">
    <form onsubmit="editEmail();return false;">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="oldemail" value="<?= $user->GetEmail(); ?>" disabled>
            <label for="oldemail">Email</label>
        </div>
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="email" required value="<?= $user->GetEmail(); ?>">
            <label for="email">Nuevo email</label>
        </div>
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="email-2" required>
            <label for="email-2">Confirma el email</label>
        </div>
        <div id="result-panel-modal-conf-event-email"></div>
        <div class="width-100">
            <button type="submit" class="btn btn-primary width-100">Cambiar email</button>
        </div>
    </form>
</div>