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

<h1>Posts</h1>

<form action="uploadPost.php" method="post">
    <p>Upload post</p>
    <input type="text" name="post_upload">
    <button type="submit" name="submit3">Upload</button>
</form>
<p><a href="mainPosts.php">View all posts from users</a></p>
<p><a href="logout.php">Log out</a></p>

<?php

$mysqli = require __DIR__ . "/database.php";
$id = $_SESSION['id'];

if (isset($id)) {

    $sql1 = "SELECT posts, uid, date FROM post";
    $result1 = $mysqli->query($sql1);
    while ($row1 = mysqli_fetch_assoc($result1)) {
        $postsName = $row1["posts"];
        $userID = $row1["uid"];
        $date = $row1["date"];
        $sql0 = "SELECT name FROM user WHERE id='$userID'";
        $result0 = $mysqli->query($sql0);
        while ($row0 = mysqli_fetch_assoc($result0)) {
            $userName = $row0["name"];
            echo $userName." says: ".$postsName." - at ".$date."<br>";
            
        }
    }
} 

?>

</body>
</html>