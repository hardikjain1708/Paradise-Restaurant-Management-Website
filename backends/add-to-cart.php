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

if (!isset($_REQUEST['id'])) {
	$_SESSION['msg'] = "Invalid food item! Please try again!";
	header('location: ../foods.php');
	exit();
}

date_default_timezone_set("Asia/Kolkata");

$food_id = $_REQUEST['id'];
$user_id = $_SESSION['user_id'];
$user_cart_id = $_SESSION['user_cart_id'];

$sql1 = "SELECT * FROM cart WHERE user_id='$user_id' AND food_item='$food_id' AND user_cart_id='$user_cart_id'";
$query1 = $pdoconn->prepare($sql1);
$query1->execute();
$food_from_table_array=$query1->fetchAll(PDO::FETCH_ASSOC);

if (count($food_from_table_array) > 0) {
    
    foreach($food_from_table_array as $val)
	{
        $quantity = $val['quantity'];
	}

    $quantity += 1;

    $sql3 = "UPDATE cart SET quantity = $quantity WHERE user_id='$user_id' AND food_item='$food_id'";
    $query3 = $pdoconn->prepare($sql3);

    if ($query3->execute()) {
        $_SESSION['msg'] = 'Item added to Cart';
        header('location: ../foods.php');
    } else {
        $_SESSION['msg'] = 'There were some problem in the server! Please try again after some time!';
        header('location: ../foods.php');
    }

} else {
    $sql2 = "INSERT INTO cart(user_id,food_item,quantity,user_cart_id) VALUES(?,?,?,?)";
    $query2  = $pdoconn->prepare($sql2);

    if ($query2->execute([$user_id, $food_id, 1, $user_cart_id])) {
        $_SESSION['msg'] = 'Item added to Cart';
        header('location: ../foods.php');
    } else {
        $_SESSION['msg'] = 'There were some problem in the server! Please try again after some time!';
        header('location: ../foods.php');
    }
}