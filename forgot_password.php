<?php

    include "MVC/routes.php";

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>forgot_password</title>
</head>
<body>
    
    <form action="forgot_password.php" method="POST">
        <label for="email">Enter Email:</label>
        <input type="email" id="email" name="emailforgort" required>
        <br><br>

        <button type="submit" name="subemail">Submit</button>
    </form>

</body>
</html>