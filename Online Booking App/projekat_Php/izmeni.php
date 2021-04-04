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
        <title>Update users</title>
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
        $podaci=$korisnik->uzmiPodatke($_GET["id"]); 
       
        ?>
        <?php if(!isset($_GET["naziv"])) { ?>
        <form name="myForm" id="register" action="<?php $_SERVER["PHP_SELF"] ?>" method="get" >
                <fieldset>
                    <legend>Izmena podataka korisnika:</legend>
                    <?php if(isset($statement1)){ ?>
                           <span><?php echo "<font size='3' color='black'>".$statement1."</font>"; ?></span><br>
                            <?php } ?>
                    <?php if(isset($statement2)){ ?>
                           <span><?php echo "<font size='3' color='red'>".$statement2."</font>"; ?></span><br>
                            <?php } ?>
                    <input type="hidden" name="id" value="<?php echo $_GET["id"] ?>">
                    <label for="naziv">Ime i prezime: </label><br>
                    <input class="fpn" type="text" name="naziv" size="30" value="<?php echo $podaci[0]["name"] ?>"><br>
                    <br>
                    <label for="email">Imejl-adresa: </label><br>
                    <input class="fpn" type="email" name="email" size="30" value="<?php echo $podaci[0]["email"] ?>"><br>
                    <br>
            		<label for="username">Korisničko ime: </label><br>
                        <input class="fpn" type="text" name="username" size="30" value="<?php echo $podaci[0]["username"] ?>"><br>
                    <br>
            		<label for="stanje">Stanje: </label><br>
                        <input class="fpn" type="text" name="stanje" value="<?php echo $podaci[0]["stanje"] ?>"><br>
                    
                        <br>
                        <input type="image" src="pictures/insert.png" alt="dodaj" width="25" height="25" onclick="return validacijaSubmit()">
                        <span id="upozorenje"></span>
                </fieldset>
    	</form>
        <?php
        }
        else{
            $name=$_GET["naziv"];
            $email=$_GET["email"];
            $username=$_GET["username"];
            $stanje=$_GET["stanje"];
            
            if($korisnik->izmeni_korisnik($_GET["id"], $name, $email, $username, $stanje)){
                echo "<p style='font:20px bold Arial; '>Korisnički podatci su uspešno izmenjeni</p>";
            header("refresh:5;url=lista-korisnika.php");
            }
            else{
                echo "<p style='font:20px bold Arial; color:red; '>Korisnički podatci nisu izmenjeni!</p>";
            header("refresh:5;url=lista-korisnika.php");
            }
        }
        ?>
        <a id="backarrow" href="lista-korisnika.php" style="padding: 10px 15px; background: #414141; color: #d9d9d9; text-decoration: none;"><img src="pictures/arrow-left.png" height="25" width="25" style="vertical-align: middle; margin-right: 2px;" >Povratak na prethodnu stranu</a>
        
    </body>
</html>
