<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }
$user_id = $_SESSION['user_id'];
$status_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    try {
        $stmt = $pdo->prepare("UPDATE users SET full_name=?, phone=?, city=?, address=? WHERE id=?");
        $stmt->execute([
            htmlspecialchars($_POST['fullname']), 
            htmlspecialchars($_POST['phone']), 
            htmlspecialchars($_POST['city']), 
            htmlspecialchars($_POST['address']), 
            $user_id
        ]);
        $_SESSION['user_name'] = $_POST['fullname'];
        $status_msg = "success";
    } catch(PDOException $e) { $status_msg = "error"; }
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user_data = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>مختبراتي - الملف الشخصي</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, sans-serif; background-color: #f4f7f6; margin: 0; }
        .profile-container { max-width: 600px; margin: 50px auto; background: white; padding: 30px; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); position: relative; }
        

        .action-buttons { position: absolute; left: 20px; top: 25px; display: flex; gap: 10px; }
        
        .edit-icon-btn { background: #007bff; color: white; border: none; padding: 8px 15px; border-radius: 20px; cursor: pointer; font-size: 14px; font-weight: bold; transition: 0.3s; font-family: inherit; }
        .edit-icon-btn:hover { background: #0056b3; }

        .logout-icon-btn { background: #dc3545; color: white; border: none; padding: 8px 15px; border-radius: 20px; cursor: pointer; font-size: 14px; font-weight: bold; transition: 0.3s; font-family: inherit; }
        .logout-icon-btn:hover { background: #c82333; }

        h2 { color: #333; border-bottom: 2px solid #eee; padding-bottom: 15px; margin-bottom: 25px; font-size: 22px; }

        .info-row { margin-bottom: 20px; padding-bottom: 10px; border-bottom: 1px solid #fafafa; }
        .info-row label { display: block; color: #888; font-size: 13px; margin-bottom: 5px; }
        .info-row .value { display: block; color: #333; font-size: 16px; font-weight: 500; min-height: 24px; }

        .edit-input { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px; display: none; font-family: inherit; box-sizing: border-box; }
        
        .save-btn { background: #28a745; color: white; border: none; padding: 12px; border-radius: 8px; width: 100%; font-weight: bold; cursor: pointer; display: none; margin-top: 20px; font-family: inherit; font-size: 16px; }
        
        .msg-success { background: #d4edda; color: #155724; padding: 10px; border-radius: 8px; text-align: center; margin-bottom: 20px; }
    </style>
</head>
<body>

    <?php include 'header.php'; ?>

    <div class="profile-container" id="profileCard">
        
        <div class="action-buttons">
            <button type="button" class="edit-icon-btn" id="editBtn" onclick="enableEdit()">تعديل البيانات</button>
            <form action="login.php" method="POST" style="margin: 0; padding: 0;">
                <button type="submit" name="logout" class="logout-icon-btn">خروج</button>
            </form>
        </div>

        <h2>بياناتي الشخصية</h2>

        <?php if ($status_msg === "success"): ?>
            <div class="msg-success">تم تحديث البيانات بنجاح!</div>
        <?php endif; ?>

        <form method="POST" id="profileForm">
            <div class="info-row">
                <label>الاسم الكامل</label>
                <span class="value" id="val_name"><?= htmlspecialchars($user_data['full_name']) ?></span>
                <input type="text" name="fullname" class="edit-input" id="in_name" value="<?= htmlspecialchars($user_data['full_name']) ?>" required>
            </div>

            <div class="info-row">
                <label>رقم الجوال</label>
                <span class="value" id="val_phone"><?= htmlspecialchars($user_data['phone'] ?? 'غير مسجل') ?></span>
                <input type="text" name="phone" class="edit-input" id="in_phone" value="<?= htmlspecialchars($user_data['phone'] ?? '') ?>">
            </div>

            <div class="info-row">
                <label>المدينة</label>
                <span class="value" id="val_city"><?= htmlspecialchars($user_data['city'] ?? 'غير مسجل') ?></span>
                <input type="text" name="city" class="edit-input" id="in_city" value="<?= htmlspecialchars($user_data['city'] ?? '') ?>">
            </div>

            <div class="info-row">
                <label>العنوان بالتفصيل</label>
                <span class="value" id="val_addr"><?= htmlspecialchars($user_data['address'] ?? 'غير مسجل') ?></span>
                <textarea name="address" class="edit-input" id="in_addr" rows="3"><?= htmlspecialchars($user_data['address'] ?? '') ?></textarea>
            </div>

            <button type="submit" name="update" class="save-btn" id="saveBtn">حفظ التغييرات الجديدة</button>
        </form>
    </div>

    <script>
        function enableEdit() {

            document.querySelectorAll('.value').forEach(el => el.style.display = 'none');
            document.querySelectorAll('.edit-input').forEach(el => el.style.display = 'block');
            

            document.getElementById('editBtn').style.display = 'none';
            document.getElementById('saveBtn').style.display = 'block';
        }
    </script>

</body>
</html>