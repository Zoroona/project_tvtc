<!-- dashboard.php -->
<?php
session_start();

// التحقق من صلاحية المستخدم بناءً على دوره
if (!isset($_SESSION['role'])) {
    header("Location: login.php");
    exit();
}

switch ($_SESSION['role']) {
    case 'student':
        header("Location: request_refund.php");
        break;
    case 'employee':
        header("Location: employee_dashboard.php");
        break;
    case 'admin':
        header("Location: admin_dashboard.php");
        break;
    default:
        header("Location: login.php");
        break;
}
?>
