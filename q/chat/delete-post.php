<?php

session_start();
$mysqli = require __DIR__ . "/../main/database.php";
$id = $_SESSION['id'];

$buttonID = $_GET['btnid'];

$sql = "DELETE FROM post WHERE id='$buttonID'";
$mysqli->query($sql);

header("Location: chat.php");