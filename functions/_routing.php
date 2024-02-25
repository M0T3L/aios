<?php
function go($url, $time = 1){
    if($time != 0){
        header("Refresh:$time;url=$url");
    }else{
        header("Location:$url");
    }
    exit();
}