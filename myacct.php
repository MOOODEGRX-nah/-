<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) { 
    header("Location: login.php"); 
    exit(); 
}

$user_id = $_SESSION['user_id'];

if(isset($_POST['cancel'])){
    $booking_id = $_POST['booking_id'];
    try {
        $stmt = $pdo->prepare("UPDATE bookings SET status = 'ملغي' WHERE id = ? AND user_id = ?");
        $stmt->execute([$booking_id, $user_id]);
    } catch(PDOException $e) {}
}

$stmt = $pdo->prepare("
    SELECT b.*, 
           (SELECT GROUP_CONCAT(s.service_name SEPARATOR ' + ') 
            FROM booking_items bi 
            JOIN services s ON bi.service_id = s.id 
            WHERE bi.booking_id = b.id) as test_type
    FROM bookings b 
    WHERE b.user_id = ? 
    ORDER BY b.created_at DESC
");
$stmt->execute([$user_id]);
$bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>مختبراتي - طلباتي</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 0; background-color: #f3f4f6; }
        .content { max-width: 800px; margin: 40px auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        h2 { color: blue; border-bottom: 2px solid blue; padding-bottom: 10px; margin-bottom: 25px; text-align: center; }
        .booking-card { border: 1px solid #eee; padding: 20px; margin-bottom: 15px; border-radius: 8px; background: #fafafa; transition: 0.3s; }
        .booking-card:hover { border-color: #ccc; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
        .status { font-weight: bold; padding: 4px 10px; border-radius: 4px; font-size: 14px; }
        .status-processing { background: #fff3cd; color: #856404; }
        .status-cancelled { background: #f8d7da; color: #721c24; }
        .status-completed { background: #d4edda; color: #155724; }
        .cancel-btn { background: #dc3545; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; font-weight: bold; margin-top: 10px; transition: 0.3s; font-family: inherit; width: 100%; }
        .cancel-btn:hover { background: #c82333; }
        .invoice-btn { background: #0d6efd; color: white; padding: 8px 15px; border-radius: 5px; text-decoration: none; font-size: 14px; font-weight: bold; text-align: center; display: inline-block; margin-top: 15px; width: 100%; box-sizing: border-box; transition: 0.3s; }
        .invoice-btn:hover { background: #0b5ed7; }
        .empty-msg { text-align: center; color: #777; padding: 40px; }
        .back-link { display: block; text-align: center; margin-top: 20px; color: blue; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="content">
        <h2>طلباتي السابقة والحالية</h2>
        
        <?php if(count($bookings) > 0): ?>
            <?php foreach($bookings as $b): ?>
                <?php 
                    $status_class = 'status-processing';
                    $current_status = $b['status'] ?? 'قيد المعالجة';
                    if($current_status == 'ملغي') $status_class = 'status-cancelled';
                    if($current_status == 'مكتمل' || $current_status == 'تم الانتهاء') $status_class = 'status-completed';
                ?>
                <div class="booking-card">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                        <div>
                            <b style="font-size: 18px;">الفحص: <?= htmlspecialchars($b['test_type'] ?? 'غير محدد') ?></b><br>
                            <span style="color: #666; font-size: 14px;">رقم الطلب: #<?= $b['id'] ?></span><br>
                            <span style="color: #666; font-size: 14px;">تاريخ الموعد: <?= htmlspecialchars($b['appointment_date']) ?> (الوقت: <?= htmlspecialchars($b['appointment_time']) ?>)</span><br>
                            <span style="color: #666; font-size: 14px;">المكان: <?= htmlspecialchars($b['city']) ?> - <?= htmlspecialchars($b['address']) ?></span><br>
                            
                            <span style="color: #198754; font-size: 16px; font-weight: bold; margin-top: 8px; display: inline-block;">
                                السعر الإجمالي: <?= htmlspecialchars($b['total_price']) ?> ريال
                            </span>
                        </div>

                        <div style="text-align: center; min-width: 120px;">
                            <span class="status <?= $status_class ?>"><?= htmlspecialchars($current_status) ?></span><br>
                            
                            <a href="invoice.php?id=<?= $b['id'] ?>" class="invoice-btn">📄 عرض / PDF</a>
                            
                            <?php if($current_status == 'قيد المعالجة'): ?>
                                <form method="POST" onsubmit="return confirm('هل أنت متأكد من رغبتك في إلغاء هذا الطلب؟');" style="margin:0;">
                                    <input type="hidden" name="booking_id" value="<?= $b['id'] ?>">
                                    <button type="submit" name="cancel" class="cancel-btn">إلغاء الطلب</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="empty-msg">
                <p>لا توجد لديك طلبات حالياً.</p>
                <a href="labs_list.php" style="color: blue; font-weight: bold;">اطلب فحصك الأول الآن</a>
            </div>
        <?php endif; ?>
        <a href="index.php" class="back-link">العودة للرئيسية</a>
    </div>
</body>
</html>