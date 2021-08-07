<div class="modal fade" id="recoveryModal" tabindex="-1" aria-labelledby="recoveryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="admin-modal-body">
            <div class="modal-header">
                <h5 class="modal-title" id="recoveryModalLabel">He olvidado la contraseña</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form onsubmit="recoveryPass();return false;">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="email" required>
                        <label for="email">Email o usuario de registro</label>
                    </div>
                    <div id="result-panel-modal-recovery-pass-email"></div>
                    <div class="width-100">
                        <button type="submit" class="btn btn-primary width-100">Regenerar contraseña</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>