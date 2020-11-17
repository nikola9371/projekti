<?php
    function connection(){
        $sqlLink= mysqli_connect("localhost","root","", "projekat");
        
        if(!$sqlLink){
           die("Neuspešno prijavljivanje na bazu! ". mysqli_connect_error());
        }
        return $sqlLink;
    }

?>

