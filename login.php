<?php

 include "MVC/routes.php";

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>
    <form action="login.php" method="POST">
    <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="emaillog" required>
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" id="password" name="passwordlog" required>
    </div>
    <div>
        <button type="submit" name="submitlog">Login</button>
    </div>
    </form>

</body>
</html>