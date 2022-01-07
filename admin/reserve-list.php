<?php require('layout/header.php'); ?>
<?php require('layout/left-sidebar-long.php'); ?>
<?php require('layout/topnav.php'); ?>
<?php require('layout/left-sidebar-short.php'); ?>


<?php

require('../backends/connection-pdo.php');

$sql = 'SELECT * FROM reserve';

$query  = $pdoconn->prepare($sql);
$query->execute();
$arr_all = $query->fetchAll(PDO::FETCH_ASSOC);



?>
						

<div class="section white-text" style="background: #B35458;">

	<div class="section">
		<h3>Reserve</h3>
	</div>

  <?php

    if (isset($_SESSION['msg'])) {
        echo '<div class="section center" style="margin: 5px 35px;"><div class="row" style="background: red; color: white;">
        <div class="col s12">
            <h6>'.$_SESSION['msg'].'</h6>
            </div>
        </div></div>';
        unset($_SESSION['msg']);
    }

    ?>
	
	<div class="section center" style="padding: 20px;">
		<table class="centered responsive-table">
        <thead>
          <tr>
              <th>USER ID</th>
              <th>Phone Number</th>
              <th>No. of Guests</th>
              <th>Requests</th>
              <th>Vaccination status</th>
              <th>User Name</th>
              <th>Booking Time</th>
          </tr>
        </thead>

        <tbody>
          <?php

            foreach ($arr_all as $key) {
              $date = new DateTime($key['booking_time']);
              $date = $date->format('Y-m-d H:i:s');

          ?>
          <tr>
            <td><?php echo $key['user_id']; ?></td>
            <td><?php echo $key['phoneno']; ?></td>
            <td><?php echo $key['guests']; ?></td>
            <td><?php echo $key['requests']; ?></td>
            <td><?php if ($key['vaccinated'] == 1) echo 'Yes'; else echo 'No'; ?></td>
            <td><?php echo $key['user_name']; ?></td>
            <td><?php echo $date; ?></td>
          </tr>

          <?php } ?>
         
        </tbody>
      </table>
	</div>
</div>

<?php require('layout/about-modal.php'); ?>
<?php require('layout/footer.php'); ?>