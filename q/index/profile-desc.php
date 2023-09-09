<?php

session_start();
$mysqli = require __DIR__ . "/../main/database.php";
$id = $_SESSION['id'];
$profileDesc = $_POST["profile_desc"];

if (isset($id)) {
    if (isset($_POST["submit1"])) {
        if ( ! empty($profileDesc)) {
            if ( ! strlen($profileDesc) < 255) {

                $sql = "UPDATE user SET profile_desc='$profileDesc' WHERE id='$id'";
                $mysqli->query($sql);
                header("Location: profile.php");

            } else {
                header("Location: profile.php?desc_too_long");
            }
        } else {
            header("Location: profile.php?invalid_desc");
        }
    }
} else {
    header("Location: ../main/home.php");
}