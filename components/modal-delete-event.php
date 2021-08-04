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
        var table;

        function updateDatatable() {
            table.search($('#users').val()).draw('full-hold');
        }
        $(document).ready(function() {
            table = $('#datatable-delete-events').DataTable({
                "info": false,
                "pagingType": 'full',
                "pageLength": 5,
                "lengthChange": false,
                "searching": true,
                "ordering": false,
                "language": {
                    "zeroRecords": "No hay registros para este empleado",
                    "emptyTable": "No hay registros en la base de datos",
                    "paginate": {
                        "first": "Primera",
                        "previous": "Anterior",
                        "next": "Siguiente",
                        "last": "Última"
                    }
                },
            });
            updateDatatable();
        });
    </script>
</head>

<body>
    <div class="modal-header">
        <h5 class="modal-title" id="adminModalLabel">Eliminar evento</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="mb-3">
            <select class="form-select" id="users" name="users" size="3" aria-label="multiple select" style="height:auto !important;" onchange="updateDatatable()">
                <?php $users = $userController->findAllFullName();
                foreach ($users as $key => $user) {
                ?>
                    <option <?= ($key == 0) ? 'selected' : ''; ?> value="<?= $user->GetFullName(); ?>">
                        <?= $user->GetFullName(); ?></option>
                <?php } ?>
            </select>
        </div>
        <form>
            <?php reset($users); //$users = $userController->findAllAddEvent();
            $events = $calendarController->findAll();
            foreach ($events as $event) {
                foreach ($users as $user) {
                    if ($user->GetId() == $event->GetAuth()) {
                        $event->SetAuth($user);
                    }
                }
            }
            reset($events);
            ?>
            <table id="datatable-delete-events" class="table table-striped " style="width:100%" data-order='[[ 2, "asc" ]]'>
                <thead>
                    <tr>
                        <th style="width:5%;">&nbsp;</th>
                        <th style="width:35%;">Evento [Hora]</th>
                        <th style="width:50%;">Fecha</th>
                        <!-- <th style="width:22%;">Empleado</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php $pattern = 'd-m-y';
                    foreach ($events as $event) { ?>
                        <tr data-id="<?= $event->GetId(); ?>">
                            <td style="width:5%; opacity:.7; vertical-align:middle;">
                                <a href="#" onclick="deleteCalendarDatatItem(this, <?= $event->GetId(); ?>);"><i class="bi bi-trash-fill text-danger"></i></a>
                            </td>
                            <td style="width:35%;"><?= ucfirst($event->GetTitle()); ?>
                                <div class="text-muted fs-7">
                                    <?= ((empty($event->GetStartTime())) ? '' : '[' . $event->GetStartTime()) . (!empty($event->GetEndTime()) ? ' / ' . $event->GetEndTime() . ']' : (empty($event->GetStartTime()) ? '' : ']')); ?>
                                </div>
                            </td>
                            <td style="width:50%;">
                                <?= Tools::formatDate($event->GetStartDate(), $pattern) . (!empty($event->GetEndDate()) ? ' / ' . Tools::formatDate($event->GetEndDate(), $pattern) : ''); ?>
                                <div class="text-muted fs-7"><?= $event->GetAuth()->GetFullName(); ?></div>
                            </td>
                            <!-- <td style="width:22%;"><?= $event->GetAuth()->GetShortFullName(); ?></td> -->
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </form>
    </div>
    <div id="result-panel-modal-delete-event"></div>
    <!-- <div class="modal-footer width-100">
        <button type="button" class="btn btn-primary width-100">Aceptar</button>
    </div> -->
</body>

</html>