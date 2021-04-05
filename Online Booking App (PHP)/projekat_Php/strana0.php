<!DOCTYPE html>
<html>
<head>
	<title >Početna strana</title>
        <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="navbar.css">
	<link rel="stylesheet" type="text/css" href="slideshow.css">
	<link rel="stylesheet" type="text/css" href="strana0.css">
</head>
<body>
<nav>
  <ul id='menu'>
    <li><a class='home' href='strana0.php'><img src="pictures/menu/homepage.png" height="12px" width="15px"> Početna</a></li>
    <li><a class='prett' href='#' title='Menu'>Ponude</a>
      <ul class='menus'>
        <li class='has-submenu'><a class='prett' href='#' title='Dropdown 1'>Usluge</a>
          <ul class='submenu'>
            <li><a href="uplata.php" title="Sub Menu"><img style='vertical-align:middle;' src='pictures/pay.png' height='15px' width='15'></img> Uplata</a></li>
            <li><a href="Korpa.php" title="Sub Menu"><img style='vertical-align:middle;' src='pictures/basket.png' height='15px' width='15'></img> Korpa</a></li>
            <li><a href="Pretraga.html" title="Sub Menu"><img style='vertical-align:middle;' src='pictures/search2.png' height='15px' width='15'></img> Pretraga</a></li>
          </ul>
        </li>
        <li><a href='oProjektu.html' title='Dropdown 2'>O projektu</a></li>
        <li><a href='Reklamacije.php' title='Dropdown 3'>Reklamacije</a></li>
      </ul>
    </li>
    <?php 
    require_once('php/login_config.php');
    
    if(!isset($_SESSION['userID'])){
    echo "<li><a href='login-form.php' title='Login'><img style='vertical-align:middle;' src='pictures/user.png' height='15px' width='15'></img> Prijava</a></li>";
    }
    else{
        
    echo "<li><a id='logout' href='profile.php'><img style=' vertical-align:middle;' src='pictures/profilepics/".$_SESSION["slika"]."' height='15px' width='15'></img> Profil</a></li>";
    }
     ?>
    <?php 
    if(!isset($_SESSION['userIDadmin'])){
    echo "<li><a href='login-administrator.php' title='Login-administrator'><img style='vertical-align:middle;' src='pictures/user.png' height='15px' width='15'></img> Prijava-administrator</a></li>";
    }
    else{
     echo "<li><a id='logout' href='profile-admin.php'><img style=' vertical-align:middle;' src='pictures/profilepics/".$_SESSION["slikaAdmin"]."' height='15px' width='15'></img> Profil-admin</a></li>";
    }
     ?>
    <li><a href="strana0.php">sr-lat <img src="pictures/menu/serbian_flag.png" height="12px" width="15px"></a></li>
    <li><a href="strana0-srcir.php">ср-ћир <img src="pictures/menu/serbian_flag.png" height="12px" width="15px"></a></li>
  </ul>
</nav>
	
<div class="slideshow-container">
	<div class="mySlides fade">
		<div class="numbertext">Hram Svetog Aleksandra Nevskog,Sofija</div>
                <a href="pretraga.php?naziv=Sofija" ><img src="pictures/slideshow/bulgaria1.jpg" style="width:100%"></a>
		<div class="text">Caption text</div>
	</div>

	<div class="mySlides fade">
		<div class="numbertext">Aja Sofija,Istanbul</div>
                <a href="pretraga.php?naziv=Istanbul"><img src="pictures/slideshow/turkey1.jpg" style="width:100%"></a>
		<div class="text">Caption Two</div>
	</div>

	<div class="mySlides fade">
		<div class="numbertext">Partenon,Atina</div>
                <a href="pretraga.php?naziv=Atina"><img src="pictures/slideshow/greece3.jpg" style="width:100%"></a>
		<div class="text">Caption Three</div>
	</div>
<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
<a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>
<br>

<div style="text-align:center">
	<span class="dot" onclick="currentSlide(1)"></span>
	<span class="dot" onclick="currentSlide(2)"></span>
	<span class="dot" onclick="currentSlide(3)"></span>
</div>

	<script type="text/javascript">
		var slideIndex=1;
		showSlides(slideIndex);

		function plusSlides(n){
			showSlides(slideIndex +=n);
		}

		function currentSlide(n){
			showSlides(slideIndex=n);
		}

		function showSlides(n){
			var i;
			var slides=document.getElementsByClassName("mySlides");
			var dots=document.getElementsByClassName("dot");
			if(n>slides.length){slideIndex=1;}
				if(n<1){slideIndex=slides.length;}
					for (i = 0; i < slides.length; i++) {
						slides[i].style.display="none";
					}
			for (i = 0; i < dots.length; i++) {
				dots[i].className=dots[i].className.replace("	active","");
			}
			slides[slideIndex-1].style.display="block";
			dots[slideIndex-1].className +="	active";
		}
	</script>



<div class="main">
		<p></p>
</div>



</body>
</html>