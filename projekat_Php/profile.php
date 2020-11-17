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
<?php 
include "php/profil.php" ;
            
    $profil=new profil();
            
    $nizS=$profil->prikazi_ime_slike($_SESSION["userID"]);
    $pic=$nizS[0][1];
    $_SESSION["slika"]=$pic;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Profile</title>
        <link rel="stylesheet" type="text/css" href="profile.css">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="strana0.css">
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
    </head>
    <body>
        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a href="strana0.php"><img src="pictures/white-home.png" height="25px" width="25px" alt="nema"></a>
            <a href="podesavanja.php">Podešavanja</a>
            <a href="Korpa.php">Korpa</a>
            <a href="Pretraga.html">Ponuda</a>
            <a href="uplata.php">Uplata</a>
            <a href="nova_reklamacija.php">Dodaj reklamaciju</a>
        </div>
        <script>
            function openNav() {
                document.getElementById("mySidenav").style.width = "250px";
            }

            function closeNav() {
                document.getElementById("mySidenav").style.width = "0";
            }
        </script>

        <div class="jumbotron text-center">
        <ul id="menu">
            <li><span id="menu-profile" style="font-size:20px;cursor:pointer" onclick="openNav()">&#9776; meni</span></li>
            <li><span id="userid"> Dobrodošao korisniče <a href="details.php" ><?php echo $userData['name']; ?></a></span></li>
            <li><a id="dugme-odjava" href="php/logout.php" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-log-out"></span>Odjavi me</a></li>
        </ul>
        </div>
        
        <img width="300px" height="300px" id="profle-pic" src="pictures/profilepics/<?php echo $pic ?>" onerror="this.src='pictures/profile-pic.png'" alt="profile-pic">
    </body>
</html>
