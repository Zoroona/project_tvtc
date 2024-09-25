<!-- process_register.php -->
<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // تشفير كلمة المرور

    // التحقق من وجود المستخدم بالفعل
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "البريد الإلكتروني مستخدم بالفعل!";
    } else {
        // إدخال المستخدم الجديد
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (:username, :email, :password, 'student')");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);

        if ($stmt->execute()) {
            echo "تم إنشاء الحساب بنجاح!";
            header("Location: login.php"); // إعادة التوجيه إلى صفحة تسجيل الدخول
        } else {
            echo "حدث خطأ أثناء إنشاء الحساب!";
        }
    }
}
?>
