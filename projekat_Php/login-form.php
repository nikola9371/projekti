<?php 
    require('php/login_config.php');


    if(isset($_POST['submit'])){
        $userName= mysqli_real_escape_string($con,$_POST['username']);
        $passWord=sha1($_POST['password']);
        
        if(!$userName==null || !$userName=""||!$passWord==null ||!$passWord=""){
        $upit="select id_user from login where username='$userName' and password='$passWord' limit 1";
        
        $rez= mysqli_query($con, $upit);
        if(mysqli_num_rows($rez)==1){
            //uspesno konektovanje
            $data=mysqli_fetch_array($rez,1);
            $_SESSION['userID']=$data['id_user'];
            header("Location:profile.php");
        }
            else {
                $error2="Pogresna lozinka ili korisničko ime!";
            }
        }
        else {
             //neuspesno konektovanje
            $error="Polja ne smeju biti prazna!";
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="login.css">
	<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        
</head>
<body>
<div class="login">
    <form action="<?php $_SERVER["PHP_SELF"] ?>" method="post">
        <span><p>Učitavanje korisnika:</p></span>
        <?php if(isset($error)){ ?>
            <span><?php echo "<font color='red'>".$error."</font>"; ?></span><br>
        <?php } ?>
        <?php if(isset($error2)){ ?>
            <span><?php echo "<font color='red'>".$error2."</font>"; ?></span><br>
        <?php } ?>
                <label>Korisničko ime:</label><br>
		<input type="text" name="username" placeholder="korisničko ime.." ><br>
                <label>Lozinka:</label><br>
                <input  type="password" name="password" placeholder="lozinka.." ><br>
                <a href="strana0.php"><img style='vertical-align:middle;' src="pictures/back2.png" height="15px" width="15px" title="nazad" ></a>
                <input style="margin-right: 15px;" type="submit" name="submit" value="Potvrdi"><br>
                <a href="Register.php" id="register">register</a><br>	
		
	</form>
</div>


</body>
</html>