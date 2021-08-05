<script>
    var table;

    function updateDatatable() {
        table.search($('#users').val()).draw('full-hold');
    }
    $(document).ready(function() {
        table = $('#datatable-conections').DataTable({
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

<?php
$disabled = ($rolController->isGerente($user)) ? '' : 'disabled';
$users = $userController->findAllColorManagement();
?>

<div class="collapse multi-collapse" id="collapse-colors">
    <form>
        <table id="datatable-conections" class="table table-striped " style="width:100%">
            <thead>
                <tr>
                    <th>Empleado</th>
                    <th>Color</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $usertmp) { ?>
                    <tr data-id="row-access-<?= $usertmp->GetId(); ?>">
                        <td style="vertical-align:middle; width:60%;">
                            <?= $usertmp->GetFullName(); ?>
                        </td>
                        <td style="vertical-align:middle; width:15%;">
                            <input type="color" value="<?= $usertmp->GetColor(); ?>" />
                        </td>
                        <td style="vertical-align:middle; width:25%;">
                            <div class="">Cambiar</div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </form>
</div>