<?php 
session_start();
require_once "includes/db.php";
if (isset($_SESSION['email']) && isset($_SESSION['user_id'])) {

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
      text-align:center;
      padding-top:40px;
      padding-bottom:30px; 
    }
    a{
      
      color:#fff;
    }
    a:hover{
      text-decoration:none;
      color:var(--second-color);
    }
  </style>
  <body> 

<!--Navbar for logo-->
<nav class="navbar navbar-expand-md">
<div class="container-fluid">
  <a class="navbar-brand" href="index.php#about"><img src="img/mplogo.png" alt="logo"></a>
</div>



<!-- Meniu -->
    <div class="menu-wrap">
     
      <input type="checkbox" class="toggler">
      <div class="hamburger"><div></div></div>
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

<div class="content3">

<header class="showcase-projects">
<div class="container-h showcase-inner">
<h1 >Your Order Has Been Placed</h1>
    <p>Thank you for ordering from me, you'll receive an email with your order details in a short period.</p>
    <p>Check your order status and AWB code in your <a href="user-dashboard.php">
    User Dashboard
    </a> .</p>
    <?php if (isset($_GET['err'])) { ?>
     		<p class="error"><?php echo $_GET['err']; ?></p>
    <?php } ?>
  </div>
</header>



<?php
require_once "includes/footer.php";?>
  
  </div>
<?php
require_once "includes/script.php"; ?>
</body>
</html>




<?php
  unset($_SESSION["cart"]); 
} else{
    header("Location: login.php");
    exit(); }
?>
