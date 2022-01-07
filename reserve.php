<?php
session_start();
$expErr = $phoneErr = $checkErr = $advenErr = "";
$err="";
$phone= $exp = $adven = $check = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (empty($_POST["check"])){
        $checkErr = "*You need to be fully vaccinated to visit our restaurant";
        $err="error";
    }

    if (empty($_POST["phone"])) {
        $phoneErr = "*Contact number is required";
        $err="error";
    } else {
        $phone = $_POST["phone"];
        if (!ctype_digit($phone))
        {
            $phoneErr = '*Only numeric values allowed';
            $err="error";
        }
        else if (strlen($phone) != 10)
        {
            $phoneErr = '*Contact number should have 10 digits';
            $err="error";
        }
    }

    if (empty($_POST['requests'])) {
        $expErr = '*Please provide your requests';
        $err="error";
    } else {
        $exp = $_POST['requests'];
    }

    if (empty($_POST['guests'])) {
        $advenErr = '*Please enter the number of guests';
        $err="error";
    } else {
        $adven = $_POST['guests'];
    }
    if ($err!="error"){
        setcookie("phone",$phone);
        setcookie("err",$err);
        setcookie("booking_time",$_POST['time']);
        setcookie("exp",$exp);
        setcookie("adven",$adven);
        header("Location: backends/bookconf.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Paradise - Book My Table!</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<!-- <meta http-equiv="refresh" content="1"> -->

	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css?family=Pacifico&display=swap" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css?family=Bree+Serif&display=swap" rel="stylesheet">


	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

	<link rel="stylesheet" href="css/style.css">
	
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

	<style>
    
        .form{
            background-color: #fefefe;
            width: 38%;
            margin-left: 30%;
            border: 2px solid #444143;
            border-radius: 15px;
            padding-bottom: 3%;
            margin-top: 2%;
            margin-bottom: 2.5rem;
        }

        .text{
            text-align: center;
            font-size: calc(15px + 2vw);
            font-family: "Bree-Serif";
            margin-top: 2%;
            font-weight: bold;
        }

        .subtext{
            text-align: center;
            font-size: calc(7px + 1vw);
            margin-bottom: 5%;
        }

        .labeltext{
            font-size: 15px;
            margin: 0 0 0 2%;
        }

        .input{
            width: 96%;
            margin: 2% 2% 0% 2%;
            height: 25px;
            border: 1px solid #5f0b39;
            font-size: 15px;
            outline: none;
            font-family: "Bree-Serif";
            border-radius: 5px;
            padding-left: 10px;
        }

        .gender{
            margin-left: 3%;
        }

        .radiolabel{
            margin-right: 8%;
        }

        #requests{
            height: 50px;
        }

        #phone, #guests, #time{
            margin-left: 2%;
            width: 96%;
            height: 32px;
        }

        .show{
            margin-left: 5%;
        }
        #operation{
            width: 88%;
            margin: 0 0 3% 5%;
            height: 30px;
            border: 2px solid #FFC107;
            font-size: 15px;
            outline: none;
            font-family: "Bree-Serif";
            border-radius: 5px;
            padding-left: 10px;
        }
        #cancel{
            background-color: #af4a4a;
        }

        #submit{
            background-color: #00d91d;
        }
        .errmsg{
            font-size: 15px;
            margin-bottom: 2%;
            margin-left: 5%;
            color: red;
        }
        .details{
            font-size: calc(7px + 1vw);
            margin-bottom: 2%;
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

			if (isset($_SESSION['msg'])) {
				echo '<div class="section pink center" style="margin: 10px; padding: 3px 10px; margin-top: 35px; border: 2px solid black; border-radius: 5px; color: white;">
						<p><b>'.$_SESSION['msg'].'</b></p>
					</div>';

				unset($_SESSION['msg']);
			}
    ?>

    <form class = 'form' id = 'form' name = 'form' method = 'POST' action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class = 'text'>Book your table!</div><br>
        <div class = 'subtext'>Fill in the details to book your table in advance.</div><br>
        <label class = 'labeltext'>Contact no.:</label><br>
        <input type = 'tel' class = 'input' id = 'phone' name = 'phone'><br>
        <div class = 'errmsg' id = 'phoneerr'><?php echo $phoneErr; ?></div>
        <label class = 'labeltext'>Number of guests:</label>
        <input type = 'number' class = 'input' id = 'guests' name = 'guests'><br>
        <div class = 'errmsg' id = 'advenerr'><?php echo $advenErr; ?></div>
        <label class = 'labeltext'>Booking Time:</label><br>
        <input type='datetime-local' class='input' id='time' name='time' min="2021-12-07T08:30"><br><br>
        <label class = 'labeltext'>Any special requests:</label><br>
        <textarea class="form-control input" id = 'requests' name = 'requests' spellcheck = 'true' cols = '20' rows = '10'></textarea><br>
        <div class = 'errmsg' id = 'experr'><?php echo $expErr; ?></div>
        <div class="d-flex mb-3 ms-3">
            <input class="me-2" style="opacity:unset; pointer-events:unset; position:unset;" type="checkbox" name="check" value="check">
            <label class='check labeltext'>Are you fully vaccinated?:</label><br>
        </div>
        <div class = 'errmsg' id = 'checkerr'><?php echo $checkErr; ?></div>
        <div class='d-flex justify-content-center'>
            <button class = 'btn btn-danger me-5' id = 'cancel' type = 'reset'><b>Cancel</b></button>
            <button type="submit" class = 'btn btn-primary' id = 'submit' name="submit" ><b>Submit</b></button>
        </div>
    </form>

    <script>
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()
        mm = mm +1;
        var yyyy = today.getFullYear();
        var h = today.getHours(); 
        var m = today.getMinutes();

        if(dd<10){
        dd='0'+dd
        }
        if(mm<10){
        mm='0'+mm
        }
        if(h<10){
        h='0'+h
        }
        if(m<10){
        m='0'+m
        }

        today = yyyy+'-'+mm+'-'+dd+'T'+h+':'+m;
        console.log(today);
        document.getElementById("time").setAttribute("min", today);
    </script>

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