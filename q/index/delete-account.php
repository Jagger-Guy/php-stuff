<?php

session_start();
$mysqli = require __DIR__ . "/../main/database.php";
$id = $_SESSION['id'];

if (isset($id)) {
    if (isset($_POST["submit1"])) {

        $sql = "DELETE FROM user WHERE id='$id'";
        $mysqli->query($sql);
        header("Location: ../main/home.php");

    }
} else {
    header("Location: ../main/home.php");
}