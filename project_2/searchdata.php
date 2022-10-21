<?php
include('server.php');
$id = $_POST['searchid'];
$sql = "SELECT id,username,email,position,age FROM user WHERE id LIKE '$id'";
$result=mysqli_query($conn,$sql);


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
        <h2 >SEARCH DATA <br> BY ID</h2>
    </div>
    <div class="searchform">
        <form action="searchdata.php" method="post">
            <label for="search" class="label">SEARCH DATA BY ID</label>
            <input type="text" placeholder="ID" name="searchid">
            <button type="submit">SEARCH</button>
            <a href="index.php" class="backbtn">กลับหน้าหลัก</a>
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th>ID <hr></th>
                    <th>USERNAME <hr></th>
                    <th>EMAIL <hr></th>
                    <th>POSITION <hr></th>
                    <th>AGE <hr></th> 
                </tr>
            </thead>
            <tbody>
                <?php while($row=mysqli_fetch_assoc($result)){?>
                    <tr>
                        <td><?php echo $row['id'];?></td>
                        <td><?php echo $row['username'];?></td>
                        <td><?php echo $row['email'];?></td>
                        <td><?php echo $row['position'];?></td>
                        <td><?php echo $row['age'];?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>


    </div>
    
</body>
</html>