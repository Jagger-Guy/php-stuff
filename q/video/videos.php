<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Videos</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../main/style.css">
</head>
<body>

<h1>Videos</h1>

<?php

$mysqli = require __DIR__ . "/../main/database.php";
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
        $tnPath = $row0["tn_path"];

        #echo "<img src='".$tnPath."?"." style='width:200px;height:200px;border-style:solid;'><br>";
        #echo "<a href='http://localhost/php-stuff/q/video/video.php?v=".$videoID."'>".$videoTitle."</a><br>";

        echo "<b><a href='http://localhost/php-stuff/q/video/video.php?v=".$videoID."'>".$videoTitle."<br>";
            echo "<img src='".$tnPath."?"." style='width:200px;height:200px;border-style:solid;'><br>";
        echo "</a><br>";

    }
} else {
    header("Location: ../main/home.php");
}

?>

</body>
</html>