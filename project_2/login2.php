<?php 
    session_start();
include('server.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style2.css">
  <title>REGISTER FORM</title>

</head>
<body>
<div class="container" id="container">
	<div class="form-container sign-up-container">
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
			<h1>Create Account</h1>
			<!-- <div class="social-container">
				<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
				<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
				<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
			</div> -->
			<span>or use your email for registration</span>
			<input type="text" placeholder="Name" name="username">
			<input type="email" placeholder="Email" name="email">
			<input type="password" placeholder="Password" name="password_1">
      <input type="password" placeholder="Confirm Password" name="password_2">
			<button type="submit" name="reg_user">Sign Up</button>
		</form>
	</div>
	<div class="form-container sign-in-container">
		<form action="login_db.php" method="post">
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
			<h1>Sign in</h1>
			<!-- <div class="social-container">
				<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
				<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
				<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
			</div> -->
			<span>or use your account</span>
			<input type="text" placeholder="Username" name="username">
			<input type="password" placeholder="Password" name="password">
			<button type="submit" name="login_user">Sign In</button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>Welcome Back!</h1>
				<p>To keep connected with us please login with your personal info</p>
				<button class="ghost" id="signIn">Sign In</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Hello, Friend!</h1>
				<p>Enter your personal details and start journey with us</p>
				<button class="ghost" id="signUp">Sign Up</button>
			</div>
		</div>
	</div>
</div>
<script src="main.js"></script>  
</body>
</html>