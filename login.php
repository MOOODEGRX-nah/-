<?php
session_start();

$host = 'sql209.infinityfree.com';
$dbname = 'if0_41582905_my_website';
$username = 'if0_41582905';
$password = 'YrAulJXbozzmq'; 

$message = '';      
$messageType = '';     

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("خطأ في الاتصال: " . $e->getMessage());
}

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'signup') {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $pass = $_POST['password'];

        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        
        if ($stmt->rowCount() > 0) {
            $message = "البريد الإلكتروني مسجل بالفعل!";
            $messageType = "error";
        } else {
            $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
            $insertStmt = $pdo->prepare("INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)");
            if ($insertStmt->execute([$name, $email, $hashed_password])) {
                $message = "تم إنشاء الحساب بنجاح! يمكنك تسجيل الدخول الآن.";
                $messageType = "success";
                $_GET['action'] = 'login';     
            }
        }
    }
    elseif ($action === 'login') {
        $email = trim($_POST['email']);
        $pass = $_POST['password'];

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

       if ($user && password_verify($pass, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['full_name'];
            header("Location: index.php");
            exit; 
        } else {
            $message = "البريد الإلكتروني أو كلمة المرور غير صحيحة.";
            $messageType = "error";
        }
    }
}

$displayAction = $_GET['action'] ?? 'login';
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مختبراتي - الحساب</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f0f2f5; margin: 0; }
        .login-wrapper { display: flex; justify-content: center; align-items: center; min-height: 80vh; padding: 20px; }
        .container { background-color: #ffffff; padding: 40px 30px; border-radius: 12px; box-shadow: 0 8px 20px rgba(0,0,0,0.1); width: 100%; max-width: 400px; }
        .form-box { animation: fadeIn 0.4s ease-in-out; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
        h2 { text-align: center; color: blue; margin-bottom: 20px; font-size: 24px; }
        
        .login-tabs { display: flex; margin-bottom: 25px; border-bottom: 2px solid #eee; }
        .login-tabs a { flex: 1; text-align: center; padding: 12px; text-decoration: none; color: #777; font-weight: bold; font-size: 16px; transition: 0.3s; }
        .login-tabs a.active { color: blue; border-bottom: 3px solid blue; margin-bottom: -2px; }
        .login-tabs a:hover { color: blue; }

        .msg { padding: 10px; margin-bottom: 15px; border-radius: 6px; text-align: center; font-size: 14px; font-weight: bold; }
        .msg.error { background-color: #ffeef0; color: #dc3545; border: 1px solid #dc3545; }
        .msg.success { background-color: #e6f8f0; color: #198754; border: 1px solid #198754; }

        .input-group { margin-bottom: 15px; }
        .input-group label { display: block; margin-bottom: 8px; color: #555; font-size: 14px; font-weight: 600; }
        .input-group input { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; box-sizing: border-box; font-size: 14px; transition: 0.3s; }
        .input-group input:focus { border-color: blue; outline: none; box-shadow: 0 0 5px rgba(0, 0, 255, 0.1); }
        
        .btn { width: 100%; padding: 12px; background-color: blue; color: white; border: none; border-radius: 6px; cursor: pointer; font-size: 16px; font-weight: bold; margin-top: 10px; transition: 0.3s; }
        .btn:hover { background-color: darkblue; }
        
        .toggle-link { text-align: center; margin-top: 20px; font-size: 14px; color: #666; }
        .toggle-link a { color: blue; text-decoration: none; font-weight: bold; }
        .toggle-link a:hover { text-decoration: underline; }
    </style>
</head>
<body>

    <?php include 'header.php'; ?>

    <div class="login-wrapper">
        <div class="container">

            <?php if (!empty($message)): ?>
                <div class="msg <?= $messageType ?>">
                    <?= $message ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['user_id'])): ?>
                <div class="form-box" style="text-align: center;">
                    <h2>لوحة التحكم</h2>
                    <p>أهلاً بك، <strong><?= htmlspecialchars($_SESSION['user_name']) ?></strong></p>
                    <p>لقد قمت بتسجيل الدخول بنجاح.</p>
                    <a href="index.php" class="btn" style="display: block; text-decoration: none; background-color: #198754; margin-bottom: 10px;">الذهاب للرئيسية</a>
                    <form action="login.php" method="POST">
                        <button type="submit" name="logout" class="btn" style="background-color: #dc3545;">تسجيل خروج</button>
                    </form>
                </div>

            <?php else: ?>

                <?php if ($displayAction === 'login'): ?>
                    <div class="form-box">
                        <div class="login-tabs">
                            <a href="login.php" class="active">دخول العملاء</a>
                            <a href="admin_login.php">دخول الإدارة</a>
                        </div>
                        <form action="login.php?action=login" method="POST">
                            <input type="hidden" name="action" value="login">
                            <div class="input-group">
                                <label for="login-email">البريد الإلكتروني</label>
                                <input type="email" id="login-email" name="email" required>
                            </div>
                            <div class="input-group">
                                <label for="login-password">كلمة المرور</label>
                                <input type="password" id="login-password" name="password" required>
                            </div>
                            <button type="submit" class="btn">دخول</button>
                        </form>
                        <div class="toggle-link">
                            ليس لديك حساب؟ <a href="login.php?action=signup">إنشاء حساب جديد</a>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($displayAction === 'signup'): ?>
                    <div class="form-box">
                        <h2>إنشاء حساب</h2>
                        <form action="login.php?action=signup" method="POST">
                            <input type="hidden" name="action" value="signup">
                            <div class="input-group">
                                <label for="signup-name">الاسم الكامل</label>
                                <input type="text" id="signup-name" name="name" required>
                            </div>
                            <div class="input-group">
                                <label for="signup-email">البريد الإلكتروني</label>
                                <input type="email" id="signup-email" name="email" required>
                            </div>
                            <div class="input-group">
                                <label for="signup-password">كلمة المرور</label>
                                <input type="password" id="signup-password" name="password" required>
                            </div>
                            <button type="submit" class="btn">تسجيل</button>
                        </form>
                        <div class="toggle-link">
                            لديك حساب بالفعل؟ <a href="login.php?action=login">تسجيل الدخول</a>
                        </div>
                    </div>
                <?php endif; ?>

            <?php endif; ?>

        </div>
    </div>

</body>
</html>