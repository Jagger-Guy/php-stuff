<?php

session_start();
$mysqli = require __DIR__ . "/../main/database.php";
$id = $_SESSION['id'];
$userID = $_GET["uid"];

$sql = "SELECT video_rating, rating_count FROM user WHERE id='$userID'";
$result = $mysqli->query($sql);
$result = mysqli_fetch_assoc($result);
$ratingCount = $result["rating_count"];
$ratingCount = unserialize($ratingCount);

if (in_array($id, $ratingCount)) {
    $_SESSION["error2"] = "You have already followed this person";
    die();
} else {
    array_push($ratingCount, $id);
}

$video_rating = $result["video_rating"];
$video_rating = $video_rating + 1;
$ratingCount = serialize($ratingCount);

$sql = "UPDATE user SET profile_followers='$video_rating', followers_count='$ratingCount' WHERE id='$userID'";
$mysqli->query($sql);

header("Location: user-profile.php?uid='$userID'");