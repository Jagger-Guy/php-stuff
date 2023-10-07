<?php

session_start();
$mysqli = require __DIR__ . "/../main/database.php";
$id = $_SESSION['id'];
$userID = $_GET["uid"];

$sql = "SELECT profile_followers, followers_count FROM user WHERE id='$userID'";
$result = $mysqli->query($sql);
$result = mysqli_fetch_assoc($result);
$followersCount = $result["followers_count"];
$followersCount = unserialize($followersCount);

if (in_array($id, $followersCount)) {
    $_SESSION["error2"] = "You have already followed this person";
    die();
} else {
    array_push($followersCount, $id);
}

$profileFollowers = $result["profile_followers"];
$profileFollowers = $profileFollowers + 1;
$followersCount = serialize($followersCount);

$sql = "UPDATE user SET profile_followers='$profileFollowers', followers_count='$followersCount' WHERE id='$userID'";
$mysqli->query($sql);

header("Location: user-profile.php?uid='$userID'");