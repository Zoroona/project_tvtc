<?php
$servername = "sql109.infinityfree.com";  // استبدل XXX برقم الخادم الخاص بك
$username = "if0_37374584";  // اسم المستخدم الذي حصلت عليه من InfinityFree
$password = "Kknm1002";  // كلمة المرور التي أنشأتها عند إعداد قاعدة البيانات
$dbname = "if0_37374584_project_tvtc";  // اسم قاعدة البيانات التي أنشأتها

try {
    // إنشاء الاتصال بقاعدة البيانات
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // تعيين وضع الخطأ لـ PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // تأكيد الاتصال الناجح
    echo "تم الاتصال بقاعدة البيانات بنجاح";
} catch (PDOException $e) {
    // التعامل مع الخطأ في حال فشل الاتصال
    echo "فشل الاتصال بقاعدة البيانات: " . $e->getMessage();
}
?>
