<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    
    <h1>Signup</h1>
    
    <form action="process-signup.php" method="post" novalidate>
        <div>
            <label for="name">Name</label>
            <input type="text" id="name" name="name">
        </div>
        
        <div>
            <label for="email">email</label>
            <input type="email" id="email" name="email">
        </div>
        
        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
        </div>
        
        <div>
            <label for="password_confirmation">Repeat password</label>
            <input type="password" id="password_confirmation" name="password_confirmation">
        </div>
        
        <button type="submit" name="submit0">Sign up</button>
    </form>

    <?php
        if (isset($_SESSION["error0"])) {
            echo $_SESSION["error0"];
        }
    ?>
    
</body>
</html>