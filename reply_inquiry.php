<!-- reply_inquiry.php -->
<?php
include 'db.php';
session_start();

if ($_SESSION['role'] !== 'employee') {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $inquiry_id = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $response = $_POST['response'];
        $response_date = date('Y-m-d');

        // تحديث الاستفسار في قاعدة البيانات
        $stmt = $conn->prepare("UPDATE inquiries SET response = :response, response_date = :response_date WHERE id = :id");
        $stmt->bindParam(':response', $response);
        $stmt->bindParam(':response_date', $response_date);
        $stmt->bindParam(':id', $inquiry_id);

        if ($stmt->execute()) {
            // إرسال البريد الإلكتروني للمستخدم
            $stmt = $conn->prepare("SELECT users.email, users.username FROM inquiries JOIN users ON inquiries.user_id = users.id WHERE inquiries.id = :id");
            $stmt->bindParam(':id', $inquiry_id);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            $to = $user['email'];  // البريد الإلكتروني الخاص بالطالب
            $subject = "تم الرد على استفسارك";
            $message = "عزيزي/عزيزتي " . $user['username'] . "،\n\nتم الرد على استفسارك المقدم. يمكنك التحقق من الرد من خلال حسابك في النظام.\n\nشكراً لك.";
            $headers = "From: no-reply@university.com";

            mail($to, $subject, $message, $headers);

            echo "تم الرد على الاستفسار بنجاح!";
            header("Location: inquiry_dashboard.php");
        } else {
            echo "حدث خطأ أثناء الرد على الاستفسار!";
        }
    }
}
?>
