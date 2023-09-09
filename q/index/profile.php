<?php

session_start();
$id = $_SESSION['id'];

if (isset($id)) {
    
    $mysqli = require __DIR__ . "/../main/database.php";
    
    $sql = "SELECT * FROM user WHERE id='$id'";
            
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();

} else {
    header("Location: ../main/home.php");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/024043192c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../main/style.css">
</head>
<body>

<h1>Profile</h1>
<i class="fa fa-user-circle-o" style="font-size:36px"></i>
<p>Hello <?= htmlspecialchars($user["name"]) ?></p><br>

<?php

    if ($user["profile_status"] == 0) {
        echo "<img src='../uploads/profiledefault.png' style='width:200px;height:200px;'><br>";
    } else {
        echo "<img src='../uploads/profile".$user["id"].".".$user["profile_ext"]."?"." style='width:200px;height:200px;border-style:solid;'><br>";
    }

    $sql = "SELECT profile_desc FROM user WHERE id='$id'";
    $result = $mysqli->query($sql);
    $user = mysqli_fetch_assoc($result);

    if ( ! empty($user["profile_desc"])) {
        echo "Profile description: ".$user["profile_desc"];
    }

?>

<form action="profile-desc.php" method="post">
    <div>
        <br><label for="profile_desc">Profile description</label>
        <input type="text" name="profile_desc">
        <button type="submit" name="submit1">Save</button>
    </div>
</form>


<form action="upload-profile.php" method="post" enctype="multipart/form-data">
    <p>Upload profile picture</p>
    <input type="file" name="profile_img">
    <button type="submit" name="submit0">Upload</button>
</form><br>

<p><a href="../chat/chat.php">Talk with other users</a></p>


<a href="../registration/logout.php">Log out</a><br>

<form action="delete-account.php" method="post">
    <br><button type="submit" name="submit4" style="color:Tomato;">Delete account</button>
<form>

</body>
</html>