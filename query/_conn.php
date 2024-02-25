<?php
    	$db_username = 'root';
    	$db_password = 'toor';
    	$conn = new PDO( 'mysql:host=localhost;dbname=aios', $db_username, $db_password );
    	if(!$conn){
    		die("Fatal Error: Connection Failed!");
    	}
?>