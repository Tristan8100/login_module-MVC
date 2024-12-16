<?php

//session_start();
//if (!isset($_SESSION['user_id'])) {
//    header("Location: login.php?='login first'");
//}
    include "MVC/routes.php";

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
</head>
<body>
    <h1>ID: <?php echo $_SESSION['user_id']; ?> </h1>
</body>
</html>