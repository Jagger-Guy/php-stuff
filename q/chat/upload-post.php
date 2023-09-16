<?php

session_start();
$mysqli = require __DIR__ . "/../main/database.php";
$id = $_SESSION['id'];
$postsUpload = $_POST["post_upload"];

if (isset($id)) {
    if (isset($_POST["submit3"])) {
        if (empty($postsUpload)) {
            header("Location: posts.php?empty_field");
        } else {

            $time = date("d/m/Y")." ".date("H:i:s");
            $sql = "INSERT INTO post (uid, posts, date) VALUES (?, ?, ?)";
            $stmt = $mysqli->stmt_init();
            $stmt->prepare($sql);
            $stmt->bind_param("iss", $id, $postsUpload, $time);
                            
            if ($stmt->execute()) {
                header("Location: chat.php");
            }
        }
    }
} else {
    header("Location: ../main/home.php");
}