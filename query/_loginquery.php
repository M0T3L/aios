<?php
session_start();
require_once '_conn.php';

if (isset($_POST['login'])) {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT user_id, firstname, lastname, password FROM `member` WHERE `username`=:username";
        $query = $conn->prepare($sql);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->execute();
        $user = $query->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['firstname'] = $user['firstname'];
            $_SESSION['lastname'] = $user['lastname'];
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
