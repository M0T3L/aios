<?php
session_start();
require "functions/routing.php";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username=security($_POST["username"]);
    $password=security($_POST["password"]);

}else{
    echo 'You can not access this webpage. You are being redirected...';
    go("/aios/login.php");
}
?>