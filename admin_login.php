<?php
session_start();
require_once 'db.php';

if (isset($_SESSION['admin_id'])) {
    header("Location: admin_dashboard.php");
    exit;
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!empty($email) && !empty($password)) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            if ($user['role'] === 'admin') {
                $_SESSION['admin_id'] = $user['id'];
                $_SESSION['admin_name'] = $user['full_name'];
                header("Location: admin_dashboard.php");
                exit;
            } else {
                $error = "عذراً، هذا الحساب لا يمتلك صلاحيات الإدارة.";
            }
        } else {
            $error = "البريد الإلكتروني أو كلمة المرور غير صحيحة.";
        }
    } else {
        $error = "الرجاء إدخال البريد الإلكتروني وكلمة المرور.";
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مختبراتي - دخول الإدارة</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f0f2f5; margin: 0; }
        .login-wrapper { display: flex; justify-content: center; align-items: center; min-height: 80vh; padding: 20px; }
        .container { background-color: #ffffff; padding: 40px 30px; border-radius: 12px; box-shadow: 0 8px 20px rgba(0,0,0,0.1); width: 100%; max-width: 400px; }
        
        .login-tabs { display: flex; margin-bottom: 25px; border-bottom: 2px solid #eee; }
        .login-tabs a { flex: 1; text-align: center; padding: 12px; text-decoration: none; color: #777; font-weight: bold; font-size: 16px; transition: 0.3s; }
        .login-tabs a.active { color: blue; border-bottom: 3px solid blue; margin-bottom: -2px; }
        .login-tabs a:hover { color: blue; }

        .msg.error { background-color: #ffeef0; color: #dc3545; border: 1px solid #dc3545; padding: 10px; margin-bottom: 15px; border-radius: 6px; text-align: center; font-size: 14px; font-weight: bold; }

        .input-group { margin-bottom: 15px; }
        .input-group label { display: block; margin-bottom: 8px; color: #555; font-size: 14px; font-weight: 600; }
        .input-group input { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; box-sizing: border-box; font-size: 14px; transition: 0.3s; }
        .input-group input:focus { border-color: blue; outline: none; box-shadow: 0 0 5px rgba(0, 0, 255, 0.1); }
        
        .btn { width: 100%; padding: 12px; background-color: blue; color: white; border: none; border-radius: 6px; cursor: pointer; font-size: 16px; font-weight: bold; margin-top: 10px; transition: 0.3s; }
        .btn:hover { background-color: darkblue; }
    </style>
</head>
<body>

    <?php include 'header.php'; ?>

    <div class="login-wrapper">
        <div class="container">
            <div class="form-box">
                <div class="login-tabs">
                    <a href="login.php">دخول العملاء</a>
                    <a href="admin_login.php" class="active">دخول الإدارة</a>
                </div>
                
                <?php if ($error): ?>
                    <div class="msg error"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>

                <form method="POST">
                    <div class="input-group">
                        <label for="email">البريد الإلكتروني</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="input-group">
                        <label for="password">كلمة المرور</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn">دخول كمسؤول</button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>