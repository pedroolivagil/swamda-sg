<div class="collapse multi-collapse" id="collapse-password">
    <form onsubmit="editPassword();return false;">
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="old-password" required aria-describedby="passwordHelpBlockOld">
            <label for="old-password">Contraseña actual</label>
            <div id="passwordHelpBlockOld" class="form-text fs-7 ps-2">Tu contraseña actual para validar los
                cambios</div>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="new-password-1" required>
            <label for="new-password-1">Nueva contraseña</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="new-password-2" required aria-describedby="passwordHelpBlock">
            <label for="new-password-2">Repite la nueva contraseña</label>
            <div id="passwordHelpBlock" class="form-text fs-7 ps-2">La contraseña debe tener entre 8 y 20
                caracteres, contener letras y números, y no debe contener espacios, caracteres especiales ni
                emoji.</div>
        </div>
        <div id="result-panel-modal-conf-event-pass"></div>
        <div class="width-100">
            <button type="submit" class="btn btn-primary width-100">Cambiar contraseña</button>
        </div>
    </form>
</div>