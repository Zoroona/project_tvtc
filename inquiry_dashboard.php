<!-- inquiry_dashboard.php -->
<?php
include 'db.php';
session_start();

if ($_SESSION['role'] !== 'employee') {
    header("Location: login.php");
    exit();
}

// جلب الاستفسارات من قاعدة البيانات
$stmt = $conn->prepare("SELECT inquiries.*, users.username FROM inquiries JOIN users ON inquiries.user_id = users.id");
$stmt->execute();
$inquiries = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة الاستفسارات</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>الاستفسارات المقدمة</h1>
    <table>
        <thead>
            <tr>
                <th>المستخدم</th>
                <th>الموضوع</th>
                <th>الاستفسار</th>
                <th>تاريخ التقديم</th>
                <th>الرد</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($inquiries as $inquiry): ?>
                <tr>
                    <td><?= $inquiry['username'] ?></td>
                    <td><?= $inquiry['subject'] ?></td>
                    <td><?= $inquiry['message'] ?></td>
                    <td><?= $inquiry['submission_date'] ?></td>
                    <td><?= $inquiry['response'] ?? 'لم يتم الرد بعد' ?></td>
                    <td><a href="reply_inquiry.php?id=<?= $inquiry['id'] ?>">رد</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
