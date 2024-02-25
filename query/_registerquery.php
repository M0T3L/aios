<?php
session_start();
require_once 'query/_conn.php';
if (isset($_POST['register'])) {
    if ($_POST['firstname'] != "" || $_POST['username'] != "" || $_POST['password'] != "") {
        try {
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $userId = uniqid();
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO `member` (user_id, firstname, lastname, username, password) VALUES ('$userId', '$firstname', '$lastname', '$username', '$password')";
            $conn->exec($sql);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $_SESSION['message'] = array("text" => "User created.", "alert" => "info");
        $conn = null;
        header('location: login.php');
    } else {
        echo "
            <script>alert('Fill up all fields')</script>
            <script>window.location = 'register.php'</script>
        ";
    }
}
?>