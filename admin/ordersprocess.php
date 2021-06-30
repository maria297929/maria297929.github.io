<?php 
session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['email'])) { ?>

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
        <img src="../img/me.jpg" alt="MP">
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
$msg = '';
// Check if POST data is not empty
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
       
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
       
        $order_status = isset($_POST['order_status']) ? $_POST['order_status'] : '';
        $code = isset($_POST['code']) ? $_POST['code'] : '';
        // Update the record
        $stmt = $pdo->prepare('UPDATE orders SET id = ?, order_status = ?, code = ?  WHERE id = ?');
        $stmt->execute([$id, $order_status, $code , $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM orders WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $order = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$order) {
        exit('Contact doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
 ?>
<div class="home_content">
    <div class="text">Hello MP</div>
    <div class="order_status update">
	<h2>Order #<?=$order['id']?></h2>

    <form action="ordersprocess.php?id=<?=$order['id']?>" method="post">
        <label for="id">ID</label>
        <input type="text" name="id" placeholder="26" value="<?=$order['id']?>" id="id">
      <br>
      <label for="order_status">Order Status</label><br>

  <input type="radio" id="order_status" name="order_status" value='In Progress'>
  <label for="order_status">In Progress</label><br>
  <input type="radio" id="order_status" name="order_status" value='Dispached'>
  <label for="order_status">Dispached</label><br>
  <input type="radio" id="order_status" name="order_status"value='Delivered'>
  <label for="order_status">Delivered</label><br>
       
    <label for="code">AWB Code</label>
        <input type="text" name="code" value="<?=$order['code']?>" id="code">

        <button type="submit" id="submit" name ='submit'>Submit</button>
    </form>

    <div class="home_content">
         <?php if ($msg): ?>
    <p><?php echo $msg?></p>
    <?php endif; ?>
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
} ?>