<!-- login.php -->
<?php
include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // التأكد من صحة البيانات المدخلة
    if (!empty($username) && !empty($password)) {
        // البحث عن المستخدم بناءً على اسم المستخدم
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // التحقق من وجود المستخدم والتحقق من كلمة المرور
        if ($user && password_verify($password, $user['password'])) {
            // نجاح تسجيل الدخول
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // إعادة التوجيه بناءً على دور المستخدم
            header("Location: dashboard.php");
            exit();
        } else {
            // عرض رسالة خطأ في حال فشل تسجيل الدخول
            $error = "اسم المستخدم أو كلمة المرور غير صحيح.";
        }
    } else {
        $error = "يرجى إدخال اسم المستخدم وكلمة المرور.";
    }
}
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="login-container">
        <h1>تسجيل الدخول</h1>
        <?php if (isset($error)): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>
        <form action="login.php" method="POST">
            <label for="username">اسم المستخدم:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">كلمة المرور:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">دخول</button>
        </form>
    </div>
</body>
</html>
