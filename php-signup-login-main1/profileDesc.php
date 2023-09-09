<?php

session_start();
$mysqli = require __DIR__ . "/database.php";
$id = $_SESSION['id'];
$profileDesc = $_POST["profile_desc"];

if (isset($_POST["submit5"])) {
    if ( ! empty($profileDesc)) {
        if ( ! strlen($profileDesc) < 255) {

            $sql = "UPDATE user SET profile_desc='$profileDesc' WHERE id='$id'";
            $mysqli->query($sql);

        } else {
            header("Location: index.php?desc_too_long");
        }
    } else {
        header("Location: index.php?invalid_desc");
    }
}