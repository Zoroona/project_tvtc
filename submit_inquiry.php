<!-- submit_inquiry.php -->
<?php
include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $submission_date = date('Y-m-d');

    // إدخال الاستفسار في قاعدة البيانات
    $stmt = $conn->prepare("INSERT INTO inquiries (user_id, subject, message, submission_date) VALUES (:user_id, :subject, :message, :submission_date)");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':subject', $subject);
    $stmt->bindParam(':message', $message);
    $stmt->bindParam(':submission_date', $submission_date);

    if ($stmt->execute()) {
        echo "تم إرسال الاستفسار بنجاح!";
        header("Location: dashboard.php");
    } else {
        echo "حدث خطأ أثناء إرسال الاستفسار!";
    }
}
?>
