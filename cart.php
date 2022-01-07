<?php
 session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cart</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<!-- <meta http-equiv="refresh" content="1"> -->

	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css?family=Pacifico&display=swap" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css?family=Bree+Serif&display=swap" rel="stylesheet">


	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="css/style.css">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

	<style>
		table a:hover {
			color: red;
		}
	</style>

</head>
<body>
	<?php require('chunks/login-modal.php'); ?>
	<?php require('chunks/register-modal.php'); ?>
	<?php require('chunks/info-modal.php'); ?>
	<?php require('chunks/navbar.php'); ?>
	<?php require('chunks/banner-slider.php'); ?>
	    
	<?php
		require_once('backends/connection-pdo.php' );
		
		if (isset($_SESSION['msg'])) {
			echo '<div class="section pink center" style="margin: 10px; padding: 3px 10px; margin-top: 35px; border: 2px solid black; border-radius: 5px; color: white;">
					<p><b>'.$_SESSION['msg'].'</b></p>
				</div>';

			unset($_SESSION['msg']);
		}
		$user_id = $_SESSION['user_id'];
		$user_cart_id = $_SESSION['user_cart_id'];

		$sql1 = "SELECT * FROM cart WHERE user_id='$user_id' AND user_cart_id='$user_cart_id'";
		$query1 = $pdoconn->prepare($sql1);
		$query1->execute();
		$cart_items=$query1->fetchAll(PDO::FETCH_ASSOC);
		$grand_total = 0;
		$sql6 = "SELECT * FROM users WHERE id='$user_id'";
		$query6 = $pdoconn->prepare($sql6);
		$query6->execute();
		$users_array=$query6->fetchAll(PDO::FETCH_ASSOC);
		foreach ($users_array as $i) {
			$_SESSION['num'] = $i['no_of_orders'];
		}
	?>


	<h1 align='center'>My Cart</h1>

	<div class="d-flex justify-content-center py-5">
		<table class="table table-striped" style="width: 500px;">
		<thead>
			<tr>
				<th>Item Name</th>
				<th>Price</th>
				<th>Quantity</th>
				<th>Subtotal</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($cart_items as $cart_item) {
				$temp = $cart_item['food_item'];
				$sql2 = "SELECT * FROM food WHERE id= '$temp'";
				$query2 = $pdoconn->prepare($sql2);
				$query2->execute();
				$food_items=$query2->fetchAll(PDO::FETCH_ASSOC);
				foreach ($food_items as $food_item) {
					$name = $food_item['fname'];
					$price = $food_item['price'];
				}
			?>
				<tr>
					<td><?php echo $name; ?></td>
					<td>₹<?php echo $price; ?></td>
					<td><a class="me-2" href="backends/increase_quantity.php?id=<?php echo $cart_item['id']; ?>"><i class="fa fa-plus"></i></a> <?php echo $cart_item['quantity'];?> <a class="ms-2" href="backends/decrease_quantity.php?id=<?php echo $cart_item['id']; ?>"><i class="fa fa-minus"></i></a></td>
					<td>₹<?php echo ($price * $cart_item['quantity']); ?></td>
					<?php $grand_total += $price * $cart_item['quantity'] ?>
					<td><a href="backends/delete_quantity.php?id=<?php echo $cart_item['id']; ?>"><i class="fa fa-trash"></i></a></td>
				</tr>
			<?php } ?>
		</tbody>
		</table>
	</div>
	
	<?php if ($grand_total != 0) { ?>
		<?php
			if ($_SESSION['num'] % 5 == 4) {
				$grand_total -= 100;
			?>
				<div class="d-flex justify-content-center mb-5">
					<h4>Grand Total: <del style="color: red;"><?php echo '₹'. $grand_total+100 . ' ';?></del><?php echo '₹' . $grand_total; ?></h4>
				</div>
			<div class="section pink center" style="margin: 10px; padding: 3px 10px; margin-top: 35px; border: 2px solid black; border-radius: 5px; color: white;">
				<p><b><?php echo 'Congratulations! You have earned reward of ₹100 on your Order Number: ' . $_SESSION['num'] + 1 ?></b></p>
			</div>';
		<?php } else { ?>
			<div class="d-flex justify-content-center mb-5">
				<h4>Grand Total: <?php echo '₹' . $grand_total;?></h4>
			</div>
		<?php } ?>
		
	<?php } ?>

	<?php
		$_SESSION['total'] = $grand_total;
	?>	

	<div class="d-flex justify-content-center mb-5">
		<a href="backends/order-food.php" class="hvr-grow"><button type="button" class="btn btn-primary me-5">Order Now</button></a>
		<a href="backends/empty-cart.php" class="hvr-grow"><button type="button" class="btn btn-danger me-5">Empty Cart</button></a>
	</div>

	<?php require('chunks/footer.php'); ?>
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>

<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<script src="js/loaders.js"></script>
<script src="js/ajax.js"></script>
</body>
</html>