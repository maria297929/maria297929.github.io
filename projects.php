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

.image-popup {
    display: none;
    flex-flow: column;
    justify-content: center;
    align-items: center;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.8);
    z-index: 99999;
}
.image-popup .con {
    display: flex;
    flex-flow: column;
    background-color: #ffffff;
    padding: 25px;
    border-radius: 5px;
}
.image-popup .con h3 {
    margin: 0;
    font-size: 18px;
}
.image-popup .con .edit, .image-popup .con .trash {
    display: inline-flex;
    justify-content: center;
    align-self: flex-end;
    width: 40px;
    text-decoration: none;
    color: #FFFFFF;
    padding: 10px 12px;
    border-radius: 5px;
    margin-top: 10px;
}
.image-popup .con .trash {
    background-color: #b73737;
}
.image-popup .con .trash:hover {
    background-color: #a33131;
}
.image-popup .con .edit {
    background-color: #37afb7;
}
.image-popup .con .edit:hover {
    background-color: #319ca3;
}

.images {
    display: flex;
    flex-flow: wrap;
}
.images a {
    display: block;
    text-decoration: none;
    position: relative;
    overflow: hidden;
   
    margin: 0 20px 20px 0;
}
.images a:hover span {
    opacity: 1;
    transition: opacity 1s;
}
.images span {
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    position: absolute;
    opacity: 0;
    top: 0;
    left: 0;
    color: #fff;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.2);
    padding: 15px;
    transition: opacity 1s;
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
<?php
$stmt = $pdo->query('SELECT * FROM projects ORDER BY date DESC');
$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

    <div class="images">

        <?php foreach ($projects as $project): ?>
		<a href="#">
			<img src="projects/<?=$project['img']; ?>" style="width: 400px"  alt="<?php echo $project['description'];?><br/><?php echo $project['date']?>" data-title="<?=$project['name']?>"  >
      <span><?=$project['name']?></span>
		</a>

		<?php endforeach; ?>
    </div>
<div class="image-popup"></div>

<script>

// Container we'll use to show an image
let image_popup = document.querySelector('.image-popup');
// Loop each image so we can add the on click event
document.querySelectorAll('.images a').forEach(img_link => {
	img_link.onclick = e => {
		e.preventDefault();
		let img_meta = img_link.querySelector('img');
		let img = new Image();
		img.onload = () => {
			// Create the pop out image
			image_popup.innerHTML = `
				<div class="con content3">
					<h3>${img_meta.dataset.title}</h3>
					<p>${img_meta.alt}</p>
					<img src="${img.src}" width="500px" >
				</div>
			`;
			image_popup.style.display = 'flex';
		};
		img.src = img_meta.src;
	};
});
// Hide the image popup container if user clicks outside the image
image_popup.onclick = e => {
	if (e.target.className == 'image-popup') {
		image_popup.style.display = "none";
	}
};
</script>
<?php require_once "includes/footer.php"; ?>
</div>
 <script src="includes/script.js"></script>
</body>
</html>
