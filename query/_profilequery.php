<?php
session_start();
require_once 'query/_conn.php';
if (isset($_POST['profile'])) {
    if ($_POST['firstname'] != "" || $_POST['username'] != "" || $_POST['password'] != "") {
        try {
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $user_id = $_SESSION['user_id'];
            $uploadDir = 'uploads/';
            $profilePicturePaths = [];
            if (!empty($_FILES['profile_pictures']['name'][0])) {
                foreach ($_FILES['profile_pictures']['tmp_name'] as $key => $tmpName) {
                    $profilePictureName = $_FILES['profile_pictures']['name'][$key];
                    $profilePicturePath = $uploadDir . basename($profilePictureName);
                    move_uploaded_file($tmpName, $profilePicturePath);
                    $profilePicturePaths[] = $profilePicturePath;
                }
            }
            $profilePicturePaths = array_slice($profilePicturePaths, 0, 3);
            $profilePicturePathsStr = implode(',', $profilePicturePaths);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE member SET firstname = '$firstname', lastname = '$lastname', username = '$username', password = '$password', profile_pictures = '$profilePicturePathsStr' WHERE user_id = '$user_id'";
            $conn->exec($sql);
            $_SESSION['message'] = array("text" => "User profile updated.", "alert" => "info");
            $conn = null;
            header('location: profile.php');
            exit();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "
            <script>alert('Fill up all fields')</script>
            <script>window.location = 'register.php'</script>
        ";
    }
}
?>