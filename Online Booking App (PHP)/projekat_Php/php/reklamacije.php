<?php
include ('connect.php');
$GLOBALS['link']= connection();

class Reklamacije {
    public $brReklamacije;
    public $ImePrezime;
    public $ImePrezimeUpis;
    public $datumRodj;
    public $pol;
    public $brNarudz;
    
    public function vrati_postojece_reklamacije($brReklamacije){
        
        $GLOBALS['lnk']=$GLOBALS['link'];
        
        $this->brReklamacije=$brReklamacije;
        
        $sqlUpit1="select * from reklamacija where idReklamacije='".$this->brReklamacije."'";
        
        if(!($rezulat= mysqli_query($GLOBALS['lnk'], $sqlUpit1))){
            die("Ne može se izvršiti upit ".mysqli_error($GLOBALS['lnk']));
        }
        $brRedova= mysqli_num_rows($rezulat);
        
        for($i=0;$i<=$brRedova;$i++){
            $niz[$i]= mysqli_fetch_array($rezulat);
        }
        mysqli_close($GLOBALS['lnk']);
        return $niz;
    }
    public function azuriraj_reklamacije($imePrezime,$datumRodj,$pol,$brNarudz){
        $GLOBALS['lnk']=$GLOBALS['link'];
        
        $this->ImePrezimeUpis=$imePrezime;
        $this->datumRodj=$datumRodj;
        $this->pol=$pol;
        $this->brNarudz=$brNarudz;
        
        $sqlUpit2="insert into reklamacija(idNarudzbenica,imePrezime,datumRodjenja,pol) "
                . "values('".$this->brNarudz."','".$this->ImePrezimeUpis."','".$this->datumRodj."','".$this->pol."')";
        if(!($rezultat= mysqli_query($GLOBALS['lnk'], $sqlUpit2))){
            die("Došlo je do greške pri izvršenju upita".mysqli_error($GLOBALS['lnk']));
        }
    }
}

