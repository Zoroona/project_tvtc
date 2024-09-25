<!-- inquiry.php -->
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحة الاستفسار</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>تقديم استفسار</h1>
    <form action="submit_inquiry.php" method="POST">
        <label for="subject">الموضوع:</label>
        <input type="text" id="subject" name="subject" required>

        <label for="message">الرسالة:</label>
        <textarea id="message" name="message" required></textarea>

        <button type="submit">إرسال</button>
    </form>
</body>
</html>
