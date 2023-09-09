<?php
session_start();
$mysqli = require __DIR__ . "/database.php";
$id = $_SESSION['id'];

if (isset($_POST["submit1"])) {
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
            if ($fileSize < 50000000) {

                $fileNameNew = "profile".$id.".".$fileExt;
                $_SESSION["fileName"] = $fileNameNew;
                $fileDestination = 'uploads/'.$fileNameNew;

                move_uploaded_file($fileTmp, $fileDestination);
                $sql = "UPDATE user SET profile_status=1, profile_ext='$fileExt' WHERE id='$id';";
                $mysqli->query($sql);
                header("Location: index.php?upload_success");

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