<!-- submit_request.php -->
<?php
include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $fullname = $_POST['fullname'];
    $national_id = $_POST['national_id'];
    $university_id = $_POST['university_id'];
    $phone = $_POST['phone'];
    $payment_date = $_POST['payment_date'];
    $payment_method = $_POST['payment_method'];
    $refund_reason = $_POST['refund_reason'];
    $program_name = $_POST['program_name'];
    $submission_date = date('Y-m-d');

    // رفع الملف إن وجد
    if (isset($_FILES['file_attachment']) && $_FILES['file_attachment']['error'] == UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['file_attachment']['tmp_name'];
        $file_name = $_FILES['file_attachment']['name'];
        $file_path = 'uploads/' . $file_name;
        move_uploaded_file($file_tmp, $file_path);
    } else {
        $file_path = null;
    }

    // إدخال الطلب في قاعدة البيانات
    $stmt = $conn->prepare("INSERT INTO requests (user_id, fullname, national_id, university_id, phone, payment_date, payment_method, refund_reason, program_name, submission_date, file_attachment) VALUES (:user_id, :fullname, :national_id, :university_id, :phone, :payment_date, :payment_method, :refund_reason, :program_name, :submission_date, :file_attachment)");

    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':fullname', $fullname);
    $stmt->bindParam(':national_id', $national_id);
    $stmt->bindParam(':university_id', $university_id);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':payment_date', $payment_date);
    $stmt->bindParam(':payment_method', $payment_method);
    $stmt->bindParam(':refund_reason', $refund_reason);
    $stmt->bindParam(':program_name', $program_name);
    $stmt->bindParam(':submission_date', $submission_date);
    $stmt->bindParam(':file_attachment', $file_path);

    if ($stmt->execute()) {
        // إرسال البريد الإلكتروني للمستخدم
        $to = $_SESSION['email'];  // البريد الإلكتروني الخاص بالطالب
        $subject = "تم استلام طلب استعادة الرسوم الخاص بك";
        $message = "عزيزي/عزيزتي " . $_SESSION['username'] . "،\n\nتم استلام طلب استعادة الرسوم الخاص بك بنجاح. سيتم مراجعة طلبك قريباً.\n\nشكراً لك.";
        $headers = "From: no-reply@university.com";

        mail($to, $subject, $message, $headers);

        echo "تم تقديم الطلب بنجاح!";
        header("Location: dashboard.php");
    } else {
        echo "حدث خطأ أثناء تقديم الطلب!";
    }
}
?>
