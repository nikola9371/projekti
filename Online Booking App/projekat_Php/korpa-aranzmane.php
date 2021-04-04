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
        <title>Korpa update</title>
    </head>
    <body>
        <?php
        // put your code here
        require_once "php/profil.php";
        
        $profil=new profil();
        
        if($profil->prenesi_u_korpu($_GET["id"], $_SESSION["userID"])){
            echo "<p style='font:20px bold Arial; '>Aranžman je uspešno dodat u korpu</p>";
            header("refresh:5;url=Pretraga.html");
        }
        else{
            echo "<p style='font:20px bold Arial; '>Došlo je do greške kod prebacivanja u korpu</p>";
        }
        ?>
        <a id="backarrow" href="Pretraga.html" style="padding: 10px 15px; background: #414141; color: #d9d9d9; text-decoration: none;"><img src="pictures/arrow-left.png" height="25" width="25" style="vertical-align: middle; margin-right: 2px;" >Povratak na prethodnu stranu</a>
    </body>
</html>
