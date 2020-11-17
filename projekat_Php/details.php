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
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="strana0.css">
        <link rel="stylesheet" type="text/css" href="navbar.css">
        <title>Details</title>
    </head>
    <body>
        <nav>
		<ul id="menu">
			<li class="home"><a href='profile.php'><img style="vertical-align: middle;" src="pictures/menu/arrow-left.png" height="20px" width="20px"></a></li>
		</ul>
	</nav>
        
        <h2 style="text-align: center; color: #00004c;">Podatci o korisniku:</h2>
        <div align="center" style="background-color:#f1f1f1;">
        <table>
            <tr><td><span style="font: italic 18px Arial; color: #00004c;">Ime korisnika:</span></td><td><?php echo $userData['name'];?></td><tr>
            <tr><td><span style="font: italic 18px Arial; color: #00004c;">Imejl:</span></td><td><?php echo $userData['email'];?></td></tr>
            <tr><td><span style="font: italic 18px Arial; color: #00004c;">Korisničko ime:</span></td><td> <?php echo $userData['username'];?></td></tr>
            <tr><td><span style="font: italic 18px Arial; color: #00004c;">Šifra:</span></td><td> <?php echo $userData['password'];?></td></tr>
            <tr><td><span style="font: italic 18px Arial; color: #00004c;">Datum registracije:</span></td><td> <?php echo $userData['reg_date'];?></td></tr>
            <tr><td><span style="font: italic 18px Arial; color: #00004c;">Stanje:</span></td><td> <?php echo $userData['stanje']." din.";?></td></tr>
        </table>
    </div>
    </body>
</html>
