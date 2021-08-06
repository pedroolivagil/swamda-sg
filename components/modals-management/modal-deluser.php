<?php 
$isAdmin = $rolController->isAdministrador($user) ? true : false;
$disabled = $isAdmin ? '' : 'disabled';
?>
<div class="collapse multi-collapse" id="collapse-deluser">
    <div>
        <?= !$isAdmin ? Tools::printWarnAlert("Necesitas permisos de administrador para realizar esta acción.", false, 'fs-8 text-center') : ''; ?>
    </div>
    <form onsubmit="delUser();return false;">
        <div class="mb-3">
            <?php $users = $userController->findAllFullName($user, true); ?>
            <select class="form-select" id="users" name="users" aria-label="select" <?= $disabled; ?>>
                <?php
                foreach ($users as $key => $usertmp) {
                ?>
                    <option <?= ($key == 0) ? 'selected' : ''; ?> value="<?= $usertmp->GetId(); ?>">
                        <?= $usertmp->GetFullName(); ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="password" required aria-describedby="passwordHelpBlockOld" <?= $disabled; ?>>
            <label for="password">Contraseña</label>
            <div id="passwordHelpBlockOld" class="form-text fs-7 ps-2">Tu contraseña de usuario para validar los cambios</div>
        </div>
        <div id="result-panel-modal-gestion-event-deluser"></div>
        <div class="width-100">
            <button type="submit" class="btn btn-primary width-100" <?= $disabled; ?>>Dar de baja</button>
        </div>
    </form>
</div>