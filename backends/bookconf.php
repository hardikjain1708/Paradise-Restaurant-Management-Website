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
	$_SESSION['msg'] = "You must Log In First to reserve a table!";
	header('location: ../reserve.php');
	exit();
}


date_default_timezone_set("Asia/Kolkata");


$user_name = $_SESSION['user'];
$user_id = $_SESSION['user_id'];
$phoneno= $_COOKIE['phone'];
$guests= $_COOKIE['adven'];
$requests= $_COOKIE['exp'];
$vaccinated= True;
$booking_time= $_COOKIE['booking_time'];
$date = new DateTime($booking_time);
$date = $date->format('Y-m-d H:i:s');


$sql = "INSERT INTO reserve(user_id,user_name,phoneno,guests,requests,vaccinated,booking_time) VALUES(?,?,?,?,?,?,?)";

$query  = $pdoconn->prepare($sql);

if ($query->execute([$user_id,$user_name,$phoneno,$guests,$requests,$vaccinated,$booking_time])) {

	$_SESSION['msg'] = 'Table Booked! Your booking time  is : '.$date;

	$to_email = $_SESSION['user_email'];
	$subject = "Table Booking Confirmation";
	$body = 'Hi, '. $_SESSION['user'] .', Your table has been booked! Your booking time  is : '.$date;
	$headers = "From: sparshtgupta@gmail.com";

	if (mail($to_email, $subject, $body, $headers)) {
		echo "Email successfully sent to $to_email...";
	} else {
		echo "Email sending failed...";
	}

	header('location: ../reserve.php');
	
} else {

	$_SESSION['msg'] = 'There were some problem in the server! Please try again after some time!';

	header('location: ../reserve.php');

}