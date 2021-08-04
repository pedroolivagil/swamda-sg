<?php session_start(); 
date_default_timezone_set('UTC');
require_once('../config.php');
require_once('../server/controllers/controllers.php');
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>SWAMDA SG</title>
    <script>
    $(document).ready(function() {
        $('#optional-panel-hiden-add-event').hide(0);
    });
    </script>
</head>

<body>
    <div class="modal-header">
        <h5 class="modal-title" id="adminModalLabel">Añadir evento</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="title" required>
                <label for="title">Título del evento</label>
            </div>
            <div class="form-floating mb-3">
                <select class="form-select" id="users" name="users" size="3" multiple aria-label="multiple select" required
                    style="height:auto !important;">
                    <?php $users = $userController->findAllFullName();
                        foreach($users as $user) {
                    ?>
                    <option value="<?=$user->GetId(); ?>"><?=$user->GetFullName(); ?></option>
                    <?php } ?>
                </select>
                <label for="users">Selecciona los usuarios</label>
            </div>
            <div class="form-floating mb-3">
                <input type="date" class="form-control" id="start" required min="<?=date('Y-m-d');?>" onchange="updateMinDate('end', this.value)">
                <label for="start">Fecha inicio del evento</label>
            </div>

            <div class="more-options"
                onclick="togglePanel('optional-panel-hiden-add-event', 'more-options-add-event', 'Más opciones','Menos opciones')">
                <div>[</div>
                <div id="more-options-add-event">Más opciones</div>
                <div></div>
            </div>

            <div id="optional-panel-hiden-add-event">
                <div class="form-floating mb-3">
                    <input type="date" class="form-control" id="end" min="<?=date('Y-m-d');?>">
                    <label for="end">Fecha fin del evento (opcional)</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="url">
                    <label for="url">URL del evento (opcional)</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="time" class="form-control" id="startTime">
                    <label for="startTime">Hora inicio del evento (opcional)</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="time" class="form-control" id="endTime">
                    <label for="endTime">Hora fin del evento (opcional)</label>
                </div>
            </div>
        </form>
    </div>
    <div id="result-panel-modal-add-event"></div>
    <div class="modal-footer width-100">
        <button type="button" class="btn btn-primary width-100" onclick="addCalendarEvent();">Aceptar</button>
    </div>
</body>

</html>