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
        <title>Uplata</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="strana0.css">
        <link rel="stylesheet" type="text/css" href="pretraga.css">
        <link rel="stylesheet" type="text/css" href="navbar.css">
        <script>
            function regex(){
			var patern= /^[0-9]+$/;
			var iznos= document.forma.iznos.value;
			var rezultat= patern.test(iznos);

			if(!rezultat){
				document.getElementById("upozorenje").innerHTML="Nisu unete cifre('Dozvoljene su samo cifre')!";
                      
			}
		}
        </script>
    </head>
    <body>
        <?php
        include "php/profil.php";
        
            $profil=new profil();
            
            if(isset($_POST["submit-uplata"])){
                if($_POST["iznos"]!=0 && ctype_digit($_POST["iznos"])){   
                if($profil->uplati(mysqli_real_escape_string($GLOBALS['link'],$_POST["iznos"]), $userData["id_user"])){
                    $statement="Uspešno uplaćeno ".$_POST["iznos"]."din.";
                    }
                }
                else{
                    $statement1="Uneti iznos je neodgovarajući!";
                }
                
                
            }
        ?>
        <nav>
		<ul id="menu">
			<li class="home"><a href='profile.php'><img style="vertical-align: middle;" src="pictures/menu/arrow-left.png" height="20px" width="20px"></a></li>
		</ul>
	</nav>
        <fieldset class="fset">
            <form action="<?php $_SERVER["PHP_SELF"] ?>" method="post" name="forma">
			<table>
				<tr>
					<td>
						<label>Uplata:</label> 
						<input type="search" placeholder="iznos za uplatu..." name="iznos">
                                                <input type="submit" name="submit-uplata" value="uplati" >
                                                <input type="submit" name="submit-stanje" value="trenutno stanje">
                                                <span style="color: red; font: 12px Arial;" id="upozorenje"></span>
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
        // put your code here
        
        
            $profil=new profil();
            
            if(isset($_POST["submit-stanje"])){
                $nizP=$profil->prikazi_trenutno_stanje($userData["id_user"]);
                $brojRez=count($nizP);
                echo "<p style='font:20px bold Arial;'> Trenutno stanje na računu korisnika ".$userData["name"]." je ";
                for($i=0;$i<$brojRez;$i++){
                    echo $nizP[$i][0];
                }
                echo "din.</p>";
            }
            
            
        
        ?>
    </body>
</html>