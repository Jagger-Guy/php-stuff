<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/024043192c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../main/style.css">
</head>
<body>

<?php

$a = array(3.1, 4.2, 5.1, 6.2);
$b = array();

foreach ($a as $value) {
    $c = (explode(".", $value));
    array_push($b, $c);
}

$id = 5;
$len_a = count($a);

for ($index0 = 0; $index0 < $len_a; $index0++) {
    if ($b[$index0][0] == $id) {
        echo $index0;
    }
}


?>







</body>
</html>