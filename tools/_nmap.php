<?php
$ipAddress = filter_input(INPUT_GET, 'ip', FILTER_VALIDATE_IP);
$port = filter_input(INPUT_GET, 'port', FILTER_VALIDATE_INT);
$scanType = '';
if (isset($_GET['sT'])) {
    $scanType .= '-sT ';
}
if (isset($_GET['sC'])) {
    $scanType .= '-sC ';
}
if (isset($_GET['sV'])) {
    $scanType .= '-sV ';
}
if ($ipAddress !== false) {
    $command = "nmap $scanType";
    if (!empty($port)) {
        $command .= " -p $port";
    }
    $command .= " $ipAddress";
    $output = shell_exec($command . " 2>&1");
    echo "<pre>$output</pre>";
} else {
    echo "<pre>IP address is not valid</pre>";
}
?>