<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
// _conn.php dosyasını include et
require_once('_conn.php');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];


// Hedef dizini tanımla
$target_dir = "/var/www/html/uploads/";

// Kullanıcının mevcut fotoğraf sayısını kontrol et
$stmt = $conn->prepare("SELECT COUNT(*) as total FROM member WHERE user_id = :user_id");
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$total_photos = $row['total'];

// Kullanıcı toplamda 3 fotoğraf barındırabilir
if ($total_photos < 3) {
    // Kullanıcının mevcut fotoğraflarını kontrol et ve boş olan ilk sütuna yükle
    for ($i = 1; $i <= 3; $i++) {
        $column_name = "pp" . $i;
        $stmt = $conn->prepare("SELECT $column_name FROM member WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Eğer sütun boşsa, fotoğrafı yükle
        if (empty($row[$column_name])) {
            $photo_name = base64_encode($username) . '_' . mt_rand(100, 999) . '.jpg'; // Örnek isim oluştur
            $target_path = $target_dir . $photo_name;

            // Fotoğrafı hedef dizine kaydet
            move_uploaded_file($_FILES['fileToUpload']['tmp_name'][0], $target_path);


            // Veritabanına fotoğraf adını kaydet
            $stmt = $conn->prepare("UPDATE member SET $column_name = :photo_name WHERE user_id = :user_id");
            $stmt->bindParam(':photo_name', $photo_name, PDO::PARAM_STR);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
            $stmt->execute();

            echo "Fotoğraf başarıyla yüklendi.";
            break;
        }
    }
} else {
    echo "Üzgünüz, maksimum 3 fotoğraf yükleyebilirsiniz.";
}
?>
