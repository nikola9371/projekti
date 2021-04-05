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
        <link rel="stylesheet" type="text/css" href="pretraga.css">
        <title>Kontrola aranzmana</title>
        <script>
            function validacijaTrazi(event){
                pretraga=document.getElementById("pretraga").value;
                if(pretraga==""){
                    document.getElementById("upozorenje").innerHTML="Ništa nije uneto!";
                    event.preventDefault();
                    return false;
                }
                trazi.submit();
            }
            function brisi(id){
                var odgovor=confirm("Brisanje aranžmana:Da li ste sigurni?");
                if(odgovor){
                    window.location="brisi-aranzmane.php?id="+id;
                }
                else{
                    return false;
                }
            }
        </script>
    </head>
    <body>
        <fieldset class="fset">
            <form action="<?php $_SERVER["PHP_SELF"] ?>" method="post" id="trazi">
			<table>
				<tr>
					<td>
						<label>Pretraga:</label> 
                                                <input id="pretraga" type="text" placeholder="pretraga..." name="pretraga" value="">
                                                <input style="vertical-align: middle;"  type="image" src="pictures/search.jpg" alt="pretraga" width="25" height="25" onclick="validacijaTrazi(event)">
                                                <span id="upozorenje" style="font-size:3; color: red; "></span>
					</td>
				</tr>
			</table>
		</form>
	</fieldset>
        <?php
        // put your code here
        require_once "php/profil-admin.php";
        include "php/connect.php";
        
        $GLOBALS['link']= connection();
        
        $korisnici=new profil_admin();
        
            if(!isset($_POST["pretraga"])){
                    $korisnici->stampajAranzmane();
                
            }
            else{
                $kriterijumNaziv= mysqli_real_escape_string($GLOBALS['link'],$_POST["pretraga"]);
                $korisnici->stampajAranzmane($kriterijumNaziv);
                
            }
        ?>
        <form action="dodaj.php" method="post"><br>
                <input type="image" src="pictures/insert.png" alt="dodaj" width="25" height="25">
            </form>
        <br>
        <a id="backarrow" href="profile-admin.php" style="padding: 10px 15px; background: #414141; color: #d9d9d9; text-decoration: none;"><img src="pictures/arrow-left.png" height="25" width="25" style="vertical-align: middle; margin-right: 2px;" >Povratak na prethodnu stranu</a>
            
    </body>
</html>
