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

date_default_timezone_set("Asia/Kolkata");

$user_cart_id = $_SESSION['user_cart_id'];

$sql = "DELETE FROM cart WHERE user_cart_id = '$user_cart_id'";
$query  = $pdoconn->prepare($sql);
if ($query->execute()) {
    $_SESSION['msg'] = 'Cart is empty!';
	header('location: ../cart.php');
} else {
	$_SESSION['msg'] = 'There were some problem in the server! Please try again after some time!';
	header('location: ../cart.php');
}