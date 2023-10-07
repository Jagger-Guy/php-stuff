<?php
    session_start();
    $id = $_SESSION['id'];
    $mysqli = require __DIR__ . "/../main/database.php";

    $videoID = $_GET["v"];

    $sql0 = "SELECT * FROM video WHERE video_id='$videoID'";
    $result0 = $mysqli->query($sql0);
    $result0 = mysqli_fetch_assoc($result0);
    $userID = $result0["user_id"];

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $videoRating = $result0["video_rating"];
        $ratingCount = $result0["rating_count"];
        $ratingCount = unserialize($ratingCount);

        if (isset($_POST["dislike"])) {
            if ( ! in_array($id, $ratingCount)) {
                $videoRating = $videoRating - 1;
                $idTemp = $id + ".0";
                array_push($ratingCount, $idTemp);
            } else {
                foreach ($ratingCount as $a) {
                    $b = explode(".", $a);
                    if (($b[0] == $id) && ($b[1] == 0)) {
                        $videoRating = $videoRating + 1;
                    }
                }
            }
        } elseif (isset($_POST["like"])) {
            if ( ! in_array($id, $ratingCount)) {
                $videoRating = $videoRating + 1;
                $idTemp = $id + ".1";
                array_push($ratingCount, $idTemp);
            } else {
                foreach ($ratingCount as $a) {
                    $b = explode(".", $a);
                    if (($b[0] == $id) && ($b[1] == 1)) {
                        $videoRating = $videoRating - 1;
                    }
                }
            }
        }

        $ratingCount = serialize($ratingCount);

        $sql3 = "UPDATE video SET video_rating='$videoRating', rating_count='$ratingCount' WHERE user_id='$userID'";
        $mysqli->query($sql3);
    }


?>

<!DOCTYPE html>
<html>
<head>
    <script src="https://kit.fontawesome.com/024043192c.js" crossorigin="anonymous"></script>
    <title>Videos</title>
</head>
<body>
    
<?php

if (isset($id)) {

    echo '
        <video width="960" height="480" controls>
            <source src="video-uploads/'.$videoID.".mp4".'?'.' type="video/mp4">
            Your browser does not support the video tag.
        </video><br>';
    echo "<h1><b>".$result0["video_title"]."</b></h1><h2>".$result0["video_desc"]."</h2>";

    $sql1 = "SELECT * FROM user WHERE id='$userID'";
    $result1 = $mysqli->query($sql1);
    $result1 = mysqli_fetch_assoc($result1);
    $userID = $result1["id"];
    $userName = $result1["name"];

    if ($userID == $id) {
        echo "<h2>Uploaded by: ".$userName."</h2>";
    } else {
        echo "<h2>Uploaded by: <a href='http://localhost/php-stuff/q/chat/user-profile.php?uid=".$userID."'>".$userName."</a></h2>";
    }

    echo "<form method='post'>
            <button name='dislike'style='font-size:30px;position:absolute;bottom:180px;right:600px;'> 
            <i class='fas fa-thumbs-down'> Dislike</i>
        </button>";
    echo "
        <button name='like'style='font-size:30px;position:absolute;bottom:180px;right:775px;'> 
            <i class='fas fa-thumbs-up'> Like</i>
        </button></form>";
    echo $ratingCount;
    echo "This video has ".$result0["video_rating"]." rating.<br>";
    
} else {
    header("Location: ../main/home.php");
}

?>

</body>
</html>
