<?php session_start();
$component = isset($_SESSION['AUTH']) ? 'login-succes' : 'login-fail';
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>SWAMDA SG</title>
    <script>
    $(document).ready(function() {
        $('#login-wrapper').load('components/<?=$component; ?>.php');
    });
    </script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand title">SWAMDA SG</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01"
                aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <div class="navbar-nav me-auto mb-2 mb-lg-0" style="height:5px;"></div>
                <div id="login-wrapper"></div>
            </div>
        </div>
    </nav>
</body>

</html>