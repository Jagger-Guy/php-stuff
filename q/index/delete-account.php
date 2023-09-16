<?php

session_start();
$mysqli = require __DIR__ . "/../main/database.php";
$id = $_SESSION['id'];

if (isset($id)) {
    if (isset($_POST["submit4"])) {

        $sql = "SELECT profile_ext FROM user WHERE id='$id'";
        $result = $mysqli->query($sql);
        $result = mysqli_fetch_assoc($result);
        unlink("uploads/profile".$id.".".$result["profile_ext"]."");

        $sql = "DELETE FROM user WHERE id='$id'";
        $mysqli->query($sql);
        session_destroy();
        header("Location: ../main/home.php");

    }
} else {
    header("Location: ../main/home.php");
}