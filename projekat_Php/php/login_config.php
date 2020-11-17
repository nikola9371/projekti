<?php

//mysqli connection


session_start();

$con= mysqli_connect("localhost","root","","projekat");
if(mysqli_connect_errno()){
    die("Nije moguca konekcija!");
}
function getUserData($userID){
    $upit="select * from login where id_user=$userID limit 1";
    $con= mysqli_connect("localhost","root","","projekat");
        $rez= mysqli_query($con, $upit);
            return mysqli_fetch_array($rez,1);
}
function getUserDataAdmin($userID){
    $upit="select * from login_admin where id_user=$userID limit 1";
    $con= mysqli_connect("localhost","root","","projekat");
        $rez= mysqli_query($con, $upit);
            return mysqli_fetch_array($rez,1);
}
?>

