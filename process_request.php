<!-- process_request.php -->
<?php
include 'db.php';
session_start();

if ($_SESSION['role'] !== 'employee') {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $request_id = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $paid_amount = $_POST['paid_amount'];
        $discount_rate = $_POST['discount_rate'];
        $refund_amount = $_POST['refund_amount'];
        $status = $_POST['status'];
        $employee_notes = $_POST['employee_notes'];

        $stmt = $conn->prepare("UPDATE requests SET paid_amount = :paid_amount, discount_rate = :discount_rate, refund_amount = :refund_amount, status = :status, employee_notes = :employee_notes WHERE id = :id");
        $stmt->bindParam(':paid_amount', $paid_amount);
        $stmt->bindParam(':discount_rate', $discount_rate);
        $stmt->bindParam(':refund_amount', $refund_amount);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':employee_notes', $employee_notes);
        $stmt->bindParam(':id', $request_id);

        if ($stmt->execute()) {
            echo "تم تحديث الطلب بنجاح!";
            header("Location: employee_dashboard.php");
        } else {
            echo "حدث خطأ أثناء تحديث الطلب!";
        }
    }
}
?>
