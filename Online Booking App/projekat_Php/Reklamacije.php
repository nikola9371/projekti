
<!DOCTYPE html>
<html>
<head>
	<title>Reklamacije</title>
	<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="strana0.css">
	<link rel="stylesheet" type="text/css" href="reklamacije.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript">
		function hide_show(){
			var x=document.getElementById("new-reclamation");
			if(x.style.display==="none"){
				x.style.display="block";
			}
			else{
				x.style.display="none";
			}
		}
                function regex(){
                        var pattern=new RegExp("^[0-9]$");
			var pretraga=document.forma.search.value;
			var rezultat=pattern.test(pretraga);
                        
                        if(rezultat){
                        search.submit();
                        }
                        else{
                            alert("Dozvoljeni su samo brojevi!");
                            return false;
                        }
                       }
                        
                
	</script>
        <script> 
        $(document).ready(function(){
            $("#flip").click(function(){
                $("#panel").slideToggle("slow");
            });
        });
        </script>
</head>
<body>
    <fieldset id="field1">
            <form name="forma" id="search" action="<?php $_SERVER["PHP_SELF"] ?>" method="post">
			<label for="search">Pretraga reklamacija:</label>
                        <input id="pretraga" type="text" name="search" placeholder=" broj reklamacije..." >
                        <button style="vertical-align: middle;" name="search-button" onClick="regex()"><img src="pictures/menu/menu_search.png" width="20" height="20"></button>
                        <a href="nova_reklamacija.php" style="float:right; ">nova reklamacija</a>
		</form>
	</fieldset>
        <?php
            include "php/reklamacije.php";
   
            $klijent=new Reklamacije();
                if(isset($_POST["search-button"])){
            $nizK=$klijent->vrati_postojece_reklamacije(mysqli_real_escape_string($GLOBALS['link'],$_POST["search"]));
            $brojRezultat=count($nizK);

            print "<table width=100% style='border-collapse:collapse; background-color:#e5e5e5;' >";
                print "<tr><th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>Narudžbenica</th>"
                . "<th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>ImePrezime</th>"
                        . "<th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>DatumRodjenja</th>"
                        . "<th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>pol</th></tr>";
            
            for($i=0;$i<$brojRezultat;$i++){
               $klijent->ImePrezime=$nizK[$i][2];
               
                    echo "<tr>";
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>".$nizK[$i][1]."</td>";
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>".$nizK[$i][2]."</td>";
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>".$nizK[$i][3]."</td>";
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>".$nizK[$i][4]."</td></tr>";
        }   
        print "</table>";
                }
                 echo '<br>';
            echo '<a id="backarrow" href="strana0.php" style="padding: 10px 15px; background: #414141; color: #d9d9d9; text-decoration: none;"><img src="pictures/arrow-left.png" height="25" width="25" style="vertical-align: middle; margin-right: 2px;" >Povratak na prethodnu stranu</a>';
   
        ?>
        
        
</body>
</html>