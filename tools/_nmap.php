<?php
$userInput = $_GET["name"];
$ipAddress = filter_var($userInput, FILTER_VALIDATE_IP);
if ($ipAddress !== false) {
    $output = shell_exec("nmap $ipAddress 2>&1");
    echo "<pre>$output</pre>";
} else {
    echo "<pre>Ip adress is not valid</pre>";
}
?>