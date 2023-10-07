<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/024043192c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../main/style.css">
</head>
<body>

<?php

$mysqli = require __DIR__ . "/../main/database.php";
$id = $_SESSION['id'];
$userID = $_GET["uid"];

if (isset($id)) {

    $sql = "SELECT * FROM user WHERE id='$userID'";
    $result = $mysqli->query($sql);
    $result = mysqli_fetch_assoc($result);

    if ($result["profile_status"] == 1) {
        echo "<img src='../index/uploads/profile".$userID.".".$result["profile_ext"]."?"." style='width:200px;height:200px;border-style:solid;'><br>";
    } else {
        echo "<img src='../index/uploads/profiledefault.png' style='width:200px;height:200px;'><br>";
    }

    echo "<h3><u>".$result["name"]."</u></h3>";
    echo "Profile description: ".$result["profile_desc"]."<br>";

    if ($result["video_num"] == 0) {
        echo "This user has not uploaded any videos.<br>";
    } elseif ($result["video_num"] == 1) {
        echo "This user has uploaded 1 video.<br>";
    } else {
        echo "This user has uploaded ".$result["video_num"]." videos.<br>";
    }

    if ($result["profile_followers"] == 0) {
        echo "This user has no followers.<br>";
    } elseif ($result["profile_followers"] == 1) {
        echo "This user has 1 follower.<br>";
    } else {
        echo "This user has ".$result["profile_followers"]." followers.<br>";
    }

    echo "<br><a href='http://localhost/php-stuff/q/chat/user-followers.php?uid=".$userID."'>Follow this user</a>";

    if (isset($_SESSION["error2"])) {
        echo "<br>".$_SESSION["error2"];
    }

} else {
    header("Location: ../main/home.php");
}

?>

</body>
</html>