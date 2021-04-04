<?php

//Pomocne funkcije
function HandleError($err){
    $this->error_message=$err."\r\n";
}
function HandleDBError($err){
    $this->HandleError($err."\r\n mysqlierror:".mysqli_error());
}
function SanitizeForSQL($str){
    if(function_exists("mysqli_real_escape_string")){
        $ret_str= mysqli_real_escape_string($str);
    }
    else{
        $ret_str= addslashes($str);
    }
    return $ret_str;
}

//funkcija za preusmeravanje na novu stranicu
function RedirectToUrl($url) {
    header("Location: $url");
    exit;
}

?>
