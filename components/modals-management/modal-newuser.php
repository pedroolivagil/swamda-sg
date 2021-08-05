<?php $disabled = ($rolController->isGerente($user)) ? '' : 'disabled'; ?>
<div class="collapse multi-collapse" id="collapse-newuser">
    <form onsubmit="newUser();return false;">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="realname" required>
            <label for="realname">Nombre</label>
            <!-- <div id="realname" class="form-text fs-7 ps-2">Tu nombre</div> -->
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="realsurname" required>
            <label for="realsurname">Apellidos</label>
            <!-- <div id="realname" class="form-text fs-7 ps-2">Tu nombre</div> -->
        </div>
        <div class="form-floating mb-3">
            <input type="tel" pattern="[0-9]{3} [0-9]{3} [0-9]{3}" class="form-control telephone" id="phone" required>
            <label for="phone">Teléfono</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="email" required>
            <label for="email">Email</label>
            <div id="email" class="form-text fs-7 ps-2">El usuario, la contraseña y el color del empleado se genera automáticamente.</div>
        </div>
        <div id="result-panel-modal-gestion-event-newuser"></div>
        <div class="width-100 text-center">
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="reset" class="btn btn-secondary">Borrar campos</button>
                <button type="submit" class="btn btn-primary">Añadir empleado</button>
            </div>
        </div>
    </form>
</div>