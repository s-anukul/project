<?php 
include('server.php');
    session_start();
    if (!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "YOU MUST LOG IN FIRST";
        header('location: login.php');
    }
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header('location:login.php');
    }  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="homeheader">
        <h2>HOME PAGE</h2>
    </div>
    <div class="homecontent">
        <?php if (isset($_SESSION['success'])) :?>
            <div class="success">
                <h3>
                    <?php
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                    ?>
                </h3>
            </div>
        <?php endif ?>
        <?php if (isset($_SESSION['username'])) : ?>
            <p>WELCOME <strong><?php echo $_SESSION['username']; ?></strong></p>
            <p><a href="logout.php?logout=<?php echo $_SESSION['username']; ?>" style="color: white;">LOG OUT</a></p>
            <?php endif ?>
            
    </div>
    <div class="searchform">
        <form action="searchdata.php" method="post">
            <label for="search" class="label">SEARCH DATA BY ID</label>
            <input type="text" placeholder="ID" name="searchid">
            <button type="submit">SEARCH</button>
        </form>
        


    </div>
</body>
</html>