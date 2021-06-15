<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Monday Panic</title>
    <?php require_once "includes/header.php"; 
    require_once "includes/db.php";?>
    <link rel="stylesheet"  href="styles/login.css"/>

  </head>
  <body> 

<div class="container-log" id="container-log">
	<div class="form-container sign-up-container">
		<form action="reg-log/register-process.php" method="post">

		<h1>Sign Up</h1>
	<div class="social-container">
        <a href="https://www.facebook.com/popa.maria.98478" class="social" target="_blank"><i class="fab fa-facebook"></i></a></li>
        <a href="https://www.instagram.com/p.m.4all/" class="social" target="_blank"><i class="fab fa-instagram"></i></a></li>
        <a href="https://www.linkedin.com/in/popa-maria-947378181/" class="social" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
        <a href=""><i class="fab fa-telegram" class="social" target="_blank"></i></a></li>
    </div>
	<span>or use your email for registration</span>
	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
    <?php } ?>

     <?php if (isset($_GET['success'])) { ?>
               <p class="success"><?php echo $_GET['success']; ?></p>
     <?php } ?>

	 <?php if(isset($_GET['fname'])) {?>
	<input type="text" name="fname" required="required" placeholder="First Name" value="<?php echo $_GET['fname'];?>">
	 <?php } else {?>
	 <input type="text" name="fname" required="required" placeholder="First Name"> 
	 <?php } ?>
	
	 <?php if(isset($_GET['lname'])) {?>
	<input type="text" name="lname" required="required" placeholder="Last Name" value="<?php echo $_GET['lname'];?>">
	 <?php } else {?>
	 <input type="text" name="lname" required="required" placeholder="Last Name"> 
	 <?php } ?>
	
	 <?php if(isset($_GET['email'])) {?>
	<input type="email" name="email" required="required" placeholder="Email" value="<?php echo $_GET['email']; ?>">
	<?php } else {?>
	<input type="email" name="email" required="required" placeholder="Email"> 
	<?php } ?>

	<input type="password" name="password" id="password-field" required="required"  placeholder="Password">
	

    <button type="submit" >Sign Up</button>

  </form>
</div>

<div class="form-container sign-in-container">

	<form action="reg-log/login-process.php" method="post">
		<h1>Sign in</h1>
		
		<div class="social-container">
            <a href="https://www.facebook.com/popa.maria.98478" 
			class="social" target="_blank"><i class="fab fa-facebook"></i></a></li>
            <a href="https://www.instagram.com/p.m.4all/" 
			class="social" target="_blank"><i class="fab fa-instagram"></i></a></li>
            <a href="https://www.linkedin.com/in/popa-maria-947378181/" 
			class="social" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
            <a href=""><i class="fab fa-telegram" 
			class="social" target="_blank"></i></a></li>
        </div>
		<?php if (isset($_GET['error-l'])){?>
				<p class="error-l"><?php echo $_GET['error-l'];?></p>
			<?php } ?>
		<input type="email" name="email" required="required"  placeholder="Email">
		<input type="password" name="password" id="password-field" required="required"  placeholder="Password" >
		
		<button type="submit" >Login</button>

	</form>

</div>

<div class="overlay-container">
	<div class="overlay">
		<div class="overlay-panel overlay-left">
			<h1>Welcome Back!</h1>
			<p>To keep connected with us please login with your personal info</p>
			<button class="ghost" id="signIn">Sign In</button>
		</div>

		<div class="overlay-panel overlay-right">
			<h1>Hello, Friend!</h1>
			<p>Enter your details and start journey with us</p>
			<button class="ghost" id="signUp">Sign Up</button>
		</div>

	</div>
</div>

</div>

<script type="text/javascript">
	const signUpButton = document.getElementById('signUp');
	const signInButton = document.getElementById('signIn');
	const container = document.getElementById('container-log');

	signUpButton.addEventListener('click', () => {
		container.classList.add("right-panel-active");
	});
	signInButton.addEventListener('click', () => {
		container.classList.remove("right-panel-active");
	});

	function _id(name){
    return document.getElementById(name);
  }

  function _class(name){
    return document.getElementsByClassName(name);
  }

  
</script>

<?php require_once "includes/script.php"; ?>
</body>
</html>
