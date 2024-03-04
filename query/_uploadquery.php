<?php
session_start();
require_once('_conn.php');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$target_dir = "/var/www/html/uploads/";
$stmt = $conn->prepare("SELECT COUNT(*) as total FROM member WHERE user_id = :user_id");
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$total_photos = $row['total'];
if ($total_photos < 3) {
    for ($i = 1; $i <= 3; $i++) {
        $column_name = "pp" . $i;
        $stmt = $conn->prepare("SELECT $column_name FROM member WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (empty($row[$column_name])) {
            $photo_name = base64_encode($username) . '_' . mt_rand(100, 999) . '.jpg';
            $target_path = $target_dir . $photo_name;
            move_uploaded_file($_FILES['fileToUpload']['tmp_name'][0], $target_path);
            $stmt = $conn->prepare("UPDATE member SET $column_name = :photo_name WHERE user_id = :user_id");
            $stmt->bindParam(':photo_name', $photo_name, PDO::PARAM_STR);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
            $stmt->execute();

            echo "Uploaded successfully";
            break;
        }
    }
} else {
    echo "Error";
}
header("Location: ../profile.php");
exit();
?>