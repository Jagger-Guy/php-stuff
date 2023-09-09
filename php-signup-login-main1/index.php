<?php

session_start();
$id = $_SESSION['id'];

if (isset($id)) {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["id"]}";
            
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    
    <h1>Profile</h1>
    
    <?php if (isset($user)): ?>

        <?php
            if ($user["profile_status"] == 0) {
                echo "<img src='uploads/profiledefault.png' style='width:200px;height:200px;'>";
            } else {
                echo "<img src='uploads/profile".$user["id"].".".$user["profile_ext"]."?"." style='width:200px;height:150px;border-style:solid;'>";
            }
        ?>
        
            <p>Hello <?= htmlspecialchars($user["name"]) ?></p>
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <p>Upload profile picture</p>
                <input type="file" name="profile_img">
                <button type="submit" name="submit1">Upload</button>
            </form>
            <p><a href="videos.php">Upload video</a></p>
            <p><a href="posts.php">Upload post</a></p>
            <p><a href="users.php">See all users</a></p>
            <p><a href="logout.php">Log out</a></p>

            <form action="profileDesc.php" method="post">
                <div>
                    <label for="profile_desc">Profile description</label>
                    <input type="text" name="profile_desc">
                    <button type="submit" name="submit5">Save</button>
                </div>
            </form>

            <label for="submit4">Warning - irreversible:
                <button type="submit" name="submit4">Delete account</button>
            </label>

            <?php

                $sql = "SELECT profile_desc FROM user WHERE id='$id'";
                $result = $mysqli->query($sql);
                $user = mysqli_fetch_assoc($result);
                $user = $user["profile_desc"];
                echo "Profile description: ".$user;

            ?>
        
    <?php else: ?>
        
        <p><a href="login.php">Log in</a> or <a href="signup.php">sign up</a></p>
        
    <?php endif; ?>
    
</body>
</html>
    
    
    
    
    
    
    
    
    
    
    