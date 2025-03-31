<?php
require_once "rozvrhy.php";
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1920, initial-scale=1.0">
    <title>Kiosk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-size: 28px;
            touch-action: manipulation;
            height: 100vh;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container {
            max-width: 1800px;
            width: 100%;
        }
        .time, .date {
            font-size: 42px;
            font-weight: bold;
            padding: 15px;
            border-radius: 10px;
            background: white;
            display: inline-block;
            margin-bottom: 25px;
        }
        .btn-medium {
            font-size: 32px;
            padding: 20px;
            width: 100%;
            height: 90px;
        }
    </style>
</head>
<body>

<div class="container text-center">
    <h1 class="my-3 fw-bold display-3">Nástěnka školy</h1>

    <div class="mb-3">
        <h1 class="date shadow-sm"><span id="date-now">---</span></h1>
        <h1 class="time shadow-sm"><span id="time-now">---</span></h1>
        <h1 class="time shadow-sm"><span id="now-is">---</span></h1>
        <h1 class="time shadow-sm">Svátek: <span id="name-day">---</span></h1>
    </div>

    <div class="row justify-content-center">
        <?php
        $counter = 0;
        $colors = ['btn-success', 'btn-primary', 'btn-warning', 'btn-danger'];

        foreach ($rozvrhy as $rozvrh => $key) {
            $color = $colors[intdiv($counter, 6) % count($colors)];
            echo '<div class="col-4 col-md-3 col-lg-2 mb-3">';
            echo '<a class="btn ' . $color . ' btn-medium fw-bold shadow" href="detail-rozvrh.php?class=' . $rozvrh . '">' . $rozvrh . '</a>';
            echo '</div>';
            $counter++;
        }
        ?>
    </div>

    <div class="row justify-content-center mt-3">
        <?php
        foreach ($buttons as $button => $key) {
            echo '<div class="col-4 col-md-3 col-lg-2 mb-3">';
            echo '<a class="btn btn-secondary btn-medium fw-bold shadow" href="detail-obecny.php?button=' . $button . '">' . $button . '</a>';
            echo '</div>';
        }
        ?>
        <div class="col-4 col-md-3 col-lg-2 mb-3">
            <a class="btn btn-secondary btn-medium fw-bold shadow" href="leaderboard.php">Síň úspěchů</a>
        </div>
    </div>
</div>
<div id="easter-egg" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 20px; border: 2px solid black; z-index: 1000;">
    <h1 class="text-center">Ahoj, našel jsi easter egg od Matouše, dneska budeš mít štěstí</h1>
    <h4 class="text-center">Matouš Drábek, 3.C 2024</h4>
    <p class="text-center">Dej mi vedět jestli tohle najdeš (pokud tady ještě budu :D)</p>
    <pre class="text-center"> IG: @whos.matous</pre>
    <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
        <div class="progress-bar" style="width: 0%"></div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/main.js"></script>
<script src="js/gotoLb.js"></script>
</body>
</html>
