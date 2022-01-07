<?php

session_start();

try {

    if (!file_exists('connection-pdo.php' ))
        throw new Exception();
    else
        require_once('connection-pdo.php' ); 
		
} catch (Exception $e) {

	$arr = array ('code'=>"0",'msg'=>"There were some problem in the Server! Try after some time!");

	echo json_encode($arr);

	exit();
	
}

if (!isset($_SESSION['user']) || !isset($_SESSION['user_id'])) {
	$_SESSION['msg'] = "You must Log In First to Order Food!";
	header('location: ../foods.php');
	exit();
}

date_default_timezone_set("Asia/Kolkata");

$user_cart_id = $_SESSION['user_cart_id'];
$user_name = $_SESSION['user'];
$user_id = $_SESSION['user_id'];
$order_id = "RSTGF" . strval(mt_rand(100000, 999999));
$timest = date("d:m:Y h:i:sa");
$total = $_SESSION['total'];
$no_of_orders = $_SESSION['num'];
$no_of_orders += 1;

if ($total == 0) {
	$_SESSION['msg'] = 'Please add some items to the cart';
	header('location: ../cart.php');
} else {
	$sql = "INSERT INTO orders(order_id,user_id,user_cart_id,user_name, timestamp, total) VALUES(?,?,?,?,?,?)";
	$query  = $pdoconn->prepare($sql);
	if ($query->execute([$order_id, $user_id, $user_cart_id, $user_name, $timest, $total])) {
		$_SESSION['msg'] = 'Order Placed! Your Order ID is : '.$order_id;
		$sql3 = "UPDATE user_cart SET active='0' WHERE user_id='$user_id' AND active='1'";
		$query3 = $pdoconn->prepare($sql3);
		$query3->execute();
		
		$sql4 = "INSERT INTO user_cart(user_id, active) VALUES(?,?)";
		$query4  = $pdoconn->prepare($sql4);
		$query4->execute([$user_id, 1]);

		$sql5 = "SELECT * FROM user_cart WHERE user_id='$user_id' AND active='1'";
		$query5 = $pdoconn->prepare($sql5);
		$query5->execute();
		$user_cart_id_array=$query5->fetchAll(PDO::FETCH_ASSOC);
		foreach ($user_cart_id_array as $i) {
			$_SESSION['user_cart_id'] = $i['id'];
		}

		$sql6 = "UPDATE users SET no_of_orders='$no_of_orders' WHERE id='$user_id'";
		$query6 = $pdoconn->prepare($sql6);
		$query6->execute();
		
		header('location: ../foods.php');
	} else {
		$_SESSION['msg'] = 'There were some problem in the server! Please try again after some time!';
		header('location: ../foods.php');
	}
}