<?php

if(isset($_POST['submit'])){

        $uslov="";
    
        foreach ($_POST["pretraga"] as $key => $value) {
            if(!empty($value)){
            if(!empty($uslov)){
                $uslov=$uslov." and ";
            }
            else {
                $uslov=$uslov." where ";
            }
            if($value!="svi"){
            if($key==="paket"){
                $uslov=$uslov."ponude="."'$value'";
            }
            if($key==="agencija"){
                $uslov=$uslov."agencija="."'$value'";
            }
            if($key==="grad"){
                $uslov=$uslov."grad="."'$value'";
            }
            if($key==="smestaj"){
                $uslov=$uslov."tip_smestaja="."'$value'";
            }
            if($key==="tipPrevoza"){
                $uslov=$uslov."prevoz="."'$value'";
            }
            if($key==="date"){
                $uslov=$uslov."datum_polaska>="."'$value'";
            }
            }   
        }
         
    }
    $sql="select * from aranzman".$uslov;
    
    
    $host="localhost"; $user="root"; $pass=""; $baza="projekat";
            $mysqli=new mysqli($host,$user,$pass,$baza);
            
            if(mysqli_connect_errno()){
                die("Neuspešno prijavljivanje na bazu!". mysqli_error());
            }
            $rezultat=$mysqli->query($sql);
            
            if($rezultat->num_rows>0){
                echo "<table width=100% style='border-collapse:collapse; background-color:#e5e5e5;' >";
                echo "<tr><th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>Tip ponude</th>"
                . "<th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>Agencija</th>"
                        . "<th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>Grad</th>"
                        . "<th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>Tip smeštaja</th>"
                        . "<th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>Prevoz</th>"
                        . "<th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>Datum_polaska</th>"
                        ."<th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>Cena</th>";
                echo "<th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>&nbsp;</th>";
                echo "</tr>";
                
                while($red=$rezultat->fetch_array()){
                    echo "<tr>";
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>".$red[1]."</td>";
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>".$red[2]."</td>";
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>".$red[3]."</td>";
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>".$red[4]."</td>";
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>".$red[5]."</td>";
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>".$red[6]."</td>";
                    if($_POST["comment"]==="preko_prijatelja"){
                         $rez=$red[8]-$red[8]*0.05;
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>".$rez."</td>";
                    }
                    else if($_POST["comment"]==="preko_sajta"){
                        $rez=$red[8]-$red[8]*0.07;
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>".$rez."</td>";
                    }
                    else if($_POST["comment"]==="promocija"){
                        $rez=$red[8]-$red[8]*0.1;
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>".$rez."</td>";
                    }
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'><a href='korpa-aranzmane.php?id=".$red['id']."'><img src='pictures/insert.png' width='25'height='25' alt='izmeni'></a></td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
            echo '<br>';
            echo '<a id="backarrow" href="Pretraga.html" style="padding: 10px 15px; background: #414141; color: #d9d9d9; text-decoration: none;"><img src="pictures/arrow-left.png" height="25" width="25" style="vertical-align: middle; margin-right: 2px;" >Povratak na prethodnu stranu</a>';
    }
    if(isset($_POST['submit-button'])){
        
        
        $host="localhost"; $user="root"; $pass=""; $baza="projekat";
            $mysqli=new mysqli($host,$user,$pass,$baza);
            
        $pretraga=mysqli_real_escape_string($mysqli,$_POST['naziv']);
            if(mysqli_connect_errno()){
                die("Nije moguca konekcija!");
            }
            $upit="select * from aranzman where grad='$pretraga'";
            
            $rezultat=$mysqli->query($upit);
            
            if($rezultat->num_rows>0){
                echo "<table width=100% style='border-collapse:collapse; background-color:#e5e5e5;' >";
                echo "<tr><th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>Tip ponude</th>"
                        . "<th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>Agencija</th>"
                        . "<th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>Grad</th>"
                        . "<th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>Tip smeštaja</th>"
                        . "<th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>Prevoz</th>"
                        . "<th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>Datum_polaska</th>"
                        ."<th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>Cena</th>";
                echo "<th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>&nbsp;</th>";
                echo "</tr>";
                
                while($red=$rezultat->fetch_array()){
                    echo "<tr>";
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>".$red[1]."</td>";
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>".$red[2]."</td>";
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>".$red[3]."</td>";
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>".$red[4]."</td>";
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>".$red[5]."</td>";
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>".$red[6]."</td>";
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>".$red[8]."</td>";
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'><a href='korpa-aranzmane.php?id=".$red['id']."'><img src='pictures/insert.png' width='25'height='25' alt='izmeni'></a></td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
            echo '<br>';
            echo '<a id="backarrow" href="Pretraga.html" style="padding: 10px 15px; background: #414141; color: #d9d9d9; text-decoration: none;"><img src="pictures/arrow-left.png" height="25" width="25" style="vertical-align: middle; margin-right: 2px;" >Povratak na prethodnu stranu</a>';
    }
    if(isset($_GET["naziv"])){
    $host="localhost"; $user="root"; $pass=""; $baza="projekat";
            $mysqli=new mysqli($host,$user,$pass,$baza);
            
        $pretraga=mysqli_real_escape_string($mysqli,$_GET['naziv']);
            if(mysqli_connect_errno()){
                die("Nije moguca konekcija!");
            }
            $upit="select * from aranzman where grad='$pretraga'";
            
            $rezultat=$mysqli->query($upit);
    if($rezultat->num_rows>0){
         echo "<table width=100% style='border-collapse:collapse; background-color:#e5e5e5;' >";
                echo "<tr><th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>Tip ponude</th>"
                        . "<th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>Agencija</th>"
                        . "<th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>Grad</th>"
                        . "<th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>Tip smeštaja</th>"
                        . "<th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>Prevoz</th>"
                        . "<th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>Datum_polaska</th>"
                        ."<th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>Cena</th>";
                echo "<th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>&nbsp;</th>";
                echo "</tr>";
                
                while($red=$rezultat->fetch_array()){
                    echo "<tr>";
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>".$red[1]."</td>";
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>".$red[2]."</td>";
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>".$red[3]."</td>";
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>".$red[4]."</td>";
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>".$red[5]."</td>";
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>".$red[6]."</td>";
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>".$red[8]."</td>";
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'><a href='korpa-aranzmane.php?id=".$red['id']."'><img src='pictures/insert.png' width='25'height='25' alt='izmeni'></a></td>";
                    echo "</tr>";
                }
                echo "</table>";
        }
        echo '<br>';
            echo '<a id="backarrow" href="strana0.php" style="padding: 10px 15px; background: #414141; color: #d9d9d9; text-decoration: none;"><img src="pictures/arrow-left.png" height="25" width="25" style="vertical-align: middle; margin-right: 2px;" >Povratak na prethodnu stranu</a>';
    }
            
   
        
 ?>

