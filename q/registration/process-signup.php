<?php

session_start();
$mysqli = require __DIR__ . "/../main/database.php";

if (isset($_POST["submit0"])) {

    if (empty($_POST["name"])) {
        header("Location: signup.php");
        $_SESSION["error0"] = "You must fill out the name field.";
        die();
    }

    if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        header("Location: signup.php");
        $_SESSION["error0"] = "You must enter a valid email.";
        die();
    }

    if (strlen($_POST["password"]) < 8) {
        header("Location: signup.php");
        $_SESSION["error0"] = "Your password must be longer than 8 characters.";
        die();
    }

    if ($_POST["password"] !== $_POST["password_confirmation"]) {
        header("Location: signup.php");
        $_SESSION["error0"] = "Your password must match.";
        die();
    }

    $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $email0 = $_POST["email"];
    $sql = ("SELECT email FROM user WHERE email = '$email0'");
    $result = $mysqli->query($sql);

    if( ! $result->num_rows == 0) {
        header("Location: signup.php");
        $_SESSION["error0"] = "This email is already taken.";
        die();
    }
    
} 

$zero = 0;
$_SESSION["email"] = $email0;
$sql = "INSERT INTO user (name, email, password_hash, profile_status, video_num, profile_followers) 
    VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $mysqli->stmt_init();
$stmt->prepare($sql);
$stmt->bind_param("sssiii", $_POST["name"], $email0, $password_hash, $zero, $zero, $zero);          

if ($stmt->execute()) {

    header("Location: signup-success.php");
    exit;
    
} else {
    
    if ($mysqli->errno === 1062) {
        die("email already taken");
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}