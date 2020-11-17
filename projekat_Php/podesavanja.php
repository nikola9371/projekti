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
        <link rel="stylesheet" type="text/css" href="pretraga.css">
        <link rel="stylesheet" type="text/css" href="navbar.css">
        
        <title>Podešavanja</title>
        <script>
            function check(){
            var x=document.getElementById("uname").value;
            var y=document.getElementById("pass").value;
            var z=document.getElementById("passR").value;
            
            if(x==""||y==""||z==""){
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
        include "php/profil.php";
        
            $profil=new profil();
            
            if(isset($_FILES["fupload"])){
                $source=$_FILES["fupload"]["tmp_name"];
                $target="pictures/profilepics/".$_FILES["fupload"]["name"];
                if(move_uploaded_file($source, $target)){
                    if($profil->dodaj_sliku($_SESSION["userID"], $_FILES["fupload"]["name"])){
                        $statement="Uspešno ubačena slika";
                    }
                    else{
                        $statement2="Slika nije ubačena!";
                    }
                }
            }
        
        ?>
        <nav>
		<ul id="menu">
                    <li class="home"><a href='profile.php'><img style="vertical-align: middle;" src="pictures/menu/arrow-left.png" height="20px" width="20px"></a></li>
		</ul>
	</nav>
        <fieldset class="fset">
            <form action="<?php $_SERVER["PHP_SELF"] ?>" method="post" enctype="multipart/form-data">
			<table>
				<tr>
					<td>
						<label>Ubacivanje slike:</label> 
                                                <input type="file" name="fupload">
						<input type="submit" value="Ubaci sliku">
                                                <?php if(isset($statement)){ ?>
                                                    <span><?php echo "<font size='3' color='black'>".$statement."</font>"; ?></span><br>
                                                <?php } ?>
                                                    <?php if(isset($statement1)){ ?>
                                                    <span><?php echo "<font size='3' color='red'>".$statement1."</font>"; ?></span><br>
                                                <?php } ?>
					</td>
				</tr>
			</table>
		</form>
	</fieldset>
        <?php
        if(isset($_POST["submit2"])){
            if($_POST["password"]!=$_POST["password-repeat"]){
                $statement1="Nisu unete iste vrednosti u polja lozinke!";
            }
            else{
                if($profil->izmeni_podatke($_POST["username"], $_POST["password"], $_SESSION["userID"])){
                    $statement="Uspešno izmenjeni podatci";
                }
            }
        }
        ?>
        <fieldset class="fset" style="margin-top: 10px;">
            <legend>Izmene podataka korisnika</legend>
            <form name="myForm" action="<?php $_SERVER["PHP_SELF"] ?>" method="post">
			<table>
				<tr>
					<td>
                                            <label style="vertical-align: middle;">Korisničko ime:</label>
                                            
					</td>
                                        <td>
                                            <input type="text" id="uname" name="username" placeholder="Korisničko ime..." style="float: right;">
                                        </td>
				</tr>
                                <tr>
                                    <td>
                                        <label style="vertical-align: middle;">Lozinka:</label>
                                        
                                    </td>
                                    <td>
                                        <input type="password" id="pass" name="password" placeholder="Nova lozinka.." style="float: right;">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label style="vertical-align: middle;">Potvrda lozinke:</label>
                                        
                                    </td>
                                    <td>
                                        <input type="password" id="passR" name="password-repeat" placeholder="Potvrda nove lozinke.." style="float: right;">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="submit" name="submit2" value="Potvrdi" onclick="return check()">
                                        
                                    </td>
                                    <td>
                                        <span id="upozorenje" style="font: 13px Arial; color: red;"></span>
                                        <?php if(isset($statement)){ ?>
                                            <span><?php echo "<font size='3' color='black'>".$statement."</font>"; ?></span><br>
                                        <?php } ?>
                                        <?php if(isset($statement1)){ ?>
                                            <span><?php echo "<font size='3' color='red'>".$statement1."</font>"; ?></span><br>
                                        <?php } ?>
                                    </td>
                                </tr>
			</table>
		</form>
	</fieldset>
    </body>
</html>
