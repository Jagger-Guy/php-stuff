<?php
    session_start();
    $id = $_SESSION['id'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Videos</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<?php

if (isset($id)) {

    echo '<h1>Videos</h1>

    <form action="upload-video1.php" method="post" enctype="multipart/form-data">
        <p>Upload video</p>
        <input type="file" name="video">
        <p>Upload thumbnail</p>
        <input type="file" name="thumbnail">
        <p>Video title</p>
        <input type="text" name="video_title">
        <p>Video description</p>
        <input type="text" name="video_desc">
        <button type="submit" name="submit2">Upload</button>
    </form>
    <p><a href="videos.php">View all videos from users</a></p>';

} else {
    header("Location: ../main/home.php");
}

if (isset($_SESSION["error1"])) {
    echo $_SESSION["error1"];
}

?>

</body>
</html>