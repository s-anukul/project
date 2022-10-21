<?php
	session_start();
	require_once('server.php');
	$db_handle = new DBcontroller();
	if (!empty($_GET["action"])) {
		switch($_GET["action"]) {
			case "add" :
				if(!empty($_POST["quantity"])){
					$productByCode = $db_handle->runQuery("SELECT * FROM product WHERE code ='" . $_GET["code"]. "'");
					$itemArray = array($productByCode[0]["code"]=>(array('name'=>$productByCode[0]["name"],
																		'code'=>$productByCode[0]["code"],
																		'quantity'=>$_POST["quantity"],
																		'price'=>$productByCode[0]["price"],
																		'image'=>$productByCode[0]["image"])));
				}
				if(!empty($_SESSION["cart_item"])){
					if(in_array($productByCode[0]["code"], array_keys($_SESSION["cart_item"]))){
						foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["code"] == $k){
								if(empty($_SESSION["cart_item"][$k]["quantity"])){
								$_SESSION["cart_item"][$k]["quantity"] =0;
								}
							$_SESSION["cart"][$k]["quantity"] += $_POST["quantity"];
							}
						}
					} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
					}
				} else {
				$_SESSION["cart_item"] = $itemArray;
				}break;
			case "remove" :
				if(!empty($_SESSION["cart_item"])) {
					foreach($_SESSION["cart_item"] as $k => $v) {
						if($_GET["code"] == $k){
							unset($_SESSION["cart_item"][$k]);}
						if(empty($_SESSION["cart_item"])){
							unset($_SESSION["cart_item"]);}
					}
				}
				break;
			case "empty" :
				unset($_SESSION["cart_item"]);
			break;
			
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Shopping</title>
	<link rel="stylesheet" href="style.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
	<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
        <a href="cart.php" class="navbar-brand ms-4 ms-lg-0">
            <h1 class="text-primary m-0"><img class="me-3" src="img/5234583.png" alt="Icon" width="100px">BEST SHOP</h1>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="cart.php" class="nav-item nav-link active">Home</a>
                <a href="about.html" class="nav-item nav-link">About</a>
                <a href="service.html" class="nav-item nav-link">Services</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu border-0 m-0">
                        <a href="feature.html" class="dropdown-item">Our Features</a>
                        <a href="project.html" class="dropdown-item">Our Projects</a>
                        <a href="team.html" class="dropdown-item">Team Members</a>
                        <a href="appointment.html" class="dropdown-item">Appointment</a>
                        <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                    </div>
                </div>
                <a href="contact.php" class="nav-item nav-link">Contact</a>
            </div>
            
        </div>
    </nav>
	<div class="container container-a">
		<div class="header pt-3">
			<h2>Your cart</h2>
		</div>
		<div>
			<a href="cart.php?action=empty" class="btn btn-danger">Empty</a>
		</div>
		<?php if (isset($_SESSION["cart_item"])) {
			$total_quantity = 0 ;
			$total_price = 0 ; 
		?>
		<table class="table mt-5">
    		<thead>
    			<tr >
    				<td>product</td>
					<td>name</td>
      				<td>price</td>
      				<td>quantity</td>
      				<td>total(baht)</td>
      				<td>delete</td>
    			</tr>
			</thead>
				<?php foreach($_SESSION["cart_item"] as $item){
				$item_price = $item["quantity"] * $item["price"];
				?>
			<tbody>
				<tr>
					<td >
						<img src="<?php echo $item["image"] ;?>" alt="" width="80px">
					</td>
					<td>
						<?php echo $item["name"]; ?>
					</td>
					<td>
						<?php echo number_format($item["price"],2) ;?>
					</td>
					<td>
						<?php echo $item["quantity"] ; ?>
					</td>
					<td>
						<?php echo number_format($item["price"],2) ; ?>
					</td>
		<!-- //remove product -->
					<td>
						<a href='cart.php?action=remove&code=<?php echo $item["code"] ; ?>' class="btn btn-danger">delete</a>
					</td>
				</tr>
				<?php
				$total_quantity += $item["quantity"];
				$total_price += ($item["price"] * $item["quantity"]);
				}?>
				<tr>
  					<td colspan='3'>
					ราคารวม
					</td>
					<td>
						<?php echo $total_quantity; ?>
					</td>
  					<td>
						<?php echo number_format($total_price,2) ;?>
					</td>
					<td></td>
				</tr>
		</table>
			<?php } else { ?>
			<p>Your cart is empty</p>
			<?php } ?>
	</div>

<div class="container container-b">
	<div class="header text-center">
		<h3>Products</h3>
	</div>
		<?php
    		$product_array = $db_handle->runQuery("SELECT * FROM product");
    		if(!empty($product_array)){ 
    		foreach($product_array as $key => $value) { ?>
	<form action="cart.php?action=add&code=<?php echo $product_array[$key]["code"] ; ?>" method="POST" class="form-control text-center mb-3 mt-3">
		<div class="col mb-3 pt-3">
			<img src='<?php echo $product_array[$key]["image"] ?>' alt="" width="200px">
		</div>
		<div class="mb-3">
			<?php echo $product_array[$key]['name'] ; ?>
		</div>
		<div class="mb-3">
			<?php echo number_format($product_array[$key]["price"],2) ; ?>	
		</div>
		<div class="cart-action">
			<input type="text" name="quantity" value="1" size="2"class="mb-3 text-center" width="50px" >
			<input type="submit" value="เพิ่มในตะกร้า" class="btn btn-success">
		</div>
	</form>
	<?php  } }  ?>
</div>
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top mb-5" id="backtotop">Back to top</a>
<script src="js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>