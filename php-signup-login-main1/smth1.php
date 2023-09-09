<?php
    session_start();
    $id = $_SESSION['id'];
    $mysqli = require __DIR__ . "/database.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Video Page</title>
</head>
<body>
    
<?php

$videoID = $_GET["v"];


if (isset($id)) {

    $sql0 = "SELECT * FROM video WHERE video_id='$videoID'";
    $result0 = $mysqli->query($sql0);
    $user = mysqli_fetch_assoc($result0);
    $userID = $user["user_id"];
    echo '
        <video width="320" height="240" controls>
            <source src="uploads/'.$videoID.".mp4".'?'.' type="video/mp4">
            Your browser does not support the video tag.
        </video><br>';
    echo "Video title: ".$user["video_title"]."<br>Video description: ".$user["video_desc"]."<br>";

    $sql1 = "SELECT name FROM user WHERE id='$userID'";
    $result1 = $mysqli->query($sql1);
    $result1 = mysqli_fetch_assoc($result1);

    echo "Uploaded by: ".$result1["name"];

    


   
            
    

    
}




?>

</body>
</html>
