<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Monday Panic</title>
    <link rel="stylesheet"  href="styles/style.css"/>
    <?php require_once "includes/header.php"; 
    require_once "includes/db.php";?>
  </head>
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
              <li><a href="index.php#about">About</a></li>
              <li><a href="projects.php">Projects</a></li>
              <li><a href="shop.php">Shop</a></li>
              <li><a href="#contact">Contact</a></li>
             <?php if (isset($_SESSION['email']) && isset($_SESSION['user_id'])) {?>
              <li><a href="user-dashboard.php">User Dashboard</a></li>
              <li><a href="reg-log/logout.php">Logout</a></li>
              <?php } ?>
            </ul>
          </div>
        
      </div>
      </div>
    </div>
  <!--/ Meniu /-->

</nav>
  

<header class="showcase-home">
<div class="container-h showcase-inner">
    <h1>Monday Panic</h1>
    <p>So we finally meet, hope you find what you're looking for</p>
</div>
</header>

<div class="content">
<!-- About me-->
<section class="section" id="about">
<div class="container">
  <div class="row">
        <div class="col-md-6">
          <img class="img-rounded" id="avatar" src="img/avatar.jpg" alt="Me">
        </div>
        <div class="col-md-6">
          <header class="section-header">
            <h1 class="section-title side-title text-left">Hi, I'm Mary.</h1>
            
            <p class="lead">I'm glad that you stumbled upon my website, I hope you enjoy it as much as I enjoyed working on it.</p>
            <p class="lead">In here you will find my portofolio, my services and the shop with all my creations, but please feel free to contact me anytime if you want us to work on a new project.</p>
            <p class="lead">Monday Panic is a concept that came to me while studying at university and pulling all nighters, I find that humour is the best option in these situations.</p>
            

          </header>
        </div>
        <div class="row">
        <div class="col-md-6">
          <header class="section-header">            
            <p class="lead">But since we are all familiar with </p>
            <p class="lead"></p>
            <p class="lead"> When all your work is pilled up and that deadline is coming at you faster than Usain Bolt feel free to contact me either with my form down below, or maybe you prefer social media.</p>
            <p class="lead">Keep up the good work and I hope <a href="#contact" style="text-decoration:none; color:#F88055; font-weight:bold;">I'll hear from you soon</a>.</p>

          </header>
        </div>
        <div class="col-md-6">
          <img class="img-rounded" id="avatar" src="img/avatar.jpg" alt="unidraw">
        </div>      
  </div>

</section>

<!-- /About me/-->


<!--Services-->
<section class="section" id="services">
  <div class="container"> 
    <div class="row">
      <div class="col-md-12">
        <header class="section-header">
          <h2 class="section-title">Services</h1>
          <p class="lead text-center"> These are the services that I provide as a web-design freelancer and an artist</p>
        </header>
      </div>    
    </div>
    <div class="row features-list">
        <div class="col-md-4 feature-item text-center">
        <i class="fas fa-crop feature-icon"></i>
          <h3 class="feature-title">Web sites</h3>
          <p class="feature-description">If you are looking for a web-designer to bring your ideas to life, you found the right person! I can create your blog, e-commerce site, business site and much more.</p>
        </div>
    
        <div class="col-md-4 feature-item text-center">
        <i class="fas fa-edit feature-icon"></i>
          <h3 class="feature-title">Front-end design</h3>
          <p class="feature-description">Maybe you need an interesting poster, logo or background. I just had to make sure that you know that I also enjoy doing these kind of projects. Tell me your idea and lets get started! </p>
        </div>
    
        <div class="col-md-4 feature-item text-center">
        <i class="fas fa-palette feature-icon"></i>
          <h3 class="feature-title">Art works</h3>
          <p class="feature-description">And if you enjoy my art style, then take a look at my Shop, I'm sure you'll find something that suits you. But if you want something more personal or you have a project in mind feel free to contact me and I'll bring them to life. </p>
        </div>
  </div>
</div>
</section>
<?php
require_once "includes/footer.php";
?>
</div>

<?php
require_once "includes/script.php"; ?>
</body>


</html>
