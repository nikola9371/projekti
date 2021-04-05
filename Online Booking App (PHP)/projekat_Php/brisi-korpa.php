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
        <title>Briši korpa</title>
    </head>
    <body>
        <?php
        // put your code here
        require_once "php/profil.php";
        
      
        $korpa=new profil();
        
        if($korpa->brisi($_GET["id"])){
            echo "<p style='font:20px bold Arial; '>Stavka korpe je uspešno izbrisana</p>";
            header("refresh:5;url=Korpa.php");
        }
        else{
            echo "<p style='font:20px bold Arial; color:red;'>Došlo je do greške kod brisanja</p>";
        }
        ?>
         <a id="backarrow" href="Korpa.php" style="padding: 10px 15px; background: #414141; color: #d9d9d9; text-decoration: none;"><img src="pictures/arrow-left.png" height="25" width="25" style="vertical-align: middle; margin-right: 2px;" >Povratak na prethodnu stranu</a>
         
    </body>
</html>
