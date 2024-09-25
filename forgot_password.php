<!-- forgot_password.php -->
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>استعادة كلمة المرور</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="forgot-password-container">
        <h1>استعادة كلمة المرور</h1>
        <form action="process_forgot_password.php" method="POST">
            <label for="email">البريد الإلكتروني:</label>
            <input type="email" id="email" name="email" required>
            
            <button type="submit">إرسال</button>
        </form>
    </div>
</body>
</html>
