<?php
session_start();
$mysqli = require __DIR__ . "/../main/database.php";
$id = $_SESSION['id'];

if (isset($_POST["submit0"])) {         // file size in bytes
    $file = $_FILES["profile_img"];
    $fileName = $file["name"];
    $fileTmp = $file["tmp_name"];
    $fileSize = $file["size"];
    $fileError = $file["error"];
    $fileType = $file["type"];

    $fileExt = explode(".", $fileName);
    $fileExt = strtolower(end($fileExt));
    $allowed = array("jpg", "jpeg", "png");

    if (in_array($fileExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 5000000) {

                $sql = "SELECT profile_status, profile_ext FROM user WHERE id='$id'";
                $user = $mysqli->query($sql);
                $user = mysqli_fetch_assoc($user);

                $fileNameNew = "profile".$id.".".$fileExt;
                $_SESSION["fileName"] = $fileNameNew;
                $fileDestination = '../uploads/'.$fileNameNew;

                move_uploaded_file($fileTmp, $fileDestination);
                $sql = "UPDATE user SET profile_status=1, profile_ext='$fileExt' WHERE id='$id';";
                $mysqli->query($sql);
                header("Location: profile.php?upload_success");

            } else {
                echo "Filesize is too big.";
            }
        } else {
            echo "Error uploading image.";
        }
    } else {
        echo "Invalid file type.";
    }

}