<?php
 require('php/login_config.php');
 
 if(!isset($_SESSION['userID'])){
    header("Location:login-form.php");
    exit();
 }
 else{
    $userData=getUserData($_SESSION['userID']);
 }
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Korpa</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="strana0.css">
        <link rel="stylesheet" type="text/css" href="navbar.css">
        <script>
            function brisi(id){
                var odgovor=confirm("Brisanje stavke korpe:Da li ste sigurni?");
                if(odgovor){
                    window.location="brisi-korpa.php?id="+id;
                }
                else{
                    return false;
                }
            }
            function kupi(suma){
                var odgovor=confirm("Potvrda placanja:Da li ste sigurni?");
                if(odgovor){
                    window.location="kupi-korpa.php?suma="+suma;
                }
                else{
                    return false;
                }
            }
        </script>
    </head>
    <body>
        <nav>
		<ul id="menu">
                    <li class="home"><a href='profile.php'><img style="vertical-align: middle;" src="pictures/menu/arrow-left.png" height="20px" width="20px"></a></li>
                    <li class="home"><p style="padding-left: 5px; padding-right: 5px;">Korisnik <?php echo $userData["name"]; ?> </p></li>
		</ul>
	</nav>
        <?php
        // put your code here
        require_once "php/profil.php";
        
        $profil=new profil();
        
        $profil->prikazi_korpu($_SESSION["userID"]);
        ?>
    </body>
</html>
