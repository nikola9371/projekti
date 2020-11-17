
<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="register.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="utf-8">
        
        <script>
            function validateForm(){
                var x=document.forms["myForm"]["name"].value;
                var y=document.forms["myForm"]["email"].value;
                var z=document.forms["myForm"]["username"].value;
                var c=document.forms["myForm"]["password"].value;
                var d=document.forms["myForm"]["password-repeat"].value;
                
                
                 if (x==="" || y==="" || z===""||c===""||d==="") {
                    document.getElementById("upozorenje").innerHTML="Sva polja moraju biti popunjena!";
                    return false;
                }
              
                   myForm.submit();
                
            }
            
            
        </script>
</head>
<body>
    <?php
        include "php/register.php";
      
        
        $registracija=new Registracije();
        
        if(isset($_POST["submit"])){
            $imePrez= mysqli_real_escape_string($GLOBALS['link'], $_POST["imePrez"]);
            $email= mysqli_real_escape_string($GLOBALS['link'],$_POST["email"]);
            $kIme= mysqli_real_escape_string($GLOBALS['link'],$_POST["username"]);
            $pass= sha1($_POST["password"]);
            $regDate=date("Y-m-d h:i:s");
            
            $passR= sha1($_POST["password-repeat"]);
            if($pass===$passR){
            $registracija->azuriraj_registracije($imePrez, $email, $kIme, $pass, $regDate);
            $statement1="Uspešno uneta nova registracija";
            
            }
            else{
                $statement2="Nisu unete iste vrednosti u poljima sa šifrom!";
            }
        }
    
    ?>
        <form name="myForm" id="register" action="<?php $_SERVER["PHP_SELF"] ?>" onsubmit="return validateForm()" method="post">
                <fieldset>
                    <legend>Registracija:</legend>
                    <?php if(isset($statement1)){ ?>
                           <span><?php echo "<font size='3' color='black'>".$statement1."</font>"; ?></span><br>
                            <?php } ?>
                    <?php if(isset($statement2)){ ?>
                           <span><?php echo "<font size='3' color='red'>".$statement2."</font>"; ?></span><br>
                            <?php } ?>
                    <label for="name">Ime i prezime: <span>*obavezno</span></label><br>
            		<input class="fpn" type="text" name="imePrez" placeholder="ime i prezime..."><br>
                    <br>
                    <label for="email">Imejl-adresa: <span>*obavezno</span></label><br>
                    <input class="fpn" type="email" name="email" placeholder="Imejl-adresa..."><br>
                    <br>
            		<label for="username">Korisničko ime: <span>*obavezno</span></label><br>
            		<input class="fpn" type="text" name="username" placeholder="korisničko ime..."><br>
                    <br>
            		<label for="password">Šifra: <span>*obavezno</span></label><br>
            		<input class="fpn" type="password" name="password" placeholder="šifra..."><br>
                    <br>
                    <input class="fpn" type="password" name="password-repeat" placeholder="potvrdi šifru">
                    <br>
                    <br>
                        <input class="btn" type="submit" name="submit" value="potvrda">
                        <input class="btn" type="reset" name="reset" value="počisti">
                        <a href="strana0.php"><img style='vertical-align:middle;' src="pictures/back.png" height="15px" width="15px" title="nazad" ></a>
                        <span id="upozorenje"></span>
                </fieldset>
    	</form>
    
</body>
</html>