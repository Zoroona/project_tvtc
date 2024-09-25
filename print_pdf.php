<!-- print_pdf.php -->
<?php
require('fpdf/fpdf.php');
include 'db.php';

if (isset($_GET['id'])) {
    $request_id = $_GET['id'];

    // جلب بيانات الطلب
    $stmt = $conn->prepare("SELECT * FROM requests WHERE id = :id");
    $stmt->bindParam(':id', $request_id);
    $stmt->execute();
    $request = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($request) {
        // إعداد ملف PDF
        $pdf = new FPDF();
        $pdf->AddPage();

        // إعداد الخط
        $pdf->SetFont('Arial', 'B', 16);

        // عنوان
        $pdf->Cell(0, 10, 'طلب استعادة رسوم', 0, 1, 'C');

        // الانتقال للسطر الجديد
        $pdf->Ln(10);

        // عرض تفاصيل الطلب
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(50, 10, 'الاسم الكامل:', 1);
        $pdf->Cell(0, 10, $request['fullname'], 1, 1);

        $pdf->Cell(50, 10, 'رقم الهوية الوطنية:', 1);
        $pdf->Cell(0, 10, $request['national_id'], 1, 1);

        $pdf->Cell(50, 10, 'الرقم الجامعي:', 1);
        $pdf->Cell(0, 10, $request['university_id'], 1, 1);

        $pdf->Cell(50, 10, 'تاريخ السداد:', 1);
        $pdf->Cell(0, 10, $request['payment_date'], 1, 1);

        $pdf->Cell(50, 10, 'طريقة الدفع:', 1);
        $pdf->Cell(0, 10, $request['payment_method'], 1, 1);

        $pdf->Cell(50, 10, 'سبب الاسترجاع:', 1);
        $pdf->MultiCell(0, 10, $request['refund_reason'], 1);

        $pdf->Cell(50, 10, 'اسم البرنامج:', 1);
        $pdf->Cell(0, 10, $request['program_name'], 1, 1);

        // إضافة التاريخ
        $pdf->Cell(50, 10, 'تاريخ التقديم:', 1);
        $pdf->Cell(0, 10, $request['submission_date'], 1, 1);

        // إخراج ملف PDF
        $pdf->Output();
    } else {
        echo "الطلب غير موجود.";
    }
}
?>
