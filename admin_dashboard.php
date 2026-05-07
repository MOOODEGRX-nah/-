<?php
session_start();
require_once 'db.php';

// التحقق من صلاحيات الإدارة
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

$lang = $_SESSION['admin_lang'] ?? 'ar';

// ==============================
// نصوص الترجمة (لغتين)
// ==============================
$t = [
    'ar' => [
        'dashboard' => 'لوحة التحكم',
        'logout' => 'تسجيل خروج',
        'overview' => 'نظرة عامة',
        'schedule' => 'الجداول والمواعيد',
        'pricing' => 'إدارة الأسعار',
        'labs' => 'إدارة المختبرات',
        'orders' => 'إدارة الطلبات',
        'contacts' => 'رسائل التواصل',
        'total_orders' => 'إجمالي الطلبات',
        'pending' => 'قيد المعالجة',
        'completed' => 'مكتملة',
        'cancelled' => 'ملغية',
        'revenue' => 'إجمالي الإيرادات',
        'sar' => 'ريال',
        'save' => 'حفظ التغييرات',
        'add_lab' => 'إضافة مختبر جديد',
        'lab_name' => 'اسم المختبر',
        'lab_location' => 'الموقع (الحي أو الشارع)',
        'lab_phone' => 'رقم الهاتف',
        'edit' => 'تعديل',
        'delete' => 'حذف',
        'available_days' => 'الأيام المتاحة',
        'available_times' => 'الأوقات المتاحة (فترات العمل)',
        'add_slot' => 'إضافة فترة',
        'time_from' => 'من',
        'time_to' => 'إلى',
        'service_name' => 'اسم الفحص / الخدمة',
        'price' => 'السعر',
        'update_price' => 'تحديث السعر',
        'order_id' => 'رقم الطلب',
        'customer' => 'العميل',
        'date' => 'التاريخ والوقت',
        'status' => 'الحالة',
        'actions' => 'الإجراءات',
        'view_invoice' => 'الفاتورة',
        'settings_saved' => 'تم حفظ الإعدادات بنجاح',
        'welcome' => 'أهلاً بك،',
        'no_data' => 'لا توجد بيانات لعرضها حالياً',
        'days_sun' => 'الأحد',
        'days_mon' => 'الاثنين',
        'days_tue' => 'الثلاثاء',
        'days_wed' => 'الأربعاء',
        'days_thu' => 'الخميس',
        'days_fri' => 'الجمعة',
        'days_sat' => 'السبت',
        'lab_added' => 'تم إضافة المختبر بنجاح',
        'price_updated' => 'تم تحديث السعر بنجاح',
        'order_updated' => 'تم تحديث حالة الطلب',
    ],
    'en' => [
        'dashboard' => 'Dashboard',
        'logout' => 'Logout',
        'overview' => 'Overview',
        'schedule' => 'Schedule',
        'pricing' => 'Pricing',
        'labs' => 'Labs',
        'orders' => 'Orders',
        'contacts' => 'Messages',
        'total_orders' => 'Total Orders',
        'pending' => 'Pending',
        'completed' => 'Completed',
        'cancelled' => 'Cancelled',
        'revenue' => 'Total Revenue',
        'sar' => 'SAR',
        'save' => 'Save Changes',
        'add_lab' => 'Add New Lab',
        'lab_name' => 'Lab Name',
        'lab_location' => 'Location',
        'lab_phone' => 'Phone',
        'edit' => 'Edit',
        'delete' => 'Delete',
        'available_days' => 'Available Days',
        'available_times' => 'Available Time Slots',
        'add_slot' => 'Add Slot',
        'time_from' => 'From',
        'time_to' => 'To',
        'service_name' => 'Service Name',
        'price' => 'Price',
        'update_price' => 'Update Price',
        'order_id' => 'Order #',
        'customer' => 'Customer',
        'date' => 'Date & Time',
        'status' => 'Status',
        'actions' => 'Actions',
        'view_invoice' => 'Invoice',
        'settings_saved' => 'Settings saved successfully',
        'welcome' => 'Welcome,',
        'no_data' => 'No data available',
        'days_sun' => 'Sunday',
        'days_mon' => 'Monday',
        'days_tue' => 'Tuesday',
        'days_wed' => 'Wednesday',
        'days_thu' => 'Thursday',
        'days_fri' => 'Friday',
        'days_sat' => 'Saturday',
        'lab_added' => 'Lab added successfully',
        'price_updated' => 'Price updated successfully',
        'order_updated' => 'Order status updated',
    ]
];

$_ = $t[$lang];
$dir = $lang === 'ar' ? 'rtl' : 'ltr';
$msg = "";
$msgType = "success";

// ==============================
// معالجة الأوامر (Actions)
// ==============================

// تغيير اللغة
if (isset($_GET['lang'])) {
    $_SESSION['admin_lang'] = in_array($_GET['lang'], ['ar','en']) ? $_GET['lang'] : 'ar';
    header("Location: admin_dashboard.php?tab=" . ($_GET['tab'] ?? 'overview'));
    exit;
}

// تسجيل الخروج
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: admin_login.php");
    exit;
}

// حفظ الجداول والمواعيد
if (isset($_POST['save_schedule'])) {
    $days = $_POST['available_days'] ?? [];
    $slots = $_POST['time_slots'] ?? [];
    $schedule_data = json_encode(['days' => $days, 'slots' => $slots]);
    
    try {
        $stmt = $pdo->prepare("INSERT INTO admin_settings (`key`, `value`) VALUES ('schedule', ?) ON DUPLICATE KEY UPDATE `value` = ?");
        $stmt->execute([$schedule_data, $schedule_data]);
        $msg = $_['settings_saved'];
    } catch (Exception $e) {
        $pdo->exec("CREATE TABLE IF NOT EXISTS admin_settings (`key` VARCHAR(100) PRIMARY KEY, `value` TEXT)");
        $stmt = $pdo->prepare("INSERT INTO admin_settings (`key`, `value`) VALUES ('schedule', ?) ON DUPLICATE KEY UPDATE `value` = ?");
        $stmt->execute([$schedule_data, $schedule_data]);
        $msg = $_['settings_saved'];
    }
}

// تحديث حالة الطلب
if (isset($_POST['update_order'])) {
    $oid = intval($_POST['order_id']);
    $new_status = htmlspecialchars($_POST['new_status']);
    $pdo->prepare("UPDATE bookings SET status=? WHERE id=?")->execute([$new_status, $oid]);
    $msg = $_['order_updated'];
}

// تحديث سعر الفحص
if (isset($_POST['update_price'])) {
    $sid = intval($_POST['service_id']);
    $new_price = floatval($_POST['new_price']);
    $pdo->prepare("UPDATE services SET price=? WHERE id=?")->execute([$new_price, $sid]);
    $msg = $_['price_updated'];
}

// إضافة مختبر جديد
if (isset($_POST['add_lab'])) {
    $lab_name  = htmlspecialchars($_POST['lab_name_new']);
    $lab_loc   = htmlspecialchars($_POST['lab_location']);
    $lab_phone = htmlspecialchars($_POST['lab_phone']);
    $pdo->prepare("INSERT INTO labs (name, city, address, phone) VALUES (?, 'مكة المكرمة', ?, ?)")->execute([$lab_name, $lab_loc, $lab_phone]);
    $msg = $_['lab_added'];
}

// ==============================
// جلب البيانات للعرض (Fetch Data)
// ==============================

// الإحصائيات
try {
    $total    = $pdo->query("SELECT COUNT(*) FROM bookings")->fetchColumn();
    $pend     = $pdo->query("SELECT COUNT(*) FROM bookings WHERE status='قيد المعالجة'")->fetchColumn();
    $done     = $pdo->query("SELECT COUNT(*) FROM bookings WHERE status='مكتمل' OR status='تم الانتهاء'")->fetchColumn();
    $canc     = $pdo->query("SELECT COUNT(*) FROM bookings WHERE status='ملغي'")->fetchColumn();
    $revenue  = $pdo->query("SELECT COALESCE(SUM(total_price),0) FROM bookings WHERE status!='ملغي'")->fetchColumn();
} catch (Exception $e) { $total = $pend = $done = $canc = $revenue = 0; }

// الطلبات
try {
    $orders = $pdo->query("
        SELECT b.id, b.appointment_date, b.appointment_time, b.status, b.total_price, b.city, b.address,
               u.full_name, u.phone,
               (SELECT GROUP_CONCAT(s.service_name SEPARATOR ' + ') FROM booking_items bi JOIN services s ON bi.service_id=s.id WHERE bi.booking_id=b.id) as tests
        FROM bookings b JOIN users u ON b.user_id=u.id
        ORDER BY b.created_at DESC LIMIT 100
    ")->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) { $orders = []; }

// الفحوصات للأسعار
try {
    $services = $pdo->query("SELECT s.id, s.service_name, s.price, l.name as lab_name FROM services s JOIN labs l ON s.lab_id=l.id ORDER BY l.name, s.service_name")->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) { $services = []; }

// المختبرات
try {
    $labs = $pdo->query("SELECT * FROM labs ORDER BY id")->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) { $labs = []; }

// الرسائل
try {
    $contacts = $pdo->query("SELECT * FROM contact_messages ORDER BY created_at DESC LIMIT 50")->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) { $contacts = []; }

// جدول المواعيد
try {
    $sched_row = $pdo->query("SELECT value FROM admin_settings WHERE `key`='schedule'")->fetch();
    $schedule = $sched_row ? json_decode($sched_row['value'], true) : ['days'=>[], 'slots'=>[]];
} catch (Exception $e) { $schedule = ['days'=>[], 'slots'=>[]]; }

$active_tab = $_GET['tab'] ?? 'overview';
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>" dir="<?= $dir ?>">
<head>
    <meta charset="UTF-8">
    <title><?= $_['dashboard'] ?> - مختبراتي</title>
    <style>
        /* مطابقة لتصميم الموقع الأساسي */
        body { font-family: 'Segoe UI', Tahoma, sans-serif; background: #f5f7fa; margin: 0; }
        
        .admin-layout { display: flex; max-width: 1200px; margin: 40px auto; gap: 30px; padding: 0 20px; align-items: flex-start; }
        
        /* القائمة الجانبية (Sidebar) */
        .admin-sidebar { width: 250px; background: white; border-radius: 15px; padding: 20px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); }
        .admin-sidebar h3 { color: blue; margin-top: 0; border-bottom: 2px solid #eee; padding-bottom: 15px; }
        .admin-sidebar a { display: block; padding: 12px 15px; margin-bottom: 8px; color: #555; text-decoration: none; border-radius: 8px; font-weight: bold; transition: 0.3s; }
        .admin-sidebar a:hover { background: #f0f4f8; color: blue; }
        .admin-sidebar a.active { background: blue; color: white; }
        .badge { background: red; color: white; padding: 2px 8px; border-radius: 20px; font-size: 12px; float: <?= $lang==='ar'?'left':'right' ?>; }
        
        .lang-switch { margin-top: 20px; border-top: 2px solid #eee; padding-top: 15px; display: flex; gap: 10px; }
        .lang-switch a { padding: 8px; text-align: center; background: #eee; flex: 1; }
        
        /* المحتوى الرئيسي (Main Content) */
        .admin-content { flex: 1; background: white; border-radius: 15px; padding: 30px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); min-width: 0; }
        .admin-content h2 { color: #333; margin-top: 0; margin-bottom: 25px; }
        
        /* الإحصائيات (Stats) */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 20px; margin-bottom: 30px; }
        .stat-card { padding: 20px; border-radius: 10px; text-align: center; border: 1px solid #eee; background: #fafafa; }
        .stat-card h3 { margin: 0; font-size: 28px; color: blue; }
        .stat-card p { margin: 5px 0 0 0; color: #666; font-weight: bold; font-size: 14px; }
        
        /* الجداول (Tables) */
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border-bottom: 1px solid #eee; padding: 12px; text-align: <?= $lang==='ar'?'right':'left' ?>; font-size: 14px; }
        th { color: blue; background: #f9f9f9; }
        
        /* النماذج والأزرار */
        label { display: block; font-weight: bold; margin-bottom: 8px; color: #333; margin-top: 15px; }
        input[type="text"], input[type="number"], input[type="time"], select { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box; font-family: inherit; }
        .btn { padding: 10px 20px; background: blue; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: bold; transition: 0.3s; text-decoration: none; display: inline-block; }
        .btn:hover { background: darkblue; }
        .btn-green { background: #198754; color: white; }
        .btn-green:hover { background: #157347; }
        .btn-red { background: #dc3545; color: white; }
        
        /* التنبيهات */
        .msg { padding: 12px; border-radius: 6px; text-align: center; font-weight: bold; margin-bottom: 20px; }
        .msg.success { background: #e6f8f0; color: #198754; }
        
        /* تخصيصات للتبويبات */
        .days-container { display: flex; flex-wrap: wrap; gap: 10px; }
        .days-container label { display: inline-block; background: #f0f0f0; padding: 10px 15px; border-radius: 6px; cursor: pointer; margin: 0; border: 1px solid #ddd; }
        .days-container input:checked + label { background: blue; color: white; border-color: blue; }
        .days-container input { display: none; }
        .slot-row { display: flex; gap: 10px; align-items: center; margin-bottom: 10px; background: #fafafa; padding: 10px; border-radius: 6px; border: 1px solid #eee; }
        
        .contact-card { border: 1px solid #eee; padding: 15px; border-radius: 8px; margin-bottom: 15px; background: #fafafa; }
    </style>
</head>
<body>

    <!-- الهيدر الأساسي للموقع -->
    <?php include 'header.php'; ?>

    <div class="admin-layout">
        
        <!-- القائمة الجانبية -->
        <aside class="admin-sidebar">
            <h3><?= $_['welcome'] ?> <?= htmlspecialchars($_SESSION['admin_name']) ?></h3>
            <a href="?tab=overview" class="<?= $active_tab==='overview'?'active':'' ?>">📊 <?= $_['overview'] ?></a>
            <a href="?tab=schedule" class="<?= $active_tab==='schedule'?'active':'' ?>">📅 <?= $_['schedule'] ?></a>
            <a href="?tab=pricing" class="<?= $active_tab==='pricing'?'active':'' ?>">💰 <?= $_['pricing'] ?></a>
            <a href="?tab=labs" class="<?= $active_tab==='labs'?'active':'' ?>">🏥 <?= $_['labs'] ?></a>
            <a href="?tab=orders" class="<?= $active_tab==='orders'?'active':'' ?>">📦 <?= $_['orders'] ?> <?php if($pend>0) echo "<span class='badge'>$pend</span>"; ?></a>
            <a href="?tab=contacts" class="<?= $active_tab==='contacts'?'active':'' ?>">✉️ <?= $_['contacts'] ?> <?php if(count($contacts)>0) echo "<span class='badge'>".count($contacts)."</span>"; ?></a>
            
            <div class="lang-switch">
                <a href="?lang=ar&tab=<?= $active_tab ?>" style="background: <?= $lang==='ar'?'#ccc':'#eee' ?>;">AR</a>
                <a href="?lang=en&tab=<?= $active_tab ?>" style="background: <?= $lang==='en'?'#ccc':'#eee' ?>;">EN</a>
            </div>
            <a href="?logout=1" style="color: #dc3545; margin-top: 10px;">🚪 <?= $_['logout'] ?></a>
        </aside>

        <!-- المحتوى الرئيسي -->
        <main class="admin-content">
            
            <?php if ($msg): ?>
                <div class="msg <?= $msgType ?>"><?= htmlspecialchars($msg) ?></div>
            <?php endif; ?>

            <!-- تبويب: نظرة عامة -->
            <?php if ($active_tab === 'overview'): ?>
                <h2><?= $_['overview'] ?></h2>
                <div class="stats-grid">
                    <div class="stat-card"><h3><?= number_format($total) ?></h3><p><?= $_['total_orders'] ?></p></div>
                    <div class="stat-card"><h3><?= number_format($pend) ?></h3><p style="color: orange;"><?= $_['pending'] ?></p></div>
                    <div class="stat-card"><h3><?= number_format($done) ?></h3><p style="color: green;"><?= $_['completed'] ?></p></div>
                    <div class="stat-card"><h3><?= number_format($revenue) ?></h3><p style="color: blue;"><?= $_['revenue'] ?> (<?= $_['sar'] ?>)</p></div>
                </div>
                <h3><?= $lang==='ar' ? 'أحدث الطلبات' : 'Recent Orders' ?></h3>
                <table>
                    <tr><th><?= $_['order_id'] ?></th><th><?= $_['customer'] ?></th><th><?= $_['status'] ?></th><th><?= $_['price'] ?></th></tr>
                    <?php foreach (array_slice($orders, 0, 5) as $o): ?>
                        <tr>
                            <td>#<?= $o['id'] ?></td>
                            <td><?= htmlspecialchars($o['full_name']) ?></td>
                            <td style="font-weight:bold; color: <?= str_contains($o['status'],'مكتمل')?'green':(str_contains($o['status'],'ملغي')?'red':'orange') ?>;"><?= htmlspecialchars($o['status']) ?></td>
                            <td><?= $o['total_price'] ?> <?= $_['sar'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>

            <!-- تبويب: الجداول والمواعيد -->
            <?php if ($active_tab === 'schedule'): ?>
                <h2><?= $_['schedule'] ?></h2>
                <form method="POST">
                    <label><?= $_['available_days'] ?></label>
                    <div class="days-container">
                        <?php
                        $days_keys = ['sun','mon','tue','wed','thu','fri','sat'];
                        $days_labels = [$_['days_sun'],$_['days_mon'],$_['days_tue'],$_['days_wed'],$_['days_thu'],$_['days_fri'],$_['days_sat']];
                        foreach ($days_keys as $i => $dk):
                            $checked = in_array($dk, $schedule['days'] ?? []) ? 'checked' : '';
                        ?>
                            <div>
                                <input type="checkbox" name="available_days[]" value="<?= $dk ?>" id="day_<?= $dk ?>" <?= $checked ?>>
                                <label for="day_<?= $dk ?>"><?= $days_labels[$i] ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <label><?= $_['available_times'] ?> <button type="button" class="btn btn-green" style="padding: 5px 10px; font-size:12px; float:<?= $lang==='ar'?'left':'right' ?>" onclick="addSlot()">+ <?= $_['add_slot'] ?></button></label>
                    <div id="slotsList">
                        <?php foreach (($schedule['slots'] ?? []) as $i => $slot): ?>
                            <div class="slot-row">
                                <?= $_['time_from'] ?>: <input type="time" name="time_slots[<?= $i ?>][from]" value="<?= htmlspecialchars($slot['from'] ?? '') ?>" style="width: auto;">
                                <?= $_['time_to'] ?>: <input type="time" name="time_slots[<?= $i ?>][to]" value="<?= htmlspecialchars($slot['to'] ?? '') ?>" style="width: auto;">
                                <button type="button" class="btn btn-red" onclick="this.parentElement.remove()">X</button>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <button type="submit" name="save_schedule" class="btn" style="margin-top: 20px;"><?= $_['save'] ?></button>
                </form>

                <script>
                    let slotIdx = <?= count($schedule['slots'] ?? []) ?>;
                    function addSlot() {
                        const list = document.getElementById('slotsList');
                        const row = document.createElement('div');
                        row.className = 'slot-row';
                        row.innerHTML = `<?= $_['time_from'] ?>: <input type="time" name="time_slots[${slotIdx}][from]" value="08:00" style="width: auto;"> <?= $_['time_to'] ?>: <input type="time" name="time_slots[${slotIdx}][to]" value="12:00" style="width: auto;"> <button type="button" class="btn btn-red" onclick="this.parentElement.remove()">X</button>`;
                        list.appendChild(row);
                        slotIdx++;
                    }
                </script>
            <?php endif; ?>

            <!-- تبويب: إدارة الأسعار -->
            <?php if ($active_tab === 'pricing'): ?>
                <h2><?= $_['pricing'] ?></h2>
                <table>
                    <tr><th><?= $_['service_name'] ?></th><th><?= $lang==='ar'?'المختبر':'Lab' ?></th><th><?= $_['price'] ?> (<?= $_['sar'] ?>)</th><th><?= $_['actions'] ?></th></tr>
                    <?php foreach ($services as $svc): ?>
                        <tr>
                            <td><?= htmlspecialchars($svc['service_name']) ?></td>
                            <td><?= htmlspecialchars($svc['lab_name']) ?></td>
                            <td>
                                <form method="POST" style="display:flex; gap:10px;">
                                    <input type="hidden" name="service_id" value="<?= $svc['id'] ?>">
                                    <input type="number" name="new_price" value="<?= $svc['price'] ?>" step="0.01" style="width: 100px; padding: 5px;">
                                    <button type="submit" name="update_price" class="btn btn-green" style="padding: 5px 10px;">✓</button>
                                </form>
                            </td>
                            <td>-</td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>

            <!-- تبويب: المختبرات -->
            <?php if ($active_tab === 'labs'): ?>
                <h2><?= $_['labs'] ?></h2>
                <table>
                    <tr><th>#</th><th><?= $_['lab_name'] ?></th><th><?= $_['lab_location'] ?></th><th><?= $_['lab_phone'] ?></th></tr>
                    <?php foreach ($labs as $lab): ?>
                        <tr><td><?= $lab['id'] ?></td><td><?= htmlspecialchars($lab['name']) ?></td><td><?= htmlspecialchars($lab['address'] ?? '') ?></td><td><?= htmlspecialchars($lab['phone'] ?? '') ?></td></tr>
                    <?php endforeach; ?>
                </table>
                
                <h3 style="margin-top: 30px; border-top: 2px solid #eee; padding-top: 20px;">+ <?= $_['add_lab'] ?></h3>
                <form method="POST" style="max-width: 500px;">
                    <label><?= $_['lab_name'] ?></label> <input type="text" name="lab_name_new" required>
                    <label><?= $_['lab_location'] ?></label> <input type="text" name="lab_location">
                    <label><?= $_['lab_phone'] ?></label> <input type="text" name="lab_phone">
                    <button type="submit" name="add_lab" class="btn" style="margin-top: 15px;"><?= $_['add_lab'] ?></button>
                </form>
            <?php endif; ?>

            <!-- تبويب: الطلبات -->
            <?php if ($active_tab === 'orders'): ?>
                <h2><?= $_['orders'] ?></h2>
                <table>
                    <tr><th><?= $_['order_id'] ?></th><th><?= $_['customer'] ?></th><th><?= $_['date'] ?></th><th><?= $_['price'] ?></th><th><?= $_['status'] ?></th><th><?= $_['actions'] ?></th></tr>
                    <?php foreach ($orders as $o): ?>
                        <tr>
                            <td>#<?= $o['id'] ?></td>
                            <td><b><?= htmlspecialchars($o['full_name']) ?></b><br><small><?= htmlspecialchars($o['phone']??'') ?></small></td>
                            <td><?= htmlspecialchars($o['appointment_date']) ?><br><small><?= htmlspecialchars($o['appointment_time']) ?></small></td>
                            <td style="color: green; font-weight: bold;"><?= $o['total_price'] ?> <?= $_['sar'] ?></td>
                            <td>
                                <form method="POST" style="display:flex; gap:5px;">
                                    <input type="hidden" name="order_id" value="<?= $o['id'] ?>">
                                    <select name="new_status" style="padding: 5px; width: auto;">
                                        <option value="قيد المعالجة" <?= $o['status']==='قيد المعالجة'?'selected':'' ?>><?= $lang==='ar'?'⏳ قيد المعالجة':'Pending' ?></option>
                                        <option value="مكتمل" <?= ($o['status']==='مكتمل'||$o['status']==='تم الانتهاء')?'selected':'' ?>><?= $lang==='ar'?'✅ مكتمل':'Done' ?></option>
                                        <option value="ملغي" <?= $o['status']==='ملغي'?'selected':'' ?>><?= $lang==='ar'?'❌ ملغي':'Cancelled' ?></option>
                                    </select>
                                    <button type="submit" name="update_order" class="btn btn-green" style="padding: 5px;">✓</button>
                                </form>
                            </td>
                            <td><a href="invoice.php?id=<?= $o['id'] ?>" class="btn" style="padding: 5px 10px;" target="_blank"><?= $_['view_invoice'] ?></a></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>

            <!-- تبويب: رسائل التواصل -->
            <?php if ($active_tab === 'contacts'): ?>
                <h2><?= $_['contacts'] ?></h2>
                <?php if (empty($contacts)): ?>
                    <p style="text-align: center; color: #777; padding: 20px;"><?= $_['no_data'] ?></p>
                <?php else: ?>
                    <?php foreach ($contacts as $c): ?>
                        <div class="contact-card">
                            <div style="display: flex; justify-content: space-between;">
                                <b><?= htmlspecialchars($c['name']) ?> (<a href="mailto:<?= htmlspecialchars($c['email']) ?>"><?= htmlspecialchars($c['email']) ?></a>)</b>
                                <small style="color: #888;"><?= htmlspecialchars($c['created_at'] ?? '') ?></small>
                            </div>
                            <p style="margin-top: 10px; color: #444; line-height: 1.6;"><?= nl2br(htmlspecialchars($c['message'])) ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endif; ?>

        </main>
    </div>

</body>
</html>