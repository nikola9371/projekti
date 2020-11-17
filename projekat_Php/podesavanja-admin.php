<?php
 require('php/login_config.php');
 
 if(!isset($_SESSION['userIDadmin'])){
    header("Location:login-administrator.php");
    exit();
 }
 else{
    $userData=getUserData($_SESSION['userIDadmin']);
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
        <title>Podešavanja admin</title>
    </head>
    <body>
        <?php
        // put your code here
        include "php/profil-admin-slike.php";
        
            $profil=new profil_admin_slike();
            
            if(isset($_FILES["fupload"])){
                $source=$_FILES["fupload"]["tmp_name"];
                $target="pictures/profilepics/".$_FILES["fupload"]["name"];
                if(move_uploaded_file($source, $target)){
                    if($profil->dodaj_sliku($_SESSION["userIDadmin"], $_FILES["fupload"]["name"])){
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
                    <li class="home"><a href='profile-admin.php'><img style="vertical-align: middle;" src="pictures/menu/arrow-left.png" height="20px" width="20px"></a></li>
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
    </body>
</html>
