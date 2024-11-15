<?php
require_once "rozvrhy.php";
?>
<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>Kiosk</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.min.css">
    <style>
        .pig {
            position: absolute;
            left: 80%;
            bottom: 100px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- <div class="col-5"> -->
            <!-- <img src="" alt="banner" class="img-fluid"> -->
            <!-- </div> -->
            <div class="col-12 text-center">
                <div class="row">
                    <div class="col-12">
                        <h1 class="my-5">Nástěnka školy</h1>
                    </div>
                </div>
                <div class="row">
                    <!--<a class="btn btn-primary font-weight-bold px-5 py-4"
                    href="detail-rozvrh.php?class=total">
                        Celkový rozvrh
                    </a>-->

                    <?php
                    $counter = 0;
                    $color = 'btn-success';
                    foreach ($rozvrhy as $rozvrh => $key) {
                    ?>
                        <div class="col-6 col-md-2 mb-5 text-center">
                            <a class="btn btn-success btn-lg font-weight-bold px-5 py-4 <?= $color ?>" href="detail-rozvrh.php?class=<?= $rozvrh ?>">
                                <?= $rozvrh ?>
                            </a>
                        </div>
                    <?php
                        $counter++;
                        ($counter == 6) ? $color = 'btn-info' : null;
                        ($counter == 12) ? $color = 'btn-warning' : null;
                        ($counter == 18) ? $color = 'btn-danger' : null;
                    }
                    ?>
                </div>
                <div class="row">
                    <?php
                    foreach ($buttons as $button => $key) { ?>
                        <div class="col-6 col-md-2 mb-5 text-center">
                            <a class="btn btn-secondary btn-lg font-weight-bold px-5 py-4" href="detail-obecny.php?button=<?= $button ?>">
                                <?= $button ?>
                            </a>
                        </div>
                    <?php }
                    ?>
                    <?php /*<div class="col-6 col-md-2 mb-5 text-center">
                        <a class="btn btn-secondary btn-lg font-weight-bold px-5 py-4" 
                        href="detail-projekt.php">
                            Rozpis projektů
                        </a>
                    </div>*/
                    ?>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="text-center time"><span id="time-now"></span></h1>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="js/main.js"></script>
    <script>
        /*document.querySelector(".pig").addEventListener('click', function() {
            alert('Chro chro, běž se učit!');
        });*/
    </script>
</body>

</html>