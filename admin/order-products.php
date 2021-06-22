<?php 
session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['email']) ){ 
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Monday Panic</title>
    <link rel="shortcut icon" href="../img/mplogo.png" type="image/x-icon">

    <?php require_once "../includes/header.php"; 
    require_once "../includes/db.php";?>
    <link rel="stylesheet"  href="admin.css"/>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<div class="sidebar">
    <div class="logo_content">
      <div class="logo">
      <a class="navbar-brand" href="#about"><img src="../img/mplogo.png" alt="logo"></a>
        <div class="logo_name">Monday Panic</div>
      </div>
      <i class='bx bx-menu' id="btn" ></i>
    </div>
    <ul class="nav_list">
      
      <li>
        <a href="customers.php">
          <i class='bx bx-user' ></i>
          <span class="links_name">Customers</span>
        </a>
        <span class="tooltip">Customers</span>
      </li>
      <li>
        <a href="messages.php">
          <i class='bx bx-chat' ></i>
          <span class="links_name">Messages</span>
        </a>
        <span class="tooltip">Messages</span>
      </li>
      <li>
        <a href="projects.php">
          <i class='bx bx-folder' ></i>
          <span class="links_name">Projects</span>
        </a>
        <span class="tooltip">Projects</span>
      </li>
       <li>
        <a href="products.php">
          <i class='bx bx-heart' ></i>
          <span class="links_name">Products</span>
        </a>
        <span class="tooltip">Products</span>
      </li>
      <li>
        <a href="orders.php">
          <i class='bx bx-cart-alt' ></i>
          <span class="links_name">Orders</span>
        </a>
        <span class="tooltip">Orders</span>
      </li>
     
    </ul>
    <div class="profile_content">
      <div class="profile">
        <div class="profile_details">
          <img src="../img/avatar.jpg" alt="">
          <div class="name_job">
            <div class="name">Popa Maria</div>
            <div class="job">Web Designer</div>
          </div>
        </div>
        <a href="logout_admin.php"> 
            <i class='bx bx-log-out' id="log_out" ></i>
        </a>
      </div>
    </div>
</div>
<?php 

$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 4;

?> 
<div class="home_content">
    <div class="text">Hello MP</div>
    <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card ">
              <div class="card-header">
                <h4 class="card-title">Order Products</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table tablesorter " id="">
                    <thead class=" text-primary">
                      <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Order Date</th>
                      </tr>
                    </thead> 
                    <tbody> 
                    <?php
                     // Prepare the SQL statement and get records from our contacts table, LIMIT will determine the page
$timestamp = $_GET['timestamp'];
$stmt = $pdo->prepare("SELECT * FROM order_items  WHERE timediff('$timestamp',order_date) = 0
LIMIT :current_page, :record_per_page");
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Get the total number of contacts, this is so we can determine whether there should be a next and previous button
$num_items = $pdo->query('SELECT COUNT(*) FROM order_items')->fetchColumn();
 foreach ($items as $item): ?>
  <tr>
      <td><?=$item['product_id']?></td>
      <td><?=$item['product_name']?></td>
      <td><?=$item['quantity']?></td>
      <td><?=$item['product_price']?></td>
      <td><?=$item['order_date']?></td>

    </tr>
    <?php endforeach; ?>
                </div>
            </div>
        </div>
     </div>
    </div>
  </div>
 </div>

  <script>
   let btn = document.querySelector("#btn");
   let sidebar = document.querySelector(".sidebar");
   let searchBtn = document.querySelector(".bx-search");

   btn.onclick = function() {
     sidebar.classList.toggle("active");
     if(btn.classList.contains("bx-menu")){
       btn.classList.replace("bx-menu" , "bx-menu-alt-right");
     }else{
       btn.classList.replace("bx-menu-alt-right", "bx-menu");
     }
   }
   searchBtn.onclick = function() {
     sidebar.classList.toggle("active");
   }

   $("#submit").click(function() {
   alert("The Form has been Submitted.");
});
  </script>

<?php require_once "../includes/script.php"; ?>
</body>
</html>
<?php } else {
    header("Location: admin.php");
    exit();
}
 ?>