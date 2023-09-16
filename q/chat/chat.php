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

<h1>Chat</h1>
<i class='fas fa-comment-alt' style='font-size:36px'></i>

<form action="upload-post.php" method="post">
    <p>Talk</p>
    <input type="text" name="post_upload">
    <button type="submit" name="submit3">Upload</button>
</form><br>

<?php

$mysqli = require __DIR__ . "/../main/database.php";
$id = $_SESSION['id'];

if (isset($id)) {

    $sql1 = "SELECT * FROM post";
    $result1 = $mysqli->query($sql1);
    while ($row1 = mysqli_fetch_assoc($result1)) {
        $buttonID = $row1["id"];
        $postsName = $row1["posts"];
        $userID = $row1["uid"];
        $date = $row1["date"];
        $sql0 = "SELECT name FROM user WHERE id='$userID'";
        $result0 = $mysqli->query($sql0);
        while ($row0 = mysqli_fetch_assoc($result0)) {
            $userName = $row0["name"];
            if ($id == $userID) {
                echo $userName."</a> says: ".$postsName." - at ".$date.
                "<a href='http://localhost/php-stuff/q/chat/delete-post.php?btnid=".$buttonID."'> Delete</a><br>";
            } else {
                echo "<a href='http://localhost/php-stuff/q/chat/user.php?uid=".$userID."'>".$userName."</a> says: ".$postsName." - at ".$date."<br>";
            }
        }
    }   
} 

?>

<br><a href="http://localhost/php-stuff/q/index/profile.php">Go back to profile</a>

</body>
</html>