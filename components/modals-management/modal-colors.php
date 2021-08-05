<script>
    var table;

    function updateDatatable() {
        table.draw('full-hold');
    }
    $(document).ready(function() {
        table = $('#datatable-colors').DataTable({
            "info": false,
            "pagingType": 'full',
            "pageLength": 6,
            "lengthChange": false,
            "searching": false,
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
        $('.texto-prueba-color').click(function(args) {
            $('#' + $(this).attr('data-bs-id')).click();
        });
    });
</script>

<?php
$disabled = ($rolController->isGerente($user)) ? '' : 'disabled';
$users = $userController->findAllColorManagement();
?>

<div class="collapse multi-collapse" id="collapse-colors">
    <form onsubmit="return false;">
        <table id="datatable-colors" class="table table-striped " style="width:100%">
            <thead>
                <tr>
                    <th>Empleado</th>
                    <th>Color</th>
                    <!-- <th class="hidden">Acción</th> -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $usertmp) { ?>
                    <tr data-id="row-access-<?= $usertmp->GetId(); ?>">
                        <td style="vertical-align:middle; width:60%;">
                            <?= $usertmp->GetFullName(); ?>
                        </td>
                        <td style="vertical-align:middle; width:40%;">
                            <input id="user-id<?= $usertmp->GetId(); ?>" type="hidden" value="<?= $usertmp->GetId(); ?>" />
                            <input class="form-control form-control-color" data-bs-iduser="<?= $usertmp->GetId(); ?>" id="color-user<?= $usertmp->GetId(); ?>" type="color" value="<?= $usertmp->GetColor(); ?>" onchange="editColorUsers(this)" />
                            <div class="texto-prueba-color fs-7" style="color: <?= Tools::getContrastYIQ($usertmp->GetColor()); ?>" data-bs-id="color-user<?= $usertmp->GetId(); ?>">Texto de prueba</div>
                        </td>
                        <!-- <td class="hidden" style="vertical-align:middle; width:15%;">
                            <button class="btn btn-sm btn-primary" data-bs-iduser="<?= $usertmp->GetId(); ?>" type="submit" onclick="editColorUsers(this);">Cambiar</button>
                        </td> -->
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </form>
    <div id="result-panel-modal-gestion-event-color" class="mt-3"></div>
</div>