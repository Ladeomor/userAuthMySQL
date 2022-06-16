<?php
session_start();
logout();
function logout(){
    $url = "http://localhost:8080/userAuthMySQL/forms/login.html";
        if(isset($_SESSION['username'])){
        unset($_SESSION['username']);

    } 
    header("location: $url");




}
?>