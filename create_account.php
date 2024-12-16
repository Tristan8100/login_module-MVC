<?php

    include "MVC/routes.php";

   

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create_account</title>
</head>
<body>
    <form action="create_account.php" method="POST">
        <div>
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="namecreate" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="emailcreate" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="passwordcreate" required>
        </div>
        <div>
            <button type="submit" name="submitcreate">Login</button>
        </div>
    </form>
</body>
</html>