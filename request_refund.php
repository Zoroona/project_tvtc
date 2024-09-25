<!-- request_refund.php -->
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>طلب استعادة رسوم</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>طلب استعادة رسوم</h1>
    <form action="submit_request.php" method="POST" enctype="multipart/form-data">
        <label for="fullname">الاسم الكامل:</label>
        <input type="text" id="fullname" name="fullname" required>

        <label for="national_id">رقم الهوية الوطنية:</label>
        <input type="text" id="national_id" name="national_id" required>

        <label for="university_id">الرقم الجامعي (إن وجد):</label>
        <input type="text" id="university_id" name="university_id">

        <label for="phone">رقم الجوال:</label>
        <input type="text" id="phone" name="phone" required>

        <label for="payment_date">تاريخ السداد:</label>
        <input type="date" id="payment_date" name="payment_date" required>

        <label for="payment_method">طريقة الدفع:</label>
        <select id="payment_method" name="payment_method">
            <option value="electronic">دفع إلكتروني</option>
            <option value="transfer">تحويل</option>
            <option value="deposit">إيداع</option>
        </select>

        <label for="refund_reason">سبب الاسترجاع:</label>
        <textarea id="refund_reason" name="refund_reason" required></textarea>

        <label for="program_name">اسم البرنامج:</label>
        <input type="text" id="program_name" name="program_name" required>

        <label for="file_attachment">إرفاق مستندات (إن وجد):</label>
        <input type="file" id="file_attachment" name="file_attachment">

        <button type="submit">إرسال الطلب</button>
    </form>
</body>
</html>
