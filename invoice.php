<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id']) || !isset($_GET['id'])) { 
    header("Location: login.php"); 
    exit(); 
}

$booking_id = intval($_GET['id']);
$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT b.*, u.full_name, u.email, u.phone FROM bookings b JOIN users u ON b.user_id = u.id WHERE b.id = ? AND b.user_id = ?");
$stmt->execute([$booking_id, $user_id]);
$booking = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$booking) {
    die("الطلب غير موجود أو ليس لديك صلاحية لعرضه.");
}

$itemsStmt = $pdo->prepare("
    SELECT s.service_name, l.name as lab_name, bi.price_at_booking 
    FROM booking_items bi 
    JOIN services s ON bi.service_id = s.id 
    JOIN labs l ON s.lab_id = l.id 
    WHERE bi.booking_id = ?
");
$itemsStmt->execute([$booking_id]);
$items = $itemsStmt->fetchAll(PDO::FETCH_ASSOC);

$msg = "";
if (isset($_POST['send_email'])) {
    $to = $booking['email'];
    $subject = "فاتورة طلبك من مختبراتي رقم #" . $booking['id'];
    
    $message = "مرحباً " . $booking['full_name'] . "\n\n";
    $message .= "إليك تفاصيل فاتورة طلبك:\n";
    $message .= "التاريخ والوقت: " . $booking['appointment_date'] . " (" . $booking['appointment_time'] . ")\n";
    $message .= "المكان: " . $booking['city'] . " - " . $booking['address'] . "\n\n";
    
    $message .= "الفحوصات المطلوبة:\n";
    foreach ($items as $item) {
        $message .= "- " . $item['service_name'] . " (" . $item['lab_name'] . "): " . $item['price_at_booking'] . " ريال\n";
    }
    
    $message .= "\nالإجمالي: " . $booking['total_price'] . " ريال\n\n";
    $message .= "شكراً لثقتكم بنا - مختبراتي.";
    
    $headers = "From: no-reply@mylab.com" . "\r\n" . "Content-Type: text/plain; charset=UTF-8";
    
    if(mail($to, $subject, $message, $headers)) {
        $msg = "<div class='success'>✅ تم إرسال الفاتورة إلى بريدك الإلكتروني بنجاح!</div>";
    } else {
        $msg = "<div class='error'>❌ حدث خطأ أثناء إرسال البريد. قد لا تدعم استضافتك هذه الميزة.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>فاتورة طلب #<?= $booking['id'] ?></title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, sans-serif; background: #f4f7f6; margin: 0; padding: 40px 20px; }
        .invoice-box { max-width: 700px; margin: auto; padding: 40px; border: 1px solid #eee; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05); font-size: 16px; line-height: 24px; color: #555; background: #fff; border-radius: 10px; }
        .invoice-box table { width: 100%; line-height: inherit; text-align: right; border-collapse: collapse; }
        .invoice-box table td { padding: 10px; vertical-align: top; }
        .invoice-box table tr.top table td { padding-bottom: 20px; }
        .invoice-box table tr.top table td.title { font-size: 35px; line-height: 45px; color: blue; font-weight: bold; }
        .invoice-box table tr.information table td { padding-bottom: 40px; }
        .invoice-box table tr.heading td { background: #f5f7fa; border-bottom: 2px solid #ddd; font-weight: bold; color: #333; }
        .invoice-box table tr.item td { border-bottom: 1px solid #eee; }
        .invoice-box table tr.total td:nth-child(2) { border-top: 2px solid #333; font-weight: bold; font-size: 20px; color: green; }
        
        .actions { text-align: center; margin-top: 40px; }
        .btn { padding: 12px 25px; margin: 5px; border: none; border-radius: 8px; cursor: pointer; font-size: 16px; font-weight: bold; color: #fff; transition: 0.3s; font-family: inherit; }
        .btn-print { background: #198754; }
        .btn-print:hover { background: #157347; }
        .btn-email { background: #0d6efd; }
        .btn-email:hover { background: #0b5ed7; }
        .btn-back { background: #6c757d; text-decoration: none; display: inline-block; }
        
        .success { color: green; text-align: center; font-weight: bold; margin-bottom: 20px; background: #e6f8f0; padding: 10px; border-radius: 5px; }
        .error { color: red; text-align: center; font-weight: bold; margin-bottom: 20px; background: #ffeef0; padding: 10px; border-radius: 5px; }

        @media print {
            .actions, .success, .error { display: none !important; }
            body { background: white; padding: 0; }
            .invoice-box { box-shadow: none; border: none; padding: 0; }
        }
    </style>
</head>
<body>

<div class="invoice-box">
    <?= $msg ?>
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="2">
                <table>
                    <tr>
                        <td class="title">مختبراتي</td>
                        <td style="text-align: left;">
                            رقم الفاتورة: #<?= $booking['id'] ?><br>
                            تاريخ الإصدار: <?= date('Y-m-d', strtotime($booking['created_at'])) ?><br>
                            حالة الطلب: <strong><?= $booking['status'] ?? 'قيد المعالجة' ?></strong>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="information">
            <td colspan="2">
                <table>
                    <tr>
                        <td>
                            <strong>بيانات العميل:</strong><br>
                            الاسم: <?= htmlspecialchars($booking['full_name']) ?><br>
                            الإيميل: <?= htmlspecialchars($booking['email']) ?><br>
                            الجوال: <?= htmlspecialchars($booking['phone'] ?? 'غير مسجل') ?>
                        </td>
                        <td style="text-align: left;">
                            <strong>تفاصيل الخدمة:</strong><br>
                            المدينة: <?= htmlspecialchars($booking['city']) ?><br>
                            المكان: <?= htmlspecialchars($booking['address']) ?><br>
                            الموعد: <?= htmlspecialchars($booking['appointment_date']) ?> (<?= htmlspecialchars($booking['appointment_time']) ?>)
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="heading">
            <td>وصف الفحص المطلوب</td>
            <td style="text-align: left;">السعر</td>
        </tr>

        <?php foreach($items as $item): ?>
        <tr class="item">
            <td>
                <?= htmlspecialchars($item['service_name']) ?> 
                <span style="font-size: 13px; color: #888;">(<?= htmlspecialchars($item['lab_name']) ?>)</span>
            </td>
            <td style="text-align: left;"><?= htmlspecialchars($item['price_at_booking']) ?> ريال</td>
        </tr>
        <?php endforeach; ?>

        <tr class="total">
            <td></td>
            <td style="text-align: left;">المجموع: <?= htmlspecialchars($booking['total_price']) ?> ريال</td>
        </tr>
    </table>

    <div class="actions">
        <button class="btn btn-print" onclick="window.print()">🖨️ طباعة / حفظ كـ PDF</button>
        
        <form method="POST" style="display: inline-block;">
            <button type="submit" name="send_email" class="btn btn-email">📧 إرسال للإيميل</button>
        </form>
        <br><br>
        <a href="myacct.php" class="btn btn-back">العودة للطلبات</a>
    </div>
</div>

</body>
</html>