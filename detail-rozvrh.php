<?php
require_once "rozvrhy.php";
$class = filter_input(INPUT_GET, "class");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timetable</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        .iframe-container {
            position: relative;
            width: 100%;
            height: 100%;
        }

        .responsive-iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        .home-button {
            position: absolute;
            bottom: 20px;
            right: 20px;
            z-index: 10; /* Ensure it stays on top of the iframe */
            font-weight: bold;
            padding: 15px 30px;
            background-color: #e74c3c;
            color: white;
            border-radius: 8px;
            text-align: center;
            text-decoration: none;
        }

        .home-button:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
<div class="iframe-container">
    <?php
    if ($class === 'total') {
        ?>
        <iframe src="https://ossp.bakalari.cz/Timetable/Public" class="responsive-iframe"></iframe>

        <?php
    } else {
        ?>
        <iframe src="<?= $rozvrhy[$class] ?>" class="responsive-iframe"></iframe>

        <?php
    }
    ?>
    <a href="index.php" class="home-button btn btn-lg btn-danger">Nástěnka</a>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

</body>
</html>
