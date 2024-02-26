<?php
session_start();
require_once '_conn.php';
if (isset($_POST['delete'])) {
    $user_id = $_SESSION['user_id'];
    $image_path = $_POST['image_path'];
    $delfrom = '/var/www/html/uploads/'.$image_path;
    if (file_exists($delfrom)) {
        unlink($delfrom);
    }
    $stmt = $conn->prepare("UPDATE member SET pp1 = REPLACE(pp1, ?, ''), pp2 = REPLACE(pp2, ?, ''), pp3 = REPLACE(pp3, ?, '') WHERE user_id = ?");
    $stmt->execute([$image_path, $image_path, $image_path, $user_id]);
}
header("Location: ../profile.php");
exit();
?>
