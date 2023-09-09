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
    $sql0 = "SELECT id FROM user";
    $result0 = $mysqli->query($sql0);
    while ($row0 = mysqli_fetch_assoc($result0)) {
        $userID = $row0["id"];
        $sql1 = "SELECT video_num FROM user WHERE id='$userID'";
        $result1 = $mysqli->query($sql1);
        while ($row1 = mysqli_fetch_assoc($result1)) {
            $videoID = $row1["video_num"];
            for ($x = 1; $x <= $videoID; $x++) {
                echo '
                <video width="320" height="240" controls>
                <source src="uploads/profile'.$userID.$x.".mp4".'?'.' type="video/mp4">
                Your browser does not support the video tag.
                </video>';
            }
        }
    }
} 


?>



</body>
</html>