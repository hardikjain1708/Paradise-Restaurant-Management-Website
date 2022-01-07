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

    $cart_item_id = $_REQUEST['id'];
    $user_id = $_SESSION['user_id'];
    $user_cart_id = $_SESSION['user_cart_id'];

    $sql1 = "SELECT * FROM cart WHERE id='$cart_item_id'";
    $query1 = $pdoconn->prepare($sql1);
    $query1->execute();
    $cart_item_array=$query1->fetchAll(PDO::FETCH_ASSOC);

    foreach($cart_item_array as $val)
    {
        $quantity = $val['quantity'];
    }
    $sql3 = "DELETE FROM cart WHERE id = '$cart_item_id'";
    $query3 = $pdoconn->prepare($sql3);

    if ($query3->execute()) {
        $_SESSION['msg'] = 'Item removed from cart';
        header('location: ../cart.php');
    } else {
        $_SESSION['msg'] = 'There were some problem in the server! Please try again after some time!';
        header('location: ../cart.php');
    }
?>