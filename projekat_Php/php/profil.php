<?php

include ('connect.php');
$GLOBALS['link']= connection();

class profil {
    //put your code here
    public $iznos;
    public $id;
    public $id_aranz;
    public $picName;
    public $suma;
    public $username;
    public $password;
    
    public function uplati($iznos,$id){
        
        $GLOBALS['lnk']=$GLOBALS['link'];
        $this->iznos=$iznos;
        $this->id=$id;
        
        $sqlUpit="update login set stanje=ifnull(stanje,0)+'".$this->iznos."' where id_user='".$this->id."'";   
        
        if(!(mysqli_query($GLOBALS['lnk'], $sqlUpit))){
            die("Ne može se izvršiti upit ".mysqli_error($GLOBALS['lnk']));
            return false;
        }
        mysqli_close($GLOBALS['lnk']);
        return true;
    }
    public function prikazi_trenutno_stanje($id){
        $GLOBALS['lnk']=$GLOBALS['link'];
        $this->id=$id;
        
        $sqlUpit2="select ifnull(stanje,0) as stanje from login where id_user='".$this->id."'";
        
        if(!($rezulat= mysqli_query($GLOBALS['lnk'], $sqlUpit2))){
            die("Ne može se izvršiti upit ".mysqli_error($GLOBALS['lnk']));
        }
        $brRedova= mysqli_num_rows($rezulat);
        
        for($i=0;$i<=$brRedova;$i++){
            $niz[$i]= mysqli_fetch_array($rezulat);
        }
        mysqli_close($GLOBALS['lnk']);
        return $niz;
    }
    public function dodaj_sliku($id_user,$picName){
        $GLOBALS['lnk']=$GLOBALS['link'];
        $this->id=$id_user;
        $this->picName=$picName;
        
        $sqlUpit1="select * from profile_pics where id_user='".$this->id."'";
        $sqlUpit2="insert into profile_pics(name,id_user) values('$this->picName','$this->id')";
        $sqlUpit3="update profile_pics set name='".$this->picName."' where id_user='".$this->id."'";
        
        $rez= mysqli_query($GLOBALS['lnk'], $sqlUpit1);
        
        if(mysqli_num_rows($rez)==1){
            $niz= mysqli_fetch_all(mysqli_query($GLOBALS['link'], $sqlUpit1));
            unlink("pictures/profilepics/".$niz[0][1]);
            if(!($rezultat= mysqli_query($GLOBALS['link'], $sqlUpit3))){
            die("Ne može se izvršiti upit ".mysqli_error($GLOBALS['lnk']));
            return false;
        }
         mysqli_close($GLOBALS['lnk']);
        return true;
        }
        else{
        if(!($rezultat= mysqli_query($GLOBALS['link'], $sqlUpit2))){
            die("Ne može se izvršiti upit ".mysqli_error($GLOBALS['lnk']));
            return false;
        }
         mysqli_close($GLOBALS['lnk']);
        return true;
        }
       
    }
    public function prikazi_ime_slike($id){
        $GLOBALS['lnk']=$GLOBALS['link'];
        $this->id=$id;
        
        $sqlUpit="select * from profile_pics where id_user='".$this->id."'";
        
        if(!($rezulat= mysqli_query($GLOBALS['lnk'], $sqlUpit))){
            die("Ne može se izvršiti upit ".mysqli_error($GLOBALS['lnk']));
        }
        $brRedova= mysqli_num_rows($rezulat);
        
        for($i=0;$i<=$brRedova;$i++){
            $niz[$i]= mysqli_fetch_array($rezulat);
        }
        mysqli_close($GLOBALS['lnk']);
        return $niz;
    }
    public function prenesi_u_korpu($id_aranz,$id_user){
        $GLOBALS['lnk']=$GLOBALS['link'];
        
        $this->id=$id_user;
        $this->id_aranz=$id_aranz;
        $date= date("Y-m-d");
        
        $sqlUpit="insert into narudzbenica(datumKupovine,idKupac,idAranzman) values('$date','$this->id','$this->id_aranz')";
        
        if(!(mysqli_query($GLOBALS['lnk'], $sqlUpit))){
            die("Ne može se izvršiti upit ".mysqli_error($GLOBALS['lnk']));
            return false;
        }
        mysqli_close($GLOBALS['lnk']);
        return true;
    }
    public function prikazi_korpu($id){
        $GLOBALS['lnk']=$GLOBALS['link'];
        $this->id=$id;
        
        $sqlUpit="select idNarudzbenica,datumKupovine,grad,datum_polaska,cena" 
            ." from narudzbenica as n join aranzman as a on n.`idAranzman`=a.id"
               ." where n.`idKupac`='".$this->id."'";
        if(!($rezulat= mysqli_query($GLOBALS['link'], $sqlUpit))){
            die("Ne može se izvršiti upit ".mysqli_error($GLOBALS['link']));
        }

        $niz= mysqli_fetch_all($rezulat);
        $ukupno=0;
        
            echo "<table width=100% style='border-collapse:collapse; background-color:#e5e5e5;'>";
            echo "<tr><th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>Šifra</th>";
            echo "<th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>Datum unosa</th>";
            echo "<th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>Grad</th>";
            echo "<th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>Datum polaska</th>";
            echo "<th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>Cena</th>";
            echo "<th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>&nbsp;</th></tr>";
            
            foreach($niz as $korpa){
                echo "<tr><td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>".$korpa[0]."</td>";
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>".$korpa[1]."</td>";
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>".$korpa[2]."</td>";
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>".$korpa[3]."</td>";
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>".$korpa[4]."din.</td>";  
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'><a href='brisi-korpa.php?id=".$korpa[0]."' onclick='return brisi(this.id)'><img src='pictures/trashcan.png'"
                            ."width='25' height='25' alt='obrisi' title='briši'></a></td></tr>";
                    $ukupno+=$korpa[4];
               
            }
            echo "<tr><th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;' colspan='4'>&nbsp;</th>";
            
            echo "<th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>Ukupno:".$ukupno."din.</th>";
            echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'><a href='kupi-korpa.php?suma=".$ukupno."' onclick='return kupi(this.suma)'><img src='pictures/buy.png'"
                            ."width='25' height='25' alt='obrisi' title='kupi'></a></td></tr>";
            echo "</table>";
            
    }
    public function brisi($id){
        $GLOBALS['lnk']=$GLOBALS['link'];
        $this->id=$id;
        
        $sql="delete from narudzbenica where idnarudzbenica=$id";
         
        if(!(mysqli_query($GLOBALS['lnk'], $sql))){
            die("Ne može se izvršiti upit ".mysqli_error($GLOBALS['lnk']));
            return false;
        }
        mysqli_close($GLOBALS['lnk']);
        return true;
    }
    public function kupi($suma,$id){
        $GLOBALS['lnk']=$GLOBALS['link'];
        $this->suma=$suma;
        $this->id=$id;
        
        $sqlUpit="select ifnull(stanje,0) as stanje from login where id_user='".$this->id."'";
        $sqlUpit2="update login set stanje=stanje-'".$this->suma."' where id_user='".$this->id."'";
        $sqlUpit3="delete from narudzbenica where idKupac='".$this->id."'";
        
        
        if(!($rezulat= mysqli_query($GLOBALS['link'], $sqlUpit))){
            die("Ne može se izvršiti upit ".mysqli_error($GLOBALS['link']));
        }
        $niz= mysqli_fetch_all($rezulat);
        
        if($niz[0][0]<$this->suma){
            $razlika= $this->suma-$niz[0][0];
            echo "<p style='font:20px bold Arial; color:red;'>Nemate dovoljno sredstava na računu, fali vam ".$razlika."din. da izvršite uplatu!</p>";
            header("refresh:5;url=Korpa.php");
            return false;
        }
        else{
            if(!($rezultat= mysqli_query($GLOBALS['link'], $sqlUpit2))){
            die("Ne može se izvršiti upit ".mysqli_error($GLOBALS['lnk']));
            return false;
        }
            if(!($rezultat= mysqli_query($GLOBALS['link'], $sqlUpit3))){
            die("Ne može se izvršiti upit ".mysqli_error($GLOBALS['lnk']));
            return false;
        }
            mysqli_close($GLOBALS['lnk']);
            return true;
        }
    }
    public function izmeni_podatke($username,$password,$id){
        $GLOBALS['lnk']=$GLOBALS['link'];
        $this->username= mysqli_real_escape_string($GLOBALS['lnk'],$username);
        $this->password= sha1($password);
        $this->id=$id;
        
        $sqlUpit="update login set username='".$this->username."', password='".$this->password."' where id_user='".$this->id."'";
        
        if(!(mysqli_query($GLOBALS['lnk'], $sqlUpit))){
            die("Ne može se izvršiti upit ".mysqli_error($GLOBALS['lnk']));
            return false;
        }
        mysqli_close($GLOBALS['lnk']);
        return true;
    }
}
