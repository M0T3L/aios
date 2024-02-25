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
				echo "
				<script>alert('Invalid username or password')</script>
				<script>window.location = '../login.php'</script>
				";
			}
		} else {
			echo "
				<script>alert('Fill up all fields')</script>
				<script>window.location = '../login.php'</script>
			";
		}
	}
?>
