<?php 
ob_start();
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
    <?php require_once "includes/header.php"; ?>
  </head>
  <style>
    
    h1{
        padding:40px;
    }
    .glancing{
        padding-left:50px;
        padding-bottom:30px;
    }
    .cart-content{
        padding-bottom:30px;
    }
    a{
        text-decoration:none;
        color:#fff;
    }
    a:hover{
        text-decoration:none;
        color:var(--third-color); 
    }

    .content-wrapper{
        justify-content:left;
        padding-left:40px;
        color:#fff;
    }

    table {
        line-height: 1.4;
    }
    table thead tr td{
        padding-right:20px;
      
    }

    table tbody tr td{
        padding:20px;
    }
    
    .update{
        padding-top:20px;
        padding-bottom:20px;
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

    h2{
        padding-bottom:30px;
    }

    .update{
        justify-content:left;
        padding-left:40px;
        color:#fff;
    }
    
input {
	background-color: #eee;
	border: none;
	padding: 12px 15px;
	margin: 8px;
	border-radius: 10px;
	position:relative;
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

<?php

if (isset($_POST['product_id'], $_POST['quantity']) && is_numeric($_POST['product_id']) && is_numeric($_POST['quantity'])) {
    // Set the post variables so we easily identify them, also make sure they are integer
    $product_id = (int)$_POST['product_id'];
    $quantity = (int)$_POST['quantity'];
  
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');

    $stmt->execute([$_POST['product_id']]);

    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    // Check if the product exists 
    if ($product && $quantity > 0) {
        // Product exists in database, now we can create/update the session variable for the cart
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            if (array_key_exists($product_id, $_SESSION['cart'])) {
                // Product exists in cart so just update the quantity
                $_SESSION['cart'][$product_id] += $quantity;
            } else {
                // Product is not in cart so add it
                $_SESSION['cart'][$product_id] = $quantity;
            }
        } else {
            // There are no products in cart, this will add the first product to cart
            $_SESSION['cart'] = array($product_id => $quantity);
        }
    }
    // Prevent form resubmission...
    header('location:cart.php?page=cart');
    exit;
}

// Remove product from cart
if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['remove']])) {

    unset($_SESSION['cart'][$_GET['remove']]);
}

// Update product quantities in cart 
if (isset($_POST['update']) && isset($_SESSION['cart'])) {
    // Loop through the post data so we can update the quantities for every product in cart
    foreach ($_POST as $k => $v) {
        if (strpos($k, 'quantity') !== false && is_numeric($v)) {
            $id = str_replace('quantity-', '', $k);
            $quantity = (int)$v;
            // Always do checks and validation
            if (is_numeric($id) && isset($_SESSION['cart'][$id]) && $quantity > 0) {
                // Update new quantity
                $_SESSION['cart'][$id] = $quantity;
            }
        }
    }
    // Prevent form resubmission...
    header('location: cart.php?page=cart');
    exit;
}



// Check the session variable for products in cart
$products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$products = array();
$subtotal = 0.00;
if ($products_in_cart) {
    // There are products in the cart so we need to select those products from the database
    // Products in cart array to question mark string array, we need the SQL statement to include IN (?,?,?,...etc)
    $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id IN (' . $array_to_question_marks . ')');
    // We only need the array keys, not the values, the keys are the id's of the products
    $stmt->execute(array_keys($products_in_cart));
    
    // Fetch the products from the database and return the result as an Array
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Calculate the subtotal
    foreach ($products as $product) {
        $subtotal += (float)$product['price'] * (int)$products_in_cart[$product['id']];
    
    }
 
}


 $stmt = $pdo->prepare('SELECT * FROM users WHERE email =  ?');
 $stmt->execute([$_SESSION['email']]);
 $details = $stmt->fetch(PDO::FETCH_ASSOC);


 // Check if POST data is not empty
 if (isset($_POST['order_placed'])) {
     // Post data not empty insert a new record
     $fname = $_POST['fname'];
     $lname = $_POST['lname'];
     $adress = $_POST['adress'] ;
     $mobile = $_POST['mobile'] ;
     $email = $_SESSION['email'];
     // Insert new record into the contacts table

     if ($stmt -> rowCount() === 1){
    
         $stmt = $pdo->prepare('UPDATE users SET  fname = ?, lname = ?, adress = ?, mobile = ?  WHERE email =  ?');
          $stmt->execute([$fname, $lname, $adress, $mobile, $email ]);

         $stmt1 = $pdo ->prepare('INSERT INTO orders (user_email, total_price) VALUES ( ?, ?)'); 
         $stmt1->execute([$email, $subtotal]);
       
//inc

if ($products_in_cart) {
    // There are products in the cart so we need to select those products from the database
    // Products in cart array to question mark string array, we need the SQL statement to include IN (?,?,?,...etc)
    $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id IN (' . $array_to_question_marks . ')');
    // We only need the array keys, not the values, the keys are the id's of the products
    $stmt->execute(array_keys($products_in_cart));
    
    // Fetch the products from the database and return the result as an Array
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Calculate the subtotal
    foreach ($products as $product) {
        $Tot_product = (float)$product['price']*(int)$products_in_cart[$product['id']]; 
        $stmt = $pdo ->prepare('INSERT INTO order_items (product_id,product_name, quantity, product_price, email) VALUES (?,?, ?, ?, ?) ');
        $stmt ->execute([$product['id'],$product['name'],$products_in_cart[$product['id']],$Tot_product, $_SESSION['email']]);
        
    }
    
}
     if($stmt){
         header("Location: order-placed.php");
     }    
        
      
 } else{
    header("Location: order-placed.php");
   
    
     }  
}

?>

<div class="content ">
    
    <div class="head-cart">
    <h1 class="text-center">Shopping Cart</h1>
    <p class="glancing"> Continue glancing through the <a href="shop.php" class="link-shop" > products</a></p>
   
    </div>
    <div class="row cart-content">

    <div class="col-md-6 cart  content-wrapper">
        <h2>Products in your cart</h2>
    <form action="cart.php" method="post">
        <table class="table-cart">
            <thead >
                <tr>
                    <td colspan="2">Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Total</td>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($products)): ?>
                <tr>
                    <td colspan="5" style="text-align:center;">You have no products added in your Shopping Cart</td>
                </tr>
                <?php else: ?>
                <?php foreach ($products as $product): ?>
          
                <tr>
                    <td class="img">
                        <a href="cart.php?page=product&id=<?=$product['id']?>">
                            <img src="imgs/<?=$product['img']?>" width="50" height="50" alt="<?=$product['name']?>">
                        </a>
                    </td>
                    <td>
                        <a href="cart.php?page=product&id=<?=$product['id']?>"><?=$product['name']?></a>
                        <br>
                    </td>
                    <td class="price"><?=$product['price']?> lei</td>
                    <td class="quantity">
                        <input type="number" name="quantity-<?=$product['id']?>" value="<?=$products_in_cart[$product['id']]?>" min="1" max="10" placeholder="Quantity" required>
                    </td>
                    <td class="price"><?=$product['price'] * $products_in_cart[$product['id']]?></td>
                    <td>
                    <a href="cart.php?page=cart&remove=<?=$product['id']?>" class="remove">Remove</a>

                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <br>
        
            <div class="subtotal ">
                 <span class="text">Subtotal</span>
            <span class="price"><?php echo $subtotal?> lei </span>
            </div>
           <div class="update">
              <input class="submit" type="submit" value="Update" name="update">
             </div>
         </form>
</div>


 <div class="col-md-6 update">

 <h2>Insert you personal data for your order</h2>
    <form action="" method="post">
        <label for="fname">First Name</label>
        <input type="text" name="fname" placeholder="First Name" value="<?=$details['fname']?>" id="fname" required>
        <label for="lname">Last Name</label>
        <input type="text" name="lname" placeholder="Last Name" value="<?=$details['lname']?>" id="lname" required>
    </br>
        <label for="email">Email</label>
        <input type="email" name="email"  value="<?=$_SESSION['email']?>" id="email" required>
          
        <label for="mobile">Mobile</label>
        <input type="text" name="mobile" placeholder="0754896523" value="<?=$details['mobile']?>" id="mobile" required>
            
    </br>
        <label for="adress">Adress</label>
        <input type="text" name="adress" placeholder="Str, et, ap , nr" value="<?=$details['adress']?>" id="adress" required>
        
        <p>The payment will be cash on delivery</p>

        <div class="buttons">
             <input class="submit" type="submit" value="Order Placed" name="order_placed">
        </div>
      

    </form>
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
ob_end_flush();
?>