<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>SWAMDA SG</title>
</head>

<body>
    <div class="center-loader">
        <div class="card login-card">
            <div class="card-header">
                Inicia sesión
            </div>
            <div class="card-body">
                <form onsubmit="loginCard();return false;">
                    <div class="mb-3">
                        <input type="text" class="form-control me-2" placeholder="Usuario" id="usercard" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control me-2" placeholder="Contraseña" id="passcard" required>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            <div class="card-footer bg-transparent">
                <a href="#" class="fs-7">He olvidado la contraseña</a>
            </div>
        </div>
    </div>
</body>

</html>