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
        <link rel="stylesheet" type="text/css" href="register.css">
        <title>Dodavanje aranzmana</title>
    </head>
    <script>
            function validacijaSubmit(){
                var x=document.forms["myForm"]["tip"].value;
                var y=document.forms["myForm"]["agencija"].value;
                var z=document.forms["myForm"]["grad"].value;
                var c=document.forms["myForm"]["smestaj"].value;
                var t=document.forms["myForm"]["prevoz"].value;
                var u=document.forms["myForm"]["datum"].value;
                var i=document.forms["myForm"]["cena"].value;
                
                if(x==""||y==""||z==""||c==""||t==""||u==""||i==""){
                    document.getElementById("upozorenje").innerHTML="Polja ne smeju biti prazna!";
                    return false;
                }
                myForm.submit();
            }
        </script>
    <body>
           <?php
            // put your code here
            require_once "php/profil-admin.php";

            if(isset($_POST["tip"])){
        
            $ponude=$_POST["tip"];
            $agencija=$_POST["agencija"];
            $grad=$_POST["grad"];
            $tip=$_POST["smestaj"];
            $prevoz=$_POST["prevoz"];
            $datum_polaska=$_POST["datum"];
            $cena=$_POST["cena"];
            
            $korisnik=new profil_admin();
            
            if($korisnik->dodaj_aranzman($ponude, $agencija, $grad, $tip, $prevoz, $datum_polaska, $cena)){
                
                $statement1="Uspešno dodat novi aranžman";
            
            }
            else{
                
                $statement2="Nije dodat novi aranžman!";
            }
         }
        ?>
        <form name="myForm" id="register" action="<?php $_SERVER["PHP_SELF"] ?>" method="post" >
                <fieldset>
                    <legend>Dodavanje novog aranžmana:</legend>
                    <?php if(isset($statement1)){ ?>
                           <span><?php echo "<font size='3' color='black'>".$statement1."</font>"; ?></span><br>
                            <?php } ?>
                    <?php if(isset($statement2)){ ?>
                           <span><?php echo "<font size='3' color='red'>".$statement2."</font>"; ?></span><br>
                            <?php } ?>
                    
                    <label for="naziv">Tip ponude: </label><br>
                    <input class="fpn" type="text" name="tip" size="30" ><br>
                    <br>
                    <label for="email">Agencija: </label><br>
                    <input class="fpn" type="text" name="agencija" size="30" ><br>
                    <br>
            		<label for="username">Grad </label><br>
                        <input class="fpn" type="text" name="grad" size="30" ><br>
                        <br>
            		<label for="username">Tip smeštaja: </label><br>
                        <input class="fpn" type="text" name="smestaj" size="30" ><br>
                    <br>
            		<label for="username">Prevoz: </label><br>
                        <input class="fpn" type="text" name="prevoz" size="30" ><br>
                        <br>
                        <br>
            		<label for="username">Datum polaska: </label><br>
                        <input class="fpn" type="date" name="datum" size="30" ><br>
                        <br>
            		<label for="username">Cena: </label><br>
                        <input class="fpn" type="text" name="cena" size="30" ><br>
                        <br>
                        <input type="image" src="pictures/insert.png" alt="dodaj" width="25" height="25" onclick="return validacijaSubmit()">
                        <span id="upozorenje"></span>
                </fieldset>
    	</form>
        
        <a id="backarrow" href="dodaj-brisi-aranzmani.php" style="padding: 10px 15px; background: #414141; color: #d9d9d9; text-decoration: none;"><img src="pictures/arrow-left.png" height="25" width="25" style="vertical-align: middle; margin-right: 2px;" >Povratak na prethodnu stranu</a>
        
    </body>
</html>
