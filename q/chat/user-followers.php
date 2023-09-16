<?php

session_start();
$mysqli = require __DIR__ . "/../main/database.php";
$userID = $_GET["uid"];

$sql = "SELECT profile_followers FROM user WHERE id='$userID'";
$result = $mysqli->query($sql);
$result = mysqli_fetch_assoc($result);

$profileFollowers = $result["profile_followers"];
$profileFollowers = $profileFollowers + 1;

$sql = "UPDATE user SET profile_followers='$profileFollowers' WHERE id='$userID'";
$mysqli->query($sql);

header("Location: user.php?uid='$userID'");