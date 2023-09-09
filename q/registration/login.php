<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/../main/database.php";
    
    $sql = sprintf("SELECT * FROM user
                    WHERE email = '%s'",
                   $mysqli->real_escape_string($_POST["email"]));
    
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
    
    if ($user) {
        if (password_verify($_POST["password"], $user["password_hash"])) {
            
            session_start();
            session_regenerate_id();
            $_SESSION["id"] = $user["id"];
            header("Location: ../index/profile.php");
            exit;
        }
    }
    
    $is_invalid = true;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    
    <h1>Login</h1>
    
    <?php if ($is_invalid): ?>
        <em>Invalid login</em>
    <?php endif; ?>
    
    <form method="post">
        <label for="email">email</label>
        <input type="email" name="email" value="<?= htmlspecialchars($_POST["email"] ?? "") ?>"><br>
        
        <label for="password">Password</label>
        <input type="password" name="password">
        
        <button>Log in</button>
    </form>

    <br><p>Or you may go back to the <a href="signup.php">Signup</a> page</p>
    
</body>
</html>