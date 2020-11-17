<?php

include ('connect.php');
$GLOBALS['link']= connection();


class profil_admin_slike {
//put your code here
        public $id;
        public $picName;
    
       public function dodaj_sliku($id_user,$picName){
        $GLOBALS['lnk']=$GLOBALS['link'];
        $this->id=$id_user;
        $this->picName=$picName;
        
        $sqlUpit1="select * from profile_pics_admin where id_user='".$this->id."'";
        $sqlUpit2="insert into profile_pics_admin(name,id_user) values('$this->picName','$this->id')";
        $sqlUpit3="update profile_pics_admin set name='".$this->picName."' where id_user='".$this->id."'";
        
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
        
        $sqlUpit="select * from profile_pics_admin where id_user='".$this->id."'";
        
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
}
