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
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $date = isset($_POST['date']) ? $_POST['date'] : date('Y-m-d H:i:s');
    $desc = isset($_POST['description']) ? $_POST['description'] : ''; 
    $img = isset($_POST['img']) ? $_POST['img'] : '';
    // Insert new record into the contacts table
    $location = "../projects/";
    $location.= $img;
    $stmt = $pdo->prepare('INSERT INTO projects VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$id, $name, $desc, $location, $date]);
    // Output message
    $msg = 'Created Successfully!';
}
 ?>
<div class="home_content">
    <div class="text">Hello MP</div>
    <div class="content update">
	<h2>Create Product</h2>
    <form action="add-project.php" method="post">
        <label for="id">ID</label>
        <input type="text" name="id" placeholder="26" value="auto" id="id">
        <br>
        <label for="name">Name</label>
        <input type="text" name="name" placeholder="Name" id="name">
</br>
        <label for="size">Date</label>
        <input type="datetime-local" name="size" placeholder="7856522" value="<?=date('Y-m-d\TH:i')?>" id="date">
</br>
        <label for="description">Description</label>
        <textarea  name="description" rows="3" style="width:300px; height: 100px" id="description"></textarea>
</br>
        <label for="img">Product Image</label>
         <p >Only jpg/png are allowed.</p>
			<input type="file" name="img" id="img">
        <button type="submit" id="submit" name ='submit'>Submit</button>
    </form>
    <?php if ($msg): ?>
    <p><?php echo $msg?></p>
    <?php endif; ?>
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