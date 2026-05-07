<?php
session_start();
require_once 'db.php';

if ((isset($_POST['add_to_cart']) || isset($_POST['add_custom_package'])) && !isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_POST['add_to_cart'])) {
    $item = [
        'id' => uniqid(),
        'name' => htmlspecialchars($_POST['item_name']),
        'price' => floatval($_POST['item_price']),
        'lab' => htmlspecialchars($_POST['lab_name'])
    ];
    $_SESSION['cart'][] = $item;
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
}

if (isset($_POST['add_custom_package'])) {
    if (!empty($_POST['custom_tests'])) {
        foreach ($_POST['custom_tests'] as $test) {
            $parts = explode('|', $test);
            if (count($parts) == 2) {
                $item = [
                    'id' => uniqid(),
                    'name' => htmlspecialchars($parts[0]), 
                    'price' => floatval($parts[1]),        
                    'lab' => htmlspecialchars($_POST['lab_name'])
                ];
                $_SESSION['cart'][] = $item;
            }
        }
    }
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
}

if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] === $remove_id) {
            unset($_SESSION['cart'][$key]);
            break;
        }
    }
    $_SESSION['cart'] = array_values($_SESSION['cart']);
    header("Location: cart.php");
    exit;
}

$total_price = 0;
foreach ($_SESSION['cart'] as $item) {
    $total_price += $item['price'];
}

$msg = "";
if (isset($_POST['checkout'])) {
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
    }

    $city = htmlspecialchars($_POST['city']);
    $address = htmlspecialchars($_POST['address']);
    $date = htmlspecialchars($_POST['appointment_date']);
    $time = htmlspecialchars($_POST['appointment_time']);

    if (!empty($_SESSION['cart']) && !empty($city) && !empty($address) && !empty($date) && !empty($time)) {
        try {
            $pdo->beginTransaction();
            
            $stmt = $pdo->prepare("INSERT INTO bookings (user_id, total_price, city, address, appointment_date, appointment_time, status) VALUES (?, ?, ?, ?, ?, ?, 'قيد المعالجة')");
            $stmt->execute([$_SESSION['user_id'], $total_price, $city, $address, $date, $time]);
            $booking_id = $pdo->lastInsertId(); 
            
            $findServiceStmt = $pdo->prepare("SELECT s.id FROM services s JOIN labs l ON s.lab_id = l.id WHERE s.service_name LIKE ? AND l.name LIKE ? LIMIT 1");
            $insertItemStmt = $pdo->prepare("INSERT INTO booking_items (booking_id, service_id, price_at_booking) VALUES (?, ?, ?)");
            
            foreach ($_SESSION['cart'] as $item) {
                $findServiceStmt->execute(['%'.$item['name'].'%', '%'.$item['lab'].'%']);
                $service = $findServiceStmt->fetch(PDO::FETCH_ASSOC);
                
                if ($service) {
                    $insertItemStmt->execute([$booking_id, $service['id'], $item['price']]);
                } else {
                    throw new Exception("الفحص '{$item['name']}' غير مسجل في قاعدة بيانات مختبر '{$item['lab']}'.");
                }
            }
            
            $pdo->commit();
            $_SESSION['cart'] = []; 
            $msg = "<div class='success-msg'>تم تأكيد طلبك بنجاح! سيتم تحويلك لصفحة طلباتي...</div>";
            header("refresh:2;url=myacct.php");
        } catch (Exception $e) {
            $pdo->rollBack();
            $msg = "<div class='error-msg'>حدث خطأ أثناء الطلب: " . $e->getMessage() . "</div>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>مختبراتي - سلة الفحوصات</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, sans-serif; background: #f5f7fa; margin: 0; }
        .container { width: 85%; max-width: 900px; margin: 40px auto; display: flex; gap: 30px; align-items: flex-start; flex-wrap: wrap; }
        .cart-items { flex: 2; background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); min-width: 300px; }
        .checkout-form { flex: 1; background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); min-width: 300px; }
        h2 { color: blue; border-bottom: 2px solid #eee; padding-bottom: 15px; margin-top: 0; }
        .cart-item { display: flex; justify-content: space-between; align-items: center; padding: 15px 0; border-bottom: 1px solid #eee; }
        .item-details h4 { margin: 0 0 5px 0; color: #333; font-size: 18px; }
        .item-details p { margin: 0; color: #777; font-size: 14px; }
        .item-price { font-weight: bold; color: green; font-size: 18px; }
        .remove-btn { color: red; text-decoration: none; font-size: 14px; font-weight: bold; padding: 5px 10px; background: #ffeef0; border-radius: 5px; }
        .remove-btn:hover { background: #ffcdd2; }
        .total-row { display: flex; justify-content: space-between; font-size: 20px; font-weight: bold; margin-top: 20px; padding-top: 20px; border-top: 2px solid #333; }
        label { display: block; font-weight: bold; margin-bottom: 5px; margin-top: 15px; color: #333; }
        input, select { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box; font-family: inherit; }
        input[readonly] { background-color: #e9ecef; color: #495057; cursor: not-allowed; border-color: #ced4da; }
        .btn-checkout { background: green; color: white; border: none; width: 100%; padding: 12px; border-radius: 8px; font-size: 18px; font-weight: bold; cursor: pointer; margin-top: 20px; transition: 0.3s; }
        .btn-checkout:hover { background: darkgreen; }
        .empty-cart { text-align: center; color: #777; padding: 40px; }
        .success-msg { color: green; background: #e6f8f0; padding: 10px; border-radius: 5px; text-align: center; margin-bottom: 15px; font-weight: bold; }
        .error-msg { color: red; background: #ffeef0; padding: 10px; border-radius: 5px; text-align: center; margin-bottom: 15px; font-weight: bold; }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <div class="cart-items">
            <h2>سلة الفحوصات</h2>
            <?php if (empty($_SESSION['cart'])): ?>
                <div class="empty-cart">
                    <p>السلة فارغة حالياً.</p>
                    <a href="labs_list.php" style="color: blue; font-weight: bold;">تصفح المختبرات</a>
                </div>
            <?php else: ?>
                <?php foreach ($_SESSION['cart'] as $item): ?>
                    <div class="cart-item">
                        <div class="item-details">
                            <h4><?= $item['name'] ?></h4>
                            <p><?= $item['lab'] ?></p>
                        </div>
                        <div style="text-align: left;">
                            <div class="item-price"><?= $item['price'] ?> ريال</div>
                            <br>
                            <a href="cart.php?remove=<?= $item['id'] ?>" class="remove-btn">حذف</a>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="total-row">
                    <span>الإجمالي:</span>
                    <span style="color: blue;"><?= $total_price ?> ريال</span>
                </div>
            <?php endif; ?>
        </div>

        <?php if (!empty($_SESSION['cart'])): ?>
            <div class="checkout-form">
                <h2>إتمام الحجز</h2>
                <?= $msg ?>
                <form method="POST">
                    
                    <label>المدينة</label>
                    <input type="text" name="city" value="مكة المكرمة" readonly>
                    
                    <label>الحي</label>
                    <select name="address" required>
                        <option value="" disabled selected>اختر الحي...</option>
                        <option value="العزيزية">العزيزية</option>
                        <option value="الشوقية">الشوقية</option>
                        <option value="بطحاء قريش">بطحاء قريش</option>
                        <option value="الشرائع">الشرائع</option>
                        <option value="العوالي">العوالي</option>
                        <option value="النوارية">النوارية</option>
                        <option value="الزاهر">الزاهر</option>
                        <option value="الكعكية">الكعكية</option>
                        <option value="ولي العهد">ولي العهد</option>
                        <option value="الحسينية">الحسينية</option>
                    </select>

                    <label>تاريخ الموعد المفضل</label>
                    <input type="date" name="appointment_date" required>

                    <label>الوقت المفضل</label>
                    <input type="time" name="appointment_time" required>

                    <button type="submit" name="checkout" class="btn-checkout">تأكيد الطلب (<?= $total_price ?> ريال)</button>
                </form>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>