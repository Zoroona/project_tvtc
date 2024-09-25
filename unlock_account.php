<!-- unlock_account.php -->
<?php
include 'db.php';
session_start();

if ($_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // فتح الحساب
    $stmt = $conn->prepare("UPDATE users SET account_locked = 0, failed_attempts = 0 WHERE id = :id");
    $stmt->bindParam(':id', $user_id);
    if ($stmt->execute()) {
        echo "تم فتح الحساب بنجاح!";
        header("Location: manage_users.php");
    } else {
        echo "حدث خطأ أثناء فتح الحساب.";
    }
}
?>
