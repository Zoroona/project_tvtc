<!-- finalize_request.php -->
<?php
include 'db.php';
session_start();

if ($_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $request_id = $_GET['id'];

    // جلب تفاصيل الطلب
    $stmt = $conn->prepare("SELECT * FROM requests WHERE id = :id");
    $stmt->bindParam(':id', $request_id);
    $stmt->execute();
    $request = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $final_refund_amount = $_POST['final_refund_amount'];
        $admin_notes = $_POST['admin_notes'];
        $final_approval = $_POST['final_approval'];

        // تحديث حالة الطلب
        $stmt = $conn->prepare("UPDATE requests SET final_refund_amount = :final_refund_amount, admin_notes = :admin_notes, final_approval = :final_approval WHERE id = :id");
        $stmt->bindParam(':final_refund_amount', $final_refund_amount);
        $stmt->bindParam(':admin_notes', $admin_notes);
        $stmt->bindParam(':final_approval', $final_approval);
        $stmt->bindParam(':id', $request_id);

        if ($stmt->execute()) {
            echo "تم اتخاذ القرار النهائي بنجاح!";
            header("Location: admin_dashboard.php");
        } else {
            echo "حدث خطأ أثناء اتخاذ القرار النهائي!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اتخاذ القرار النهائي</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>مراجعة الطلب</h1>
        <p>الاسم الكامل: <?= $request['fullname'] ?></p>
        <p>رقم الهوية الوطنية: <?= $request['national_id'] ?></p>
        <p>الرقم الجامعي: <?= $request['university_id'] ?></p>
        <p>المبلغ المقترح للاسترجاع: <?= $request['refund_amount'] ?></p>
        <p>ملاحظات الموظف: <?= $request['employee_notes'] ?></p>

        <form action="" method="POST">
            <label for="final_refund_amount">المبلغ النهائي للاسترجاع:</label>
            <input type="text" id="final_refund_amount" name="final_refund_amount" value="<?= $request['refund_amount'] ?>" required>

            <label for="admin_notes">ملاحظات المدير:</label>
            <textarea id="admin_notes" name="admin_notes"></textarea>

            <label for="final_approval">حالة الاعتماد:</label>
            <select id="final_approval" name="final_approval">
                <option value="معتمد">معتمد</option>
                <option value="مرفوض">مرفوض</option>
            </select>

            <button type="submit">اعتماد</button>
        </form>
    </div>
</body>
</html>
