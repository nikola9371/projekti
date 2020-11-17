<?php
    include ('connect.php');
    $GLOBALS['link']= connection();
    
class Registracije{
    
    public $imePrezime;
    public $email;
    public $kIme;
    public $pass;
    public $regDate;
    
    public function azuriraj_registracije($imePrez,$email,$kIme,$pass,$regDate){
        $GLOBALS['lnk']=$GLOBALS['link'];
        
        $this->imePrezime=$imePrez;
        $this->email=$email;
        $this->kIme=$kIme;
        $this->pass=$pass;
        $this->regDate=$regDate;
        
        $sqlUpit="insert into login(name,email,username,password,reg_date) "
                . "values('".$this->imePrezime."','".$this->email."','".$this->kIme."','".$this->pass."','".$this->regDate."')";
        if(!($rezultat= mysqli_query($GLOBALS['lnk'], $sqlUpit))){
            die("Došlo je do greške pri izvršenju upita: ". mysqli_error($GLOBALS['lnk']));
        }
    }
}
?>
