<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once('query/_conn.php');
    $targetDir = "uploads/";
    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['username'];
    $existingFiles = glob($targetDir . base64_encode($username) . "_*.jpg");
    $fileCount = count($existingFiles);
    $uploadedFiles = [];
    for ($i = 0; $i < count($_FILES["fileToUpload"]["name"]) && $fileCount < 3; $i++) {
        $fileIndex = $fileCount + 1;
        $randomNumber = rand(100, 999);
        $targetFile = $targetDir . base64_encode($username) . "_" . "_" . $randomNumber . ".jpg";
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"][$i]);
        if($check !== false) {
            echo "Dosya bir resim - " . $check["mime"] . ".<br>";
            $uploadOk = 1;
        } else {
            echo "Dosya bir resim değil.<br>";
            $uploadOk = 0;
        }
        if (file_exists($targetFile)) {
            echo "Üzgünüz, dosya zaten var.<br>";
            $uploadOk = 0;
        }
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Üzgünüz, sadece JPG, JPEG, PNG ve GIF dosya formatlarına izin verilmektedir.<br>";
            $uploadOk = 0;
        }
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $targetFile)) {
                echo "Dosya başarıyla yüklendi: " . htmlspecialchars(basename($targetFile)) . "<br>";
                $uploadedFiles[] = $targetFile;
                $stmt = $pdo->prepare("INSERT INTO member (profile_pictures) VALUES '$targetFile' WHERE user_id = '$user_id'");
                $stmt->execute([$targetFile]);
                $fileCount++;
            } else {
                echo "Üzgünüz, dosya yükleme sırasında bir hata oluştu.<br>";
            }
        }
    }
    $fileToDelete = $_POST['delete_file'] ?? '';
    if ($fileToDelete && in_array($fileToDelete, $existingFiles)) {
        $stmt = $pdo->prepare("DELETE FROM member WHERE profile_pictures = ?");
        $stmt->execute([$fileToDelete]);
        unlink($fileToDelete);
        echo "Dosya silindi: " . htmlspecialchars(basename($fileToDelete)) . "<br>";
    }
}
?>