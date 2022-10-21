<?php 
    session_start();
    include('server.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
        <h2>REGISTER</h2>
    </div>
    <form action="register_db.php" method="post">
        <?php include('errors.php'); ?>
        <?php if (isset($_SESSION['error'])) : ?>
            <div class="error">
                <h3>
                    <?php
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    ?>
                </h3>
            </div>
        <?php endif ?>
        <div class="input-group">
            <label for="username">USERNAME</label>
            <input type="text" name="username" >
        </div>
        <div class="input-group">
            <label for="email">EMAIL</label>
            <input type="email" name="email" >
        </div>
        <div class="input-group">
            <label for="password_1">PASSWORD</label>
            <input type="password" name="password_1">
        </div>
        <div class="input-group">
            <label for="password_2">CONFIRM PASSWORD</label>
            <input type="password" name="password_2">
        </div>
        <div class="input-group">
            <button type="submit" name="reg_user" class="btn">SUBMIT</button>
        </div>
        <p>ALREADY A MEMBER?
            <a href="login.php">SIGN IN</a>
        </p>
    </form>
</body>
</html>