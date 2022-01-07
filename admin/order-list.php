<?php require('layout/header.php'); ?>
<?php require('layout/left-sidebar-long.php'); ?>
<?php require('layout/topnav.php'); ?>
<?php require('layout/left-sidebar-short.php'); ?>


<?php
  require('../backends/connection-pdo.php');

  $sql = 'SELECT * FROM orders';
  $query  = $pdoconn->prepare($sql);
  $query->execute();
  $arr_all = $query->fetchAll(PDO::FETCH_ASSOC);
?>
						

<div class="section white-text" style="background: #B35458;">
	<div class="section">
		<h3>Orders</h3>
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
              <th>Order ID</th>
              <th>Order Items</th>
              <th>User Name</th>
              <th>Timestamp</th>
              <th>Grand Total</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($arr_all as $key) {
            $temp = $key['user_cart_id']; 
            $sql2 = "SELECT * FROM cart WHERE user_cart_id = '$temp'";
            $query2  = $pdoconn->prepare($sql2);
            $query2->execute();
            $items_array = $query2->fetchAll(PDO::FETCH_ASSOC);
          ?>
            <tr>
              <td><?php echo $key['order_id']; ?></td>
              <td>
              <table class="centered responsive-table">
                <thead>
                  <tr>
                      <th>Item Name</th>
                      <th>Quantity</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($items_array as $key2) {
                    $temp2 = $key2['food_item'];
                    $sql3 = "SELECT * FROM food WHERE id = '$temp2'";
                    $query3  = $pdoconn->prepare($sql3);
                    $query3->execute();
                    $items_array2 = $query3->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($items_array2 as $key3) {
                      $foodname = $key3['fname'];
                    }
                  ?>
                    <tr>
                      <td><?php echo $foodname; ?></td>
                      <td><?php echo $key2['quantity']; ?></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
              </td>
              <td><?php echo $key['user_name']; ?></td>
              <td><?php echo $key['timestamp']; ?></td>
              <td><?php echo $key['total']; ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
	</div>
</div>

<?php require('layout/about-modal.php'); ?>
<?php require('layout/footer.php'); ?>