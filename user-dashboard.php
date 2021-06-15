<?php 
session_start();
require_once "includes/db.php";
if (isset($_SESSION['email']) && isset($_SESSION['user_id'])) {?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Monday Panic</title>
    <?php require_once "includes/header.php";?>
   
  </head>
  <body> 
<style>
  .container-h{
    padding: 50px;
    font-size:4rem;
    justify-content:center;
    align-items: center;
    display: flex;
  }
.dashboard{
 color:#fff;
 padding-left:50px;

}
.table-user{
  color:#fff;
  padding: 50px;
}
th{
  color:#fff;
}
td{
  color:#fff;
}
</style>
<!--Navbar for logo-->
<nav class="navbar navbar-expand-md">
<div class="container-fluid">
  <a class="navbar-brand" href="index.php#about"><img src="img/mplogo.png" alt="logo"></a>
</div>
<!-- Meniu -->

    <div class="menu-wrap">
    
    <input type="checkbox" class="toggler">
    <div class="hamburger">
        <div></div>
    </div>
      <div class="menu">
        <div>
          <div >
            <ul>
              <li><a href="index.php">Home</a></li>
              <li><a href="index.php#about">About</a></li>
              <li><a href="projects.php">Projects</a></li>
              <li><a href="shop.php">Shop</a></li>
              <li><a href="#contact">Contact</a></li>
              <li><a href="reg-log/logout.php">Logout</a></li>

            </ul>
          </div>
        
      </div>
      </div>
    </div>
  <!--/ Meniu /-->

</nav>
<div class="content2">

<div class="container-h showcase-inner">
    <h1>User Dashboard</h1>
</div>

<?php
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 5;
 ?>
<div class="user_content">
      <h4 class="dashboard">Orders</h4> 
          <div class="table-user">
                  <table class="table table-striped table-hover " >
                    <thead class="text-primary">
                      <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Total Price</th>
                        <th>Order Status</th>
                        <th>AWB Code</th>
                      </tr>
                    </thead> 
                    <tbody>
                      <?php
                      // Prepare the SQL statement and get records from our contacts table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM orders ORDER BY id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Get the total number of contacts, this is so we can determine whether there should be a next and previous button
$num_orders = $pdo->query('SELECT COUNT(*) FROM orders')->fetchColumn();
 foreach ($orders as $order): ?>
  <tr>
      <td><?=$order['id']?></td>
      <td><?=$order['timestamp']?></td>
      <td><?=$order['total_price']?></td>
      <td><?=$order['order_status']?></td> 
      <td><?=$order['code']?></td>
  </tr>
  <?php endforeach; ?>
                  </tbody>
                  </table>
                  <div class="pagination">
		<?php if ($page > 1): ?>
		<a href="user-dashboard.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_orders): ?>
		<a href="user-dashboard.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	           </div>
            </div>
          </div>
       

<?php
require_once "includes/footer.php";?>
</div>
<?php
require_once "includes/script.php"; ?>
</body>
</html>

<?php } else{
    header("Location: login.php");
    exit(); }
?>