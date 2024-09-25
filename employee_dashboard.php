<!-- employee_dashboard.php -->
<?php
include 'db.php';
session_start();

if ($_SESSION['role'] !== 'employee') {
    header("Location: login.php");
    exit();
}

$stmt = $conn->prepare("SELECT * FROM requests");
$stmt->execute();
$requests = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحة الموظف المختص</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>طلبات استعادة الرسوم</h1>
    <table>
        <thead>
            <tr>
                <th>الاسم الكامل</th>
                <th>رقم الهوية الوطنية</th>
                <th>الرقم الجامعي</th>
                <th>تاريخ السداد</th>
                <th>الحالة</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($requests as $request): ?>
                <tr>
                    <td><?= $request['fullname'] ?></td>
                    <td><?= $request['national_id'] ?></td>
                    <td><?= $request['university_id'] ?></td>
                    <td><?= $request['payment_date'] ?></td>
                    <td><?= $request['status'] ?? 'قيد المراجعة' ?></td>
                    <td><a href="process_request.php?id=<?= $request['id'] ?>">مراجعة</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
