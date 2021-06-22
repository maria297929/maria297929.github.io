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
    <link rel="stylesheet"  href="styles/shop.css"/>
    <?php require_once "includes/header.php"; 
    ?>
  </head>
 
  <body> 

<!--Navbar for logo-->
<nav class="navbar navbar-expand-md">
<div class="container-fluid ">
  <a class="navbar-brand" href="#about"><img src="img/mplogo.png" alt="logo"></a>
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
              <li><a href="user-dashboard.php">User Dashboard</a></li> 
              <li><a href="reg-log/logout.php">Logout</a></li>
            </ul>
          </div>
        
      </div>
      </div>
    </div>
  <!--/ Meniu /-->

</nav>

<?php

// The amounts of products to show on each page
$num_products_on_each_page = 9;
// The current page, in the URL this will appear as index.php?page=products&p=1, index.php?page=products&p=2, etc...
$current_page = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;
// Select products ordered by the date added
$stmt = $pdo->prepare('SELECT * FROM products ORDER BY date_added DESC LIMIT ?,?');
// bindValue will allow us to use integer in the SQL statement, we need to use for LIMIT
$stmt->bindValue(1, ($current_page - 1) * $num_products_on_each_page, PDO::PARAM_INT);
$stmt->bindValue(2, $num_products_on_each_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the products from the database and return the result as an Array
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Get the total number of products
$total_products = $pdo->query('SELECT * FROM products')->rowCount();

// Get the amount of items in the shopping cart, this will be displayed in the header.
$num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;

?>
<div class="content">

<div class="header content-wrapper container-h text-center">
    <h1>Hope you find something to take home</h1>
</div>

<div>
    <div class="products-total">
    <p>Currently you can find <?=$total_products?> products in my shop.</p>
    </div>
  
   <div class="cart text-right">
      <p>Go to check-out
      <a href="cart.php?page=cart" >
      <i class="fas fa-shopping-cart"></i>
      <span><?=$num_items_in_cart?></span>
      </a>
      </p>
   </div>
   
    <div class="products-wrapper text-center">
        <?php foreach ($products as $product): ?>
        <a href="product-details.php?page=product&id=<?=$product['id']?>" class="product">
        <span class="name"><?=$product['name']?></span>
        <br>
        <img src="img/<?=$product['img']?>"  alt="<?=$product['name']?>">
        <span class="price">
               <p><?=$product['price']?>lei</p>            
            </span>
        </a>
        <?php endforeach; ?>
   
        </div>

    <div class="pagination">
        <?php if ($current_page > 1): ?>
        <a href="shop.php?page=products&p=<?=$current_page-1?>" class="text-right">Next</a>
        <?php endif; ?>
        <?php if ($total_products > ($current_page * $num_products_on_each_page) - $num_products_on_each_page + count($products)): ?>
        <a href="shop.php?page=products&p=<?=$current_page+1?>"  class="text-left">Previous</a>
        <?php endif; ?>
    </div>



  </div>
<?php require_once "includes/footer.php";?>
</div>
<?php require_once "includes/script.php"; ?>
</body>
</html>

<?php } else{
    header("Location: login.php");
    exit(); }
?>