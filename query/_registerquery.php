<?php
session_start();
require_once '_conn.php';
if (isset($_POST['register'])) {
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    if (empty($firstname) || empty($lastname) || empty($username) || empty($password)) {
        $_SESSION['messageR'] = array("text" => "Fill up all fields", "alert" => "danger");
        header("location: ../register.php");
        exit();
    }

    if (!ctype_alpha($firstname) || !ctype_alpha($lastname)) {
        $_SESSION['messageR'] = array("text" => "Firstname and Lastname should only contain letters.", "alert" => "danger");
        header("location: ../register.php");
        exit();
    }
    $constraints_passed = (strlen($firstname) >= 3 && strlen($firstname) <= 20) &&
                         (strlen($lastname) >= 3 && strlen($lastname) <= 20) &&
                         (strlen($username) >= 3 && strlen($username) <= 20) &&
                         (strlen($password) >= 6 && strlen($password) <= 20);
    if (!$constraints_passed) {
        $_SESSION['messageR'] = array("text" => "Character constraints not met.", "alert" => "danger");
        header("location: ../register.php");
        exit();
    }
    $stmt = $conn->prepare("SELECT * FROM `member` WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        $_SESSION['messageR'] = array("text" => "Username already exists. Please choose a different one.", "alert" => "danger");
        $conn = null;
        header('location: ../register.php');
        exit();
    }
    $userId = uniqid();
    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO `member` (user_id, firstname, lastname, username, password) VALUES (:userId, :firstname, :lastname, :username, :password)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        $_SESSION['messageR'] = array("text" => "User created.", "alert" => "info");
        $conn = null;
        header('location: ../login.php');
        exit();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>
