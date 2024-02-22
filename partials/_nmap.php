<html>
    <body>
        <pre><?php echo shell_exec("nmap {$_GET["name"]} 2>&1"); ?></pre><br>
    </body>
</html>
