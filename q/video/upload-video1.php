<?php
session_start();
$mysqli = require __DIR__ . "/../main/database.php";
$id = $_SESSION['id'];

if (isset($_POST["submit2"])) {
    $video = $_FILES["video"];
    $videoName = $video["name"];
    $videoTmp = $video["tmp_name"];
    $videoSize = $video["size"];
    $videoError = $video["error"];
    $videoType = $video["type"];

    $tn = $_FILES["thumbnail"];
    $tnName = $tn["name"];
    $tnTmp = $tn["tmp_name"];
    $tnSize = $tn["size"];
    $tnError = $tn["error"];
    $tnType = $tn["type"];

    $videoTitle = $_POST["video_title"];
    $videoDesc = $_POST["video_desc"];

    $videoExt = explode(".", $videoName);
    $videoExt = strtolower(end($videoExt));
    $videoAllowed = array("mp4");

    $tnExt = explode(".", $tnName);
    $tnExt = strtolower(end($tnExt));
    $tnAllowed = array("png", "jpg", "jpeg");

    if (empty($videoTitle) || empty($videoDesc)) {
        header("Location: videos.php");
        $_SESSION["error1"] = "You must fill out all fields.";
        die();
    }

    if (strlen($videoTitle) > 50 || strlen($videoDesc) > 100) {
        header("Location: videos.php");
        $_SESSION["error1"] = "Your title or description is too long.";
        die();
    }

    if (in_array($videoExt, $videoAllowed) && in_array($tnExt, $tnAllowed)) {
        if ($videoError === 0 && $tnError === 0) {
            if ($videoSize < 500000000 && $tnSize < 500000000) {

                $sql = "SELECT video_num FROM user WHERE id='$id'";
                $result = $mysqli->query($sql);
                $user = $result->fetch_assoc();
                $videoNum = $user["video_num"];
                $videoNum = $videoNum + 1;

                $videoUrl = uniqid();
                $videoName = $videoUrl.".".$videoExt;
                $tnName = "tn".$videoUrl.".".$tnExt;
                $tnDestination = 'video-uploads/'.$tnName;
                $videoDestination = 'video-uploads/'.$videoName;

                $zero = 0;
                $a = serialize(array());

                $sql = "INSERT INTO video (user_id, video_id, video_title, video_desc, video_path, tn_path, video_rating, rating_count)
                 values (?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $mysqli->stmt_init();
                $stmt->prepare($sql);
                $stmt->bind_param("isssssis", $id, $videoUrl, $videoTitle, $videoDesc, $videoDestination, $tnDestination, $zero, $a);
                $stmt->execute();

                move_uploaded_file($videoTmp, $videoDestination);
                move_uploaded_file($tnTmp, $tnDestination);
                header("Location: videos.php?upload_success");

                $sql = "UPDATE user SET video_num='$videoNum' WHERE id='$id'";
                $mysqli->query($sql);

            } else {
                $_SESSION["error1"] = "Filesize is too big.";
                header("Location: videos.php");
                die();
            }
        } else {
            $_SESSION["error1"] = "Error uploading.";
            header("Location: videos.php");
            die();
        }
    } else {
        $_SESSION["error1"] = "Invalid file type.";
        header("Location: videos.php");
        die();
    }

}