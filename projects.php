<?php 
session_start();
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
  <body> 
<style>
.showcase-projects {
    background-color: var(--primary-color);
    color: #fff;
    height: 100vh;
    position: relative;
}

.showcase-projects::before{
    content: " ";
    background: url('img/back.png') no-repeat center center/cover;
    position: absolute;
    top:0;
    width: 100%;
    height: 100%;
    z-index:-1;

}

.showcase-projects .showcase-inner{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    height: 100%;
}

.showcase-projects h1 {
    font-size: 4rem;
}

.showcase-projects p{
    font-size: 1.3rem;
}

#carouselExampleControls {
    padding-top:10px;
    padding-bottom:20px;
    width: 900px;
    top: 50%;
    left: 20%;
}

.carousel-caption{
  background-color: rgba(47, 47, 49, 0.7);
  width: auto;
  bottom:0px;
}

.carousel-caption h5{
  color:black;
}

.carousel-caption p{
  font-family: 'Merriweather', serif;
}

</style>
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
              <li><a href="login.php">Login</a></li>            
            </ul>
          </div>
        
      </div>
      </div>
    </div>
</nav>
<!--/ Meniu /-->

<header class="showcase-projects">
<div class="container-h showcase-inner">
    <h1>My projects</h1>
    <p>For the past 3 years I've completed a number of projects, you can check them out down below <i class="fas fa-level-down-alt"></i></p>
</div>
</header>

<div class="content">

<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
<div class="carousel-inner" >

    <div class="carousel-item active">
      <img src="projects/benu.png" class="d-block w-100" alt="BENNU">
      </br>
      <div class="carousel-caption d-none d-md-block" style="bottom:25px;">
        <h5>BENNU</h5>
        <p>I designed handbag models for an upcoming fashion brand.</p>
      </div>
    </div>

<?php $stmt = $pdo->query('SELECT * FROM projects ORDER BY DATE');
$projects= $stmt->fetchAll(PDO::FETCH_ASSOC);
 foreach ($projects as $project): ?>

    <div class="carousel-item ">
        <img src="projects/<?=$project['img'];?>" class="d-block w-100"   alt="<?php echo $project['name'];?>">
     <div class="carousel-caption d-none d-md-block">
         <h5><?php echo $project['name'];?></h5>
         <p><?php echo $project['description'];?></p>
     </div>
    </div>
  <?php endforeach; ?>
  </div>

  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>


</div>
<?php require_once "includes/footer.php"; ?>
</div>

<script src="includes/script.php"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</body>
</html>
