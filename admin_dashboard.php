<!-- admin_dashboard.php -->
<?php
include 'db.php';
session_start();

// التحقق من صلاحيات المدير
if ($_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// جلب الطلبات المعتمدة من الموظف المختص
$stmt = $conn->prepare("SELECT * FROM requests WHERE status = 'معتمد'");
$stmt->execute();
$requests = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة المدير</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>الطلبات المعتمدة من الموظفين</h1>
    <table>
        <thead>
            <tr>
                <th>الاسم الكامل</th>
                <th>رقم الهوية الوطنية</th>
                <th>الرقم الجامعي</th>
                <th>المبلغ المستحق</th>
                <th>ملاحظات الموظف</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($requests as $request): ?>
                <tr>
                    <td><?= $request['fullname'] ?></td>
                    <td><?= $request['national_id'] ?></td>
                    <td><?= $request['university_id'] ?></td>
                    <td><?= $request['refund_amount'] ?></td>
                    <td><?= $request['employee_notes'] ?></td>
                    <td>
                        <a href="finalize_request.php?id=<?= $request['id'] ?>">مراجعة</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
