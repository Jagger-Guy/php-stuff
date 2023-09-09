<?php

session_start();
session_destroy();
header("Location: ../main/home.php");
exit;