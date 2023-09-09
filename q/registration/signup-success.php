<?php

session_start();

if (isset($_SESSION["email"])) {
    header("Location: ../index/profile.php");
} else {
    header("Location: ../main/home.php");
}