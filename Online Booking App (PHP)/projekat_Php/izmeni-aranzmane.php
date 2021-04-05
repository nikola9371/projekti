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
        <title>Izmeni aranžmane</title>
        <script>
            function validacijaSubmit(){
                var x=document.forms["myForm"]["naziv"].value;
                var y=document.forms["myForm"]["email"].value;
                var z=document.forms["myForm"]["username"].value;
                var c=document.forms["myForm"]["stanje"].value;
                
                if(x==""||y==""||z==""||c==""){
                    document.getElementById("upozorenje").innerHTML="Polja ne smeju biti prazna!";
                    return false;
                }
                myForm.submit();
            }
        </script>
    </head>
    <body>
        <?php
        // put your code here
        require_once "php/profil-admin.php";
        
        $korisnik=new profil_admin();
        $podaci=$korisnik->uzmiPodatkeAranzman($_GET["id"]); 
       
        ?>
        <?php if(!isset($_GET["ponude"])) { ?>
        <form name="myForm" id="register" action="<?php $_SERVER["PHP_SELF"] ?>" method="get" >
                <fieldset>
                    <legend>Izmena podataka administratora:</legend>
                    <?php if(isset($statement1)){ ?>
                           <span><?php echo "<font size='3' color='black'>".$statement1."</font>"; ?></span><br>
                            <?php } ?>
                    <?php if(isset($statement2)){ ?>
                           <span><?php echo "<font size='3' color='red'>".$statement2."</font>"; ?></span><br>
                            <?php } ?>
                    <input type="hidden" name="id" value="<?php echo $_GET["id"] ?>">
                    <label for="ponude">Tip ponude: </label><br>
                    <input class="fpn" type="text" name="ponude" size="30" value="<?php echo $podaci[0]["ponude"] ?>"><br>
                    <br>
                    <label for="agencija">Agencija: </label><br>
                    <input class="fpn" type="text" name="agencija" size="30" value="<?php echo $podaci[0]["agencija"] ?>"><br>
                    <br>
            		<label for="grad">Grad: </label><br>
                        <input class="fpn" type="text" name="grad" size="30" value="<?php echo $podaci[0]["grad"] ?>"><br> 
                    <br>
            		<label for="smestaj">Tip smeštaja: </label><br>
                        <input class="fpn" type="text" name="smestaj" size="30" value="<?php echo $podaci[0]["tip_smestaja"] ?>"><br> 
                    <br>
            		<label for="prevoz">Prevoz: </label><br>
                        <input class="fpn" type="text" name="prevoz" size="30" value="<?php echo $podaci[0]["prevoz"] ?>"><br> 
                    <br>
            		<label for="date">Datum polaska: </label><br>
                        <input class="fpn" type="date" name="date" size="30" value="<?php echo $podaci[0]["datum_polaska"] ?>"><br> 
                    <br>
            		<label for="cena">Cena: </label><br>
                        <input class="fpn" type="text" name="cena" size="30" value="<?php echo $podaci[0]["cena"] ?>"><br> 
                    
                        <br>
                        <input type="image" src="pictures/insert.png" alt="dodaj" width="25" height="25" onclick="return validacijaSubmit()">
                        <span id="upozorenje"></span>
                </fieldset>
    	</form>
        <?php
        }
        else{
            $ponude=$_GET["ponude"];
            $agencija=$_GET["agencija"];
            $grad=$_GET["grad"];
            $tip=$_GET["smestaj"];
            $prevoz=$_GET["prevoz"];
            $datum_polaska=$_GET["date"];
            $cena=$_GET["cena"];
            
            if($korisnik->izmeni_aranzman($_GET["id"], $ponude, $agencija, $grad, $tip, $prevoz, $datum_polaska, $cena)){
                echo "<p style='font:20px bold Arial; '>Korisnički podatci su uspešno izmenjeni</p>";
            header("refresh:5;url=dodaj-brisi-aranzmani.php");
            }
            else{
                echo "<p style='font:20px bold Arial; color:red; '>Korisnički podatci nisu izmenjeni!</p>";
            header("refresh:5;url=dodaj-brisi-aranzmani.php");
            }
        }
        ?>
        <a id="backarrow" href="dodaj-brisi-aranzmani.php" style="padding: 10px 15px; background: #414141; color: #d9d9d9; text-decoration: none;"><img src="pictures/arrow-left.png" height="25" width="25" style="vertical-align: middle; margin-right: 2px;" >Povratak na prethodnu stranu</a>
        
    </body>
</html>
