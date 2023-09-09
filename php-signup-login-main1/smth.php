<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<h1>Videos</h1>

<?php

$mysqli = require __DIR__ . "/database.php";
$id = $_SESSION['id'];

if (isset($id)) {
    $sql0 = "SELECT * FROM video";
    $result0 = $mysqli->query($sql0);
    while ($row0 = mysqli_fetch_assoc($result0)) {
        $userID = $row0["user_id"];
        $videoID = $row0["video_id"];
        $videoTitle = $row0["video_title"];
        $videoDesc = $row0["video_desc"];
        $videoPath = $row0["video_path"];

        echo "<a href='http://localhost/php-signup-login-main1/smth1.php?v=".$videoID."'>".$videoTitle."</a><br>";

    }

}



?>

</body>
</html>