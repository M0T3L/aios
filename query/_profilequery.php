<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once '_conn.php';
if (isset($_POST['profile'])) {
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $password = trim($_POST['password']);
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $user_id = $_SESSION['user_id'];
    if (empty($firstname) || empty($lastname) || empty($password)) {
        $_SESSION['messageU'] = array("text" => "Fill up all fields", "alert" => "danger");
        header('location: ../profile.php');
        exit();
    }
    if (!ctype_alpha($firstname) || !ctype_alpha($lastname)) {
        $_SESSION['messageU'] = array("text" => "Firstname and Lastname should only contain letters.", "alert" => "danger");
        header("location: ../profile.php");
        exit();
    }
    try {
        $constraints_passed = (strlen($firstname) >= 1 && strlen($firstname) <= 20) &&
                             (strlen($lastname) >= 1 && strlen($lastname) <= 20) &&
                             (strlen($password) >= 6 && strlen($password) <= 20);
        if (!$constraints_passed) {
            $_SESSION['messageU'] = array("text" => "Character constraints not met.", "alert" => "danger");
            header('location: ../profile.php');
            exit();
        }
    $stmt = $conn->prepare("SELECT * FROM `member` WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        $_SESSION['messageU'] = array("text" => "Username already exists. Please choose a different one.", "alert" => "danger");
        $conn = null;
        header('location: ../profile.php');
        exit();
    }
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE member SET firstname = :firstname, lastname = :lastname, password = :password WHERE user_id = :userId";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':userId', $user_id);
        $stmt->execute();
        $sql1 = "SELECT firstname, lastname, username FROM `member` WHERE `user_id`=:user_id";
        $stmt = $conn->prepare($sql1);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['username'] = $user['username'];
        $_SESSION['firstname'] = $user['firstname'];
        $_SESSION['lastname'] = $user['lastname'];
        $_SESSION['messageU'] = array("text" => "User profile updated.", "alert" => "info");
        $conn = null;
        header('location: ../profile.php');
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
