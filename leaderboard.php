<?php
require_once "rozvrhy.php";
$leaderboard = json_decode(file_get_contents("leaderboard.json"), true);
if (isset($_POST['demoLeaderboard'])) {
    $leaderboard = $_POST['demoLeaderboard'];
}
$leaderboard = array_reverse($leaderboard);
if ($leaderboard == []) {
    $leaderboard = [
        [
            "header" => "Síň úspěchů",
            "name" => "",
            "classroom" => "",
            "subtitle" => "Úspěchy žáků",
            "profile" => "https://www.ossp.cz/wp-content/uploads/2019/10/ossp_logo_nove_white.png",
            "bgImg" => "https://www.ossp.cz/wp-content/uploads/2017/11/web_uvodni_foto.jpg"
        ]
    ];
}
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>Kiosk</title>

    <link rel="stylesheet" href="css/leaderboard.css">
</head>
<body>
<div class="container">
    <h1 class="text-white header-absolute fw-bold text-uppercase display-1 position-absolute start-50 translate-middle">Síň úspěchů</h1>
    <div id="carouselLeaderboardCaptions" class="carousel carcousel-w100-h100 slide position-absolute top-0 start-0" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <?php foreach ($leaderboard as $i => $v) { ?>
                <button type="button" data-bs-target="#carouselLeaderboardCaptions" data-bs-slide-to="<?= $i ?>"
                        class="<?= $i == 0 ? 'active' : '' ?>" aria-current="true" aria-label="Slide 1"></button>
            <?php } ?>
        </div>
        <div class="carousel-indicators goBack">
            <h4 class="text-white-50 pb-5 fw=bold">Klikni pro vrácení na nástěnku</h4>
        </div>
        <div class="carousel-inner goBack">
        <?php foreach ($leaderboard as $i => $v) { ?>
            <div class="carousel-item <?= $i == 0 ? 'active' : '' ?> vh-100 position-relative" data-bs-interval="5000">
                <!-- Background Image -->
                <img src="<?= $v['bgImg']==''?"https://www.ossp.cz/wp-content/uploads/2017/11/web_uvodni_foto.jpg":$v['bgImg'] ?>" class="d-block w-100 vh-100 object-fit-cover darkImg" alt="...">

                <!-- Overlay Content -->
                <div class="carousel-caption position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                    <div class="container text-white  p-4 rounded">
                        <div class="row align-items-center">
                            <!-- Profile Picture -->
                            <div class="col-md-3 text-center">
                                <img src="<?=$v['profile'] == '' ? "https://www.ossp.cz/wp-content/uploads/2019/10/ossp_logo_nove_white.png" : $v['profile']?>" class="img-fluid rounded rounded-4 ">
                            </div>

                            <div class="col-md-9 text-start">
                                <h1 class="fw-bold display-2 mt-3"><strong><?= $v["header"] ?></strong></h1>
                                <h4 class="display-4 fw-semibold"><?= $v["name"] ?> <span
                                            class="fw-light"><?= $v['classroom'] ?></span></h4>
                                <h5 class="text-white"><?= $v["subtitle"] ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselLeaderboardCaptions"
            data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Předešlý</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselLeaderboardCaptions"
            data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Další</span>
    </button>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
<script src="js/main.js"></script>
<script src="js/leaderboard.js">

</script>
</body>
</html>