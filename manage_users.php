<!-- manage_users.php -->
<?php
include 'db.php';
session_start();

// التحقق من صلاحية المدير
if ($_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// جلب بيانات المستخدمين
$stmt = $conn->prepare("SELECT * FROM users");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة المستخدمين</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>إدارة المستخدمين</h1>
    <table>
        <thead>
            <tr>
                <th>اسم المستخدم</th>
                <th>البريد الإلكتروني</th>
                <th>عدد المحاولات الفاشلة</th>
                <th>حالة الحساب</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user['username'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td><?= $user['failed_attempts'] ?></td>
                    <td><?= $user['account_locked'] ? 'مغلق' : 'مفتوح' ?></td>
                    <td>
                        <?php if ($user['account_locked']): ?>
                            <a href="unlock_account.php?id=<?= $user['id'] ?>">فتح الحساب</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
