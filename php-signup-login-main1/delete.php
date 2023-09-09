<?php

session_start();
$mysqli = require __DIR__ . "/database.php";
$id = $_SESSION['id'];

if (isset($_POST["submit4"])) { 
    $sql = "UPDATE user SET name=NULL WHERE id=16";
}