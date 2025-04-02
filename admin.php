<?php
session_start();
if (!$_SESSION['admin']) {
    header("Location: /kiosk/login.php");
    exit();
}

$jsonFile = file_get_contents('leaderboard.json');
$leaderboard = json_decode($jsonFile, true);
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>Kiosk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
<!--scroll up button-->
<button
        type="button"
        class="btn btn-danger btn-floating btn-lg"
        id="btn-back-to-top"
>
    &uarr;
</button>

<div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
        <a href="/kiosk" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
            <span class="fs-4">Kiosek - Síň úspěchů</span>
        </a>

        <ul class="nav nav-pills">
            <li class="nav-item"><a href="/kiosk/leaderboard.php" target="_blank" class="nav-link">Náhled</a></li>
            <li class="nav-item"><a href="kiosk/logout.php" class="nav-link">Odhlásit se</a></li>
        </ul>
    </header>
</div>
<div class="container mt-5">
    <h1 class="text-center mb-4">Sín úspěchů</h1>
    <div class="row">
        <div class="col-4">
            <div id="list-people" class="list-group">
                <?php foreach ($leaderboard as $i => $entry): ?>
                    <a class="list-group-item list-group-item-action" href="#entry-<?= $i ?>"><?= $i + 1 ?>
                        - <?= $entry['name'] ?></a>
                <?php endforeach; ?>
            </div>

        </div>
        <div class="col-8">
            <form class="w-100 mb-4 form-floating" role="search">
                <input type="search" class="form-control" id="searchbar" placeholder="&#x1F50D;Vyhledejte jméno žáka"
                       aria-label="Vyhledávat">
                <label for="searchbar">&#x1F50D;Vyhledejte jméno žáka</label>
            </form>
            <form id="leaderboardForm" method="post" action="saveLeaderboard.php" enctype="multipart/form-data"
                  class="mb-5">
                <div id="entries" data-bs-spy="scroll" data-bs-target="#list-people" data-bs-smooth-scroll="true"
                     class="scrollspy-people accordation" tabindex="0">
                    <?php foreach ($leaderboard as $i => $entry): ?>
                        <div id="entry-<?= $i ?>" data-name="<?= $entry['name'] ?>"
                             class="accordation-item entry mb-4 p-3 border rounded">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse-<?= $i ?>" aria-expanded="true"
                                        aria-controls="collapse-<?= $i ?>">
                                    &#11206; <?= $i + 1 ?> - <?= $entry['name'] ?>
                                </button>
                            </h2>
                            <div class="accordation-collapse collapse" data-bs-parent="entries" id="collapse-<?= $i ?>">
                                <div class="row">
                                    <div class="col accordion-body">
                                        <label for="name_<?= $i ?>" class="form-label"><a href="#"
                                                                                          data-bs-toggle="tooltip"
                                                                                          class="btn"
                                                                                          data-bs-title="Uveďte celé jméno žáka">&#128712;</a>Jméno</label>
                                        <input type="text" class="form-control" id="name_<?= $i ?>"
                                               name="leaderboard[<?= $i ?>][name]"
                                               value="<?= htmlspecialchars($entry['name']) ?>" required>
                                    </div>
                                    <div class="col">
                                        <label for="classroom_<?= $i ?>" class="form-label"><a href="#"
                                                                                               data-bs-toggle="tooltip"
                                                                                               class="btn"
                                                                                               data-bs-title="Každé zaří musí někdo manualně přepsat ročníky">&#128712;</a>Třída</label>
                                        <input type="text" class="form-control" id="classroom_<?= $i ?>"
                                               name="leaderboard[<?= $i ?>][classroom]"
                                               value="<?= htmlspecialchars($entry['classroom']) ?>" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="header_<?= $i ?>" class="form-label"><a href="#"
                                                                                        data-bs-toggle="tooltip"
                                                                                        class="btn"
                                                                                        data-bs-title="Velký viditelný text">&#128712;</a>Nadpis</label>
                                    <input type="text" class="form-control" id="header_<?= $i ?>"
                                           name="leaderboard[<?= $i ?>][header]"
                                           value="<?= htmlspecialchars($entry['header']) ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="subtitle_<?= $i ?>" class="form-label"><a href="#"
                                                                                          data-bs-toggle="tooltip"
                                                                                          class="btn"
                                                                                          data-bs-title="Detalní popis">&#128712;</a>Podnadpis</label>
                                    <input type="text" class="form-control" id="subtitle_<?= $i ?>"
                                           name="leaderboard[<?= $i ?>][subtitle]"
                                           value="<?= htmlspecialchars($entry['subtitle']) ?>" required>
                                </div>
                                <label for="profile_<?= $i ?>" class="form-label"><a href="#" data-bs-toggle="tooltip"
                                                                                     class="btn"
                                                                                     data-bs-title='Při kliknutí pravým tlačítkem na jakýkoliv obrázek v prohlížeči máte možnost "Zkopírovat odkaz na obrázek", vložte tento odkaz do pole, a fotka se následně zobrazí na nástěnce'>&#128712;</a>Odkaz
                                    na profilovou fotku</label>
                                <label for="profileFile_<?= $i ?>" class="form-label">nebo nahrajte fotku z vašeho
                                    zařízení</label>
                                <div class="mb-3 input-group">
                                    <input type="text" class="form-control" id="profile_<?= $i ?>"
                                           name="leaderboard[<?= $i ?>][profile]"
                                           value="<?= htmlspecialchars($entry['profile']) ?>">
                                    <input type="file" class="form-control" id="profileFile_<?= $i ?>"
                                           name="leaderboard[<?= $i ?>][profileFile]">
                                </div>
                                <label for="bgImg_<?= $i ?>" class="form-label"><a href="#" data-bs-toggle="tooltip"
                                                                                   class="btn"
                                                                                   data-bs-title="Pozadí musí mít dostatečné rozlišení, myslete na to, že na pozadí je obrázek tmavší než ve vaší galerii">&#128712;</a>
                                    Odkaz na pozadí</label>
                                <label for="bgImgFile_<?= $i ?>" class="form-label">nebo nahrajte fotku z vašeho
                                    zařízení </label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="bgImg_<?= $i ?>"
                                           name="leaderboard[<?= $i ?>][bgImg]"
                                           value="<?= htmlspecialchars($entry['bgImg']) ?>">
                                    <input type="file" class="form-control" id="bgImgFile_<?= $i ?>"
                                           name="leaderboard[<?= $i ?>][bgImgFile]">
                                </div>
                                <button type="button" class="btn btn-danger remove-entry">Smazat zápis</button>
                                <button type="button" class="btn btn-link live-preview float-end" data-bs-toggle="modal"
                                        data-bs-target="#livePreviewModal" data-bs-entryId="<?= $i ?>">Živý náhled
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <hr>
                <button type="button" class="btn btn-primary" id="addEntry">Přidat nový zápis</button>
                <button type="submit" class="btn btn-success">Uložit změny</button>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="livePreviewModal" tabindex="-1" aria-labelledby="livePreviewModal" aria-hidden="true">
    <div class="modal-dialog modal-xl custom-modal-dialog">
        <div class="modal-content custom-modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Živý náhled</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Zavřít"></button>
            </div>
            <div class="modal-body custom-modal-body p-0">
                <div id="carouselLivePreview" class="carousel slide h-100" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselLivePreview" data-bs-slide-to="0" class="active"
                                aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselLivePreview" data-bs-slide-to="1"
                                aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselLivePreview" data-bs-slide-to="2"
                                aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-indicators goBack">
                        <h4 class="text-white-50 pb-5 fw=bold">Klikni pro vrácení na nástěnku</h4>
                    </div>
                    <div class="carousel-inner h-100">
                        <div class="carousel-item active h-100" data-bs-interval="5000">
                            <img src="https://www.ossp.cz/wp-content/uploads/2017/11/web_uvodni_foto.jpg"
                                 class="d-block w-100 h-100 object-fit-cover darkImg" alt="..." id="preview-bgImg">

                            <!-- Overlay Content -->
                            <div class="carousel-caption position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                                <div class="container text-white p-4 rounded">
                                    <div class="row align-items-center">
                                        <div class="col-md-3 text-center">
                                            <img id="preview-profile"
                                                 src="https://www.ossp.cz/wp-content/uploads/2019/10/ossp_logo_nove_white.png"
                                                 class="img-fluid rounded rounded-4">
                                        </div>
                                        <div class="col-md-9 text-start">
                                            <h1 id="preview-title" class="fw-bold display-2 mt-3">
                                                <strong>Nadpis</strong></h1>
                                            <h4 class="display-4 fw-semibold"><span id="preview-name">Jméno</span> <span
                                                        id="preview-classroom" class="fw-light">Třída</span>
                                            </h4>
                                            <h5 id="preview-subtitle" class="text-white">Podnadpis</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button"
                                data-bs-target="#carouselLeaderboardCaptions"
                                data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Předešlý</span>
                        </button>
                        <button class="carousel-control-next" type="button"
                                data-bs-target="#carouselLeaderboardCaptions"
                                data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Další</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
    let entryIndex = <?=count($leaderboard)?>;

    function initializeTooltips() {
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
    }

    $('#addEntry').click(function () {
        const newEntry = `<div id="entry-${entryIndex}" data-name="Nový zápis"
             class="accordation-item entry mb-4 p-3 border rounded">
            <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse-${entryIndex}" aria-expanded="true"
                        aria-controls="collapse-${entryIndex}">
                    &#11206; ${entryIndex + 1} - Nový zápis
                </button>
            </h2>
            <div class="accordation-collapse collapse" data-bs-parent="entries" id="collapse-${entryIndex}">
                <div class="row">
                    <div class="col accordion-body">
                        <label for="name_${entryIndex}" class="form-label"><a href="#"
                                                                              data-bs-toggle="tooltip"
                                                                              class="btn"
                                                                              data-bs-title="Uveďte celé jméno žáka">&#128712;</a>Jméno</label>
                        <input type="text" class="form-control" id="name_${entryIndex}"
                               name="leaderboard[${entryIndex}][name]"required>
                    </div>
                    <div class="col">
                        <label for="classroom_${entryIndex}" class="form-label"><a href="#"
                                                                                   data-bs-toggle="tooltip"
                                                                                   class="btn"
                                                                                   data-bs-title="Každé zaří musí někdo manualně přepsat ročníky">&#128712;</a>Třída</label>
                        <input type="text" class="form-control" id="classroom_${entryIndex}"
                               name="leaderboard[${entryIndex}][classroom]"required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="header_${entryIndex}" class="form-label"><a href="#"
                                                                            data-bs-toggle="tooltip"
                                                                            class="btn"
                                                                            data-bs-title="Velký viditelný text">&#128712;</a>Nadpis</label>
                    <input type="text" class="form-control" id="header_${entryIndex}"
                           name="leaderboard[${entryIndex}][header]"required>
                </div>
                <div class="mb-3">
                    <label for="subtitle_${entryIndex}" class="form-label"><a href="#"
                                                                              data-bs-toggle="tooltip"
                                                                              class="btn"
                                                                              data-bs-title="Detalní popis">&#128712;</a>Podnadpis</label>
                    <input type="text" class="form-control" id="subtitle_${entryIndex}"
                           name="leaderboard[${entryIndex}][subtitle]"required>
                </div>
                <label for="profile_${entryIndex}" class="form-label"><a href="#" data-bs-toggle="tooltip"
                                                                         class="btn"
                                                                         data-bs-title='Při kliknutí pravým tlačítkem na jakýkoliv obrázek v prohlížeči máte možnost "Zkopírovat odkaz na obrázek", vložte tento odkaz do pole, a fotka se následně zobrazí na nástěnce'>&#128712;</a>Odkaz
                    na profilovou fotku</label>
                <label for="profileFile_${entryIndex}" class="form-label">nebo nahrajte fotku z vašeho
                    zařízení</label>
                <div class="mb-3 input-group">
                    <input type="text" class="form-control" id="profile_${entryIndex}"
                           name="leaderboard[${entryIndex}][profile]">
                        <input type="file" class="form-control" id="profileFile_${entryIndex}"
                               name="leaderboard[${entryIndex}][profileFile]">
                </div>
                <label for="bgImg_${entryIndex}" class="form-label"><a href="#" data-bs-toggle="tooltip"
                                                                       class="btn"
                                                                       data-bs-title="Pozadí musí mít dostatečné rozlišení, myslete na to, že na pozadí je obrázek tmavší než ve vaší galerii">&#128712;</a>
                    Odkaz na pozadí</label>
                <label for="bgImgFile_${entryIndex}" class="form-label">nebo nahrajte fotku z vašeho
                    zařízení </label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="bgImg_${entryIndex}"
                           name="leaderboard[${entryIndex}][bgImg]">
                        <input type="file" class="form-control" id="bgImgFile_${entryIndex}"
                               name="leaderboard[${entryIndex}][bgImgFile]">
                </div>
                <button type="button" class="btn btn-danger remove-entry">Smazat zápis</button>
                <button type="button" class="btn btn-link live-preview float-end" data-bs-toggle="modal"
                        data-bs-target="#livePreviewModal" data-bs-entryId="${entryIndex}">Živý náhled
                </button>
            </div>
        </div>`;
        $('#entries').append(newEntry);
        $('#list-people').append(`<a class="list-group-item list-group-item-action" href="#entry-${entryIndex}">${entryIndex + 1} - Nový zápis</a>`);
        entryIndex++;
        initializeTooltips();
    });

    $(document).on('click', '.remove-entry', function () {
        $(this).closest('.entry').remove();
        const entryId = $(this).closest('.entry').attr('id');
        const entryIndex = entryId.split('-')[1];
        $(`#list-people a[href="#${entryId}"]`).remove();
    });

    let mybutton = document.getElementById("btn-back-to-top");

    window.onscroll = function () {
        scrollFunction();
    };

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }

    mybutton.addEventListener("click", backToTop);

    function backToTop() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }

    initializeTooltips();
});

    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>
<script src="js/admin.js"></script>
</body>
</html>