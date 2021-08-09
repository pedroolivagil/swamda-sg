<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>SWAMDA SG</title>
</head>

<body>
    <div id="login-card" class="center-loader">
        <div class="card login-card">
            <div class="card-header text-center">
                <a class="navbar-brand title">SWAMDA SG</a>
            </div>
            <!-- <div class="card-header">
                Inicia sesión
            </div> -->
            <div class="card-body">
                <form onsubmit="loginCard();return false;">
                    <div class="mb-3">
                        <input type="text" class="form-control me-2" placeholder="Usuario" id="usercard" required>
                    </div>
                    <div class="mb-3 input-group" id="password-login-div">
                        <input type="password" class="form-control" placeholder="Contraseña" id="passcard" required>
                        <div class="input-group-text" onclick="labelShowHidePassword('password-login-div');">
                            <i class="bi bi-eye-slash" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="login-error-mesages" id="modal-info-wrapper"></div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            <div class="card-footer bg-transparent">
                <a href="#" class="fs-7" id="recovery-button" data-bs-toggle="modal" data-bs-target="#recoveryModal" data-bs-blur-panels="#login-card">He olvidado la contraseña</a>
            </div>
        </div>
    </div>
</body>

</html>