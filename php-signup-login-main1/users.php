<?php

session_start();
$mysqli = require __DIR__ . "/database.php";
$id = $_SESSION['id'];
$selected = 0;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $option = $_POST["userName"];
        $sql1 = "SELECT * FROM user WHERE name='$option'";
        $result1 = $mysqli->query($sql1);
        $user = mysqli_fetch_assoc($result1);
        $selected = 1;
    
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

<h1>Users</h1>

<?php

$allUsers = array();
if (isset($id)) {

    echo '<form method="post"';
    echo '<label for="userName">Select user:</label>';
    echo "<select name='userName'>";
    #echo '<option value="NA">N/A</option>';

    $sql0 = "SELECT name FROM user";
    $result0 = $mysqli->query($sql0);
    while ($row0 = mysqli_fetch_assoc($result0)) {
        $userName = $row0["name"];
        echo '<option value="'.htmlspecialchars($userName).'">'.htmlspecialchars($userName).'</option>';
    }
    echo "</select><br><input type='submit' value='Submit'></form>";
}

if ($selected === 1) {

    if ($user["profile_status"] == 0) {
        echo "<br><img src='uploads/profiledefault.png' style='width:200px;height:200px;'>";
    } else {
        echo "<img src='uploads/profile".$user["id"].".".$user["profile_ext"]."?"." style='width:200px;height:150px;border-style:solid;'><br>";
    }
    echo $user["name"]."<br>";

    if (empty($user["profile_desc"])) {
        echo 'This user does not have a description.<br>';
    } else {
        echo 'This users description is: '.$user["profile_desc"]."<br>";
    }

    if ($user["video_num"] === 0) {
        echo 'This user has not uploaded any videos.<br>';
    } elseif ($user["video_num"] === 1) {
        echo 'This user has uploaded 1 video.<br>';
    } else {
        echo 'This user has uploaded '.$user["video_num"]." videos.<br>";
    }

    $selected = 0;
    
}

?>


</body>
</html>