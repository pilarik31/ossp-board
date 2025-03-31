<?php
if (isset($_SESSION['admin']) && $_SESSION['admin']) {
    header('Location: /admin');
    exit();
}
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>Kiosk</title>
    <link rel="stylesheet" href="css/style.min.css">
</head>
<body>
<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="card shadow p-4 card-400">
        <h3 class="text-center mb-4">Síň úspěchů</h3>
        <form id="loginForm" novalidate method="post" action="auth.php" name="loginForm">
            <div class="mb-3">
                <label for="password" class="form-label">Heslo</label>
                <input name="loginForm[password]" type="password" class="form-control" id="password" placeholder="Zadejte heslo" required>
                <?php
                if (isset($_GET['error'])) {
                    echo '<div class="text-danger">Neplatné heslo.</div>';
                }
                ?>
            </div>
            <div class="d-grid">
                <button id="loginFormButton" class="btn btn-primary">Přihlásit se</button>
            </div>
        </form>
        <a href="/" class="btn btn-link text-start pt-3"> &#8592; Zpět</a>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="js/main.js"></script>
</body>
</html>