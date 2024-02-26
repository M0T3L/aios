<?php
	session_start();
	require_once '_conn.php';
	if(isset($_POST['login'])){
		if($_POST['username'] != "" || $_POST['password'] != ""){
			$username = $_POST['username'];
			$password = $_POST['password'];
			$sql = "SELECT * FROM `member` WHERE `username`=? AND `password`=?";
			$query = $conn->prepare($sql);
			$query->execute(array($username, $password));
			$row = $query->rowCount();
			if($row > 0) {
				$fetch = $query->fetch();
				$userId = $fetch['user_id'];
				$_SESSION['username'] = $username;
				$_SESSION['user_id'] = $userId;
				$_SESSION["loggedIn"] = true;
				header("location: ../index.php");
			} else {
				$_SESSION['messageL'] = array("text" => "Invalid username or password", "alert" => "danger");
       			header("location: ../login.php");
			}
		} else {
			$_SESSION['messageL'] = array("text" => "Fill up all fields", "alert" => "danger");
    		header("location: ../login.php");
		}
	}
?>
