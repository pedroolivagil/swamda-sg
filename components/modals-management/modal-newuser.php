<?php $disabled = ($rolController->isGerente($user)) ? '' : 'disabled'; ?>
<div class="collapse multi-collapse" id="collapse-newuser">
    <form onsubmit="editColor();return false;">
        <div class="form-floating mb-3">
            <input type="color" class="form-control" id="color" required value="<?= $user->GetColor(); ?>" <?= $disabled;?>>
            <label for="color">Color de usuario</label>
        </div>
        <div id="result-panel-modal-conf-event-color"></div>
        <div class="width-100">
            <button type="submit" class="btn btn-primary width-100">Cambiar color</button>
        </div>
    </form>
</div>