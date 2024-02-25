<?php
session_start();
require "functions/_routing.php";
if (!$_SESSION["loggedIn"]){
    echo 'You can not access this webpage. You are being redirected...';
    go("login.php");
    die;
}
?>