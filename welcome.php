<?php
 session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Paradise - Categories!</title>

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
		.table tbody tr td {
			font-size: 20px;
		}
	</style>
</head>
<body>

	<?php require('chunks/login-modal.php'); ?>


	<?php require('chunks/register-modal.php'); ?>


	<?php require('chunks/info-modal.php'); ?>


	<?php require('chunks/navbar.php'); ?>


	<?php require('chunks/banner-slider.php'); ?>

	<h1 align='center'>Welcome <?php echo $_SESSION['user']; ?>,</h1>
	<h4 align='center'>You are now logged in. you can logout by clicking on signout link given below.</h4>

	<div class="d-flex justify-content-center py-5">
		<table class="table table-striped" style="width: 500px;">
		<tbody>
			<tr>
				<td>Username:</td>
				<td><?php echo $_SESSION['user']; ?></td>
			</tr>
			<tr>
				<td>User Email: </td>
				<td><?php echo $_SESSION['user_email']; ?></td>
			</tr>
		</tbody>
		</table>
	</div>
	
	<div class="d-flex justify-content-center mb-5">
		<a href="logout.php" class="hvr-grow"><button type="button" class="btn btn-danger me-5">Sign Out</button></a>
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