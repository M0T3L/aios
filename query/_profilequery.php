<?php
session_start();
require_once '_conn.php';
if (isset($_POST['profile'])) {
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $user_id = $_SESSION['user_id'];
    if (empty($firstname) || empty($username) || empty($password)) {
        $_SESSION['messageU'] = array("text" => "Fill up all fields", "alert" => "danger");
        header('location: ../profile.php');
        exit();
    }
    try {
        $constraints_passed = (strlen($firstname) >= 3 && strlen($firstname) <= 20) &&
                             (strlen($lastname) >= 3 && strlen($lastname) <= 20) &&
                             (strlen($username) >= 3 && strlen($username) <= 20) &&
                             (strlen($password) >= 6 && strlen($password) <= 20);
        if (!$constraints_passed) {
            $_SESSION['messageU'] = array("text" => "Character constraints not met.", "alert" => "danger");
            header('location: ../profile.php');
            exit();
        }
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE member SET firstname = :firstname, lastname = :lastname, username = :username, password = :password WHERE user_id = :userId";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':userId', $user_id);
        $stmt->execute();
        $_SESSION['messageU'] = array("text" => "User profile updated.", "alert" => "info");
        $conn = null;
        header('location: ../profile.php');
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
