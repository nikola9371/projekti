<?php
 require('php/login_config.php');
 
 if(!isset($_SESSION['userIDadmin'])){
    header("Location:login-administrator.php");
    exit();
 }
 else{
    $userData=getUserDataAdmin($_SESSION['userIDadmin']);
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
        <title>Delete user</title>
    </head>
    <body>
        <?php
        // put your code here
        require_once "php/profil-admin.php";
        
        $id=$_GET["id"];
        $table="login";
        $korisnik=new profil_admin();
        
        if($korisnik->brisi_korisnik($id)){
            
            echo "<p style='font:20px bold Arial; '>Korisnik je uspešno izbrisan</p>";
            header("refresh:5;url=lista-korisnika.php");
        }
        else{
            echo "<p style='font:20px bold Arial; '>Došlo je do greške kod brisanja</p>";
        }
        ?>
        <a id="backarrow" href="lista-korisnika.php" style="padding: 10px 15px; background: #414141; color: #d9d9d9; text-decoration: none;"><img src="pictures/arrow-left.png" height="25" width="25" style="vertical-align: middle; margin-right: 2px;" >Povratak na prethodnu stranu</a>
    </body>
</html>
