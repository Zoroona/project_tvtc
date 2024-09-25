<!-- register.php -->
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء حساب جديد</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="register-container">
        <h1>إنشاء حساب جديد</h1>
        <form action="process_register.php" method="POST">
            <label for="username">اسم المستخدم:</label>
            <input type="text" id="username" name="username" required>

            <label for="email">البريد الإلكتروني:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">كلمة المرور:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">تسجيل</button>
        </form>
    </div>
</body>
</html>
