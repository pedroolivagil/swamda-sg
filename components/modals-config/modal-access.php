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
<div class="collapse multi-collapse" id="collapse-connections">
    <div class="mb-3">
        <?php $isGerente = $rolController->IsGerente($user); ?>
        <select class="form-select" id="users" name="users" aria-label="select" <?= $isGerente ? '' : 'disabled'; ?> style="height:auto !important;" onchange="updateDatatable()">
            <?php
            $users = $userController->findAllFullName($user);
            foreach ($users as $key => $userTmp) {
            ?>
                <option <?= ($userTmp->GetId() == $user->GetId()) ? 'selected' : ''; ?> value="<?= $userTmp->GetFullName(); ?>"><?= $userTmp->GetFullName(); ?></option>
            <?php }
            reset($users); ?>
        </select>
    </div>
    <form>
        <?php $conections = $userController->findAllConnections($user);
        if ($isGerente) {
            foreach ($users as $userTmp) {
                if ($userTmp->GetId() != $user->GetId()) {
                    $conections = array_merge_recursive($conections, $userController->findAllConnections($userTmp));
                }
            }
        } ?>
        <table id="datatable-conections" class="table table-striped " style="width:100%">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Empleado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($conections as $connection) { ?>
                    <tr data-id="row-access-<?= $connection->GetAuth()->GetId(); ?>">
                        <td style="vertical-align:middle; width:25%;">
                            <?= Tools::formatDate($connection->GetDatelogin(), 'd-m-y'); ?>
                        </td>
                        <td style="vertical-align:middle; width:15%;">
                            <?= Tools::formatDate($connection->GetTimelogin(), 'H:i'); ?>
                        </td>
                        <td style="vertical-align:middle; width:60%;">
                            <div class=""><?= $connection->GetAuth()->GetFullName(); ?></div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </form>
</div>