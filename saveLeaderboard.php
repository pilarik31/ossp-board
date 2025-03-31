<?php
session_start();
if (!$_SESSION['admin']) {
    header("Location: login.php");
    exit();
}

$leaderboard = array_values($_POST['leaderboard']);
$uploadDir = 'img/leaderboard/';

foreach ($leaderboard as $i => &$entry) {
    // Handle profile image upload
    if (isset($_FILES['leaderboard']['name'][$i]['profileFile']) && $_FILES['leaderboard']['name'][$i]['profileFile'] !== '') {
        $profileFileName = basename($_FILES['leaderboard']['name'][$i]['profileFile']);
        $profileFilePath = $uploadDir . $profileFileName;
        if (move_uploaded_file($_FILES['leaderboard']['tmp_name'][$i]['profileFile'], $profileFilePath)) {
            $entry['profile'] = $profileFilePath;
        }
    }

    // Handle background image upload
    if (isset($_FILES['leaderboard']['name'][$i]['bgImgFile']) && $_FILES['leaderboard']['name'][$i]['bgImgFile'] !== '') {
        $bgImgFileName = basename($_FILES['leaderboard']['name'][$i]['bgImgFile']);
        $bgImgFilePath = $uploadDir . $bgImgFileName;
        if (move_uploaded_file($_FILES['leaderboard']['tmp_name'][$i]['bgImgFile'], $bgImgFilePath)) {
            $entry['bgImg'] = $bgImgFilePath;
        }
    }
}

// Save the updated leaderboard to the JSON file
file_put_contents('leaderboard.json', json_encode($leaderboard, JSON_PRETTY_PRINT));

header("Location: admin.php");
exit();
?>