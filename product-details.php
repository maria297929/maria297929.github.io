<?php
session_start();
require_once "includes/db.php";
if (isset($_SESSION['email']) && isset($_SESSION['user_id'])) {


// Check to make sure the id parameter is specified in the URL
if (isset($_GET['id'])) {
    // Prepare statement and execute, prevents SQL injection
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    // Fetch the product from the database and return the result as an Array
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    // Check if the product exists (array is not empty)
    if (!$product) {
        // Simple error to display if the id for the product doesn't exists (array is empty)
        exit('Product does not exist!');
    }
} else {
    // Simple error to display if the id wasn't specified
    exit('Product does not exist!');
}


// Get the amount of items in the shopping cart, this will be displayed in the header.
$num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Monday Panic</title>
    <?php require_once "includes/header.php"; 
    require_once "includes/db.php";?>
  </head>
  <style>


h1{
  padding-left:80px;

}
.product-content{
  padding-left:80px;
  padding-bottom:50px;
}

h1{
  
  padding-top:80px;
  padding-bottom:30px;
  
}

.product-img{
  width: 90%;
}

.description{
  font-size: 1.5rem;
  padding:20px;
}

.submit{
  border-radius: 20px;
	border: 1px solid var(--first-color);
	background-color: var(--first-color);
	color: #FFFFFF;
	font-size: 12px;
	font-weight: bold;
	padding: 12px 45px;
	letter-spacing: 1px;
	text-transform: uppercase;
	transition: transform 80ms ease-in;
  
}

.cart  { 
  color:#fff;
  text-decoration:none;
}

.cart:hover{
  text-decoration:none;
	    color: #110630;
}


  </style>
  <body> 

<!--Navbar for logo-->
<nav class="navbar navbar-expand-md">
<div class="container-fluid">
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
              <li><a href="#about">About</a></li>
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


<div class="content">
  <h1 class="name"><?=$product['name']?></h1>
</br>
<div class="row product-content">
    <div class="col-md-5">
    <img class="product-img" src="img/<?=$product['img']?>"  alt="<?=$product['name']?>">
    </div>

    <div class="col-md-7">

          <div class="description">
                      <?=$product['description']?>
          </div>
          
        <form action="cart.php" method="post">
            <input type="number" name="quantity" value="1" min="1" max="10" placeholder="Quantity" required>
            <input type="hidden" name="product_id" value="<?=$product['id']?>">
            <input class="submit" type="submit" value="Add To Cart">
        </form>
        <span class="price">
               <p>Price <?=$product['price']?>lei</p>
        </span>
        <a class="cart" href="cart.php?page=cart" >
        <i class="fas fa-shopping-cart"></i>
        <span><?=$num_items_in_cart?></span></a>
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