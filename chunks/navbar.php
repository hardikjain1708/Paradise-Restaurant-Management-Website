<style>
	a:hover {
		color: white;
	}
</style>

<section class="fnavbar">
		<div class="navbar-fixed">
		<nav>
		    <div class="nav-wrapper" style="background-color: #e69953;">
		      <a href="#" class="brand-logo">Paradise</a>
		      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
		      <ul class="right hide-on-med-and-down">
		        <li><a href="/Paradise" class="hvr-grow">Home</a></li>
		        <li><a href="/Paradise/about-restro.php" class="hvr-grow">About Us</a></li>
		        <li><a href="food-categories.php" style="text-decoration: none;">Categories</a></li>
				<li><a href="reserve.php" class="hvr-grow">Reserve</a></li>
		        <li><a href="foods.php" class="hvr-grow">Foods</a></li>
		        <li><a href="#" class="hvr-grow" onclick="toggleModal('Contact Info', 'You can contact us directly by calling to this number +91 98363 38783. Check the bottom Footer Section of the website for more info.');">Contact</a></li>
		        
		        <?php

		        	if (isset($_SESSION['user'])) {
						require_once('backends/connection-pdo.php' );

						$user_id = $_SESSION['user_id'];
						$user_cart_id = $_SESSION['user_cart_id'];
						
						$sql1 = "SELECT * FROM cart WHERE user_id='$user_id' AND user_cart_id='$user_cart_id'";
						$query1 = $pdoconn->prepare($sql1);
						$query1->execute();
						$cart_items=$query1->fetchAll(PDO::FETCH_ASSOC);
						$cart_count = 0;

						foreach($cart_items as $cart_item) {
							$cart_count += $cart_item['quantity'];
						}

		        		echo '<li><a href="/Paradise/welcome.php" class="hvr-grow">Hi, '.$_SESSION['user'].'</a></li>
						<li><a href="cart.php" class="hvr-grow">My Cart ('.$cart_count.')</a></li>
		        		<li><a href="logout.php" class="hvr-grow">Logout</a></li>';
		        	} else {
		        		echo '<li><a href="/Paradise/login.php" class="hvr-grow modal-trigger" data-target="modal1">Login</a></li>
		        		<li><a href="/Paradise/register.php" class="hvr-grow modal-trigger" data-target="modal2">Register</a></li>';
		        	}

		        ?>
		        
		      </ul>
		    </div>
		  </nav>
		</div>

		  <ul class="sidenav" id="mobile-demo">
		    <li><a href="/Paradise">Home</a></li>
	        <li><a href="/Paradise/about-restro.php">About Us</a></li>
	        <li><a href="food-categories.php">Categories</a></li>
			<li><a href="reserve.php">Reserve</a></li>
	        <li><a href="foods.php">Foods</a></li>
	        <li><a href="#" onclick="toggleModal('Contact Info', 'You can contact us directly by calling to this number +91 98363 38783. Check the bottom Footer Section of the website for more info.');">Contact</a></li>

	        <?php

		        	if (isset($_SESSION['user'])) {
		        		echo '<li><a href="/Paradise/welcome.php">Hi, '.$_SESSION['user'].'</a></li>
		        		<li><a href="logout.php">Logout</a></li>';
		        	} else {
		        		echo '<li><a href="/Paradise/login.php" class="modal-trigger" data-target="modal1">Login</a></li>
		        		<li><a href="/Paradise/register.php" class="modal-trigger" data-target="modal2">Register</a></li>';
		        	}

		        ?>
		  </ul>
	</section>