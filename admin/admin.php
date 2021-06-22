<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Monday Panic</title>
    <?php require_once "../includes/header.php"; 
    require_once "../includes/db.php";?>

  </head>
<style>

*{
    box-sizing: border-box;
}

body {
    background: url('../img/walpaper.jpg') no-repeat center center/cover rgba(17, 6, 48 , 0.3);
	background-size:cover;
 	 background-blend-mode: multiply;
  	font-family: 'PT Serif', serif;
	display: flex;
	justify-content: center;
	align-items: center;
	flex-direction: column;
	height: 100vh;
	margin: -20px 0 50px;
}


.container-log {
	background-color: #fff;
	position: relative;
	width: 400px;
	min-height: 400px;
	border-radius: 20% !important;
}


h1 {
	font-weight: bold;
	margin: 0;
	color: #541D70 ;
}


p {
	font-size: 14px;
	font-weight: 100;
	line-height: 20px;
	letter-spacing: 0.5px;
	margin: 20px 0 30px;
}


a {
	font-size: 14px;
	text-decoration: none !important;
	margin: 15px 0;
}

button {
	border-radius: 20px;
	border: 1px solid #110630;
	background-color: #110630;
	color: #FFFFFF;
	font-size: 12px;
	font-weight: bold;
	padding: 12px 45px;
	letter-spacing: 1px;
	text-transform: uppercase;
	transition: transform 80ms ease-in;
}


button:active {
	transform: scale(0.95);
}

button:focus {
	outline: none;
}

button.ghost {
	background-color: transparent;
	border-color: #FFFFFF;
}

form {
	background-color: #FFFFFF;
	display: grid;
	align-items: center;
	justify-content: center;
	height: 100%;
	text-align: center;
  
}

input {
	background-color: #eee;
	border: none;
	padding: 12px 15px;
	margin: 8px 0;
	width: 100%;
	border-radius: 10px;
}


.social-container {
	margin: 20px 0;
}

.social-container a {
	border: 1px solid #DDDDDD;
	border-radius: 50%;
	display: inline-flex;
	justify-content: center;
	align-items: center;
	margin: 0 5px;
	height: 40px;
	width: 40px;
	text-decoration: none;
}

.social-container a i {
	color: #110630;
}
.social-container a:hover{
	transform: scale(1.2);
	color: #110630;
}

</style>

<body> 

<div class="container-log" id="container-log">
  <form action="admin-log.php" method="post">

	<h1>Admin Login</h1>
	<div class="social-container">
        <a href="https://www.facebook.com/popa.maria.98478" class="social" target="_blank"><i class="fab fa-facebook"></i></a></li>
        <a href="https://www.instagram.com/p.m.4all/" class="social" target="_blank"><i class="fab fa-instagram"></i></a></li>
        <a href="https://www.linkedin.com/in/popa-maria-947378181/" class="social" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
        <a href=""><i class="fab fa-telegram" class="social" target="_blank"></i></a></li>
    </div>
    <?php if (isset($_GET['error-a'])){?>
				<p class="error-a"><?php echo $_GET['error-a'];?></p>
			<?php } ?>
		<input type="email" name="email" required="required"  placeholder="Email">
		<input type="password" name="password" required="required" id="password-field" placeholder="Password">
		<button type="submit" >Login</button>

  </form>
</div>

<?php require_once "../includes/script.php"; ?>
</body>
</html>
