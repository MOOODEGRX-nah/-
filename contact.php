<?php 
session_start(); 
require_once 'db.php'; 

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = htmlspecialchars(trim($_POST['name'] ?? ''));
    $email = htmlspecialchars(trim($_POST['email'] ?? ''));
    $subject = htmlspecialchars(trim($_POST['subject'] ?? ''));
    $message = htmlspecialchars(trim($_POST['message'] ?? ''));
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    if (!empty($name) && !empty($email) && !empty($message)) {
        try {
            $full_message = !empty($subject) ? "الموضوع: " . $subject . "\n\nالرسالة:\n" . $message : $message;

            $stmt = $pdo->prepare("INSERT INTO contact_messages (user_id, name, email, message) VALUES (?, ?, ?, ?)");
            $stmt->execute([$user_id, $name, $email, $full_message]);
            
            $success = "تم استلام رسالتك بنجاح، شكراً لتواصلك معنا.";
        } catch(PDOException $e) {
            $error = "حدث خطأ أثناء الإرسال: " . $e->getMessage();
        }
    } else {
        $error = "الرجاء تعبئة جميع الحقول";
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>مختبراتي - تواصل معنا</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 0; line-height: 1.6; background-color: #f5f7fa; }
        
        .container { display: flex; justify-content: space-between; padding: 40px 10%; gap: 30px; }
        
        .form-section { width: 60%; background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.05); }
        .form-section h2 { color: #2c5aa0; margin-top: 0; }
        label { display: block; margin-top: 15px; font-weight: bold; }
        input, select, textarea { width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 8px; box-sizing: border-box; outline: none; font-family: inherit; }
        input:focus, select:focus, textarea:focus { border-color: #2c5aa0; }
        
        button { margin-top: 20px; width: 100%; padding: 12px; background: #2c5aa0; color: white; border: none; border-radius: 20px; cursor: pointer; font-weight: bold; font-size: 16px; transition: 0.3s; }
        button:hover { background: #1e3f73; }
        
        .info-section { width: 35%; padding: 20px; }
        .info-section h3 { color: #2c5aa0; margin-top: 0; }
        .info-section p { margin: 10px 0; color: #333; }
        .note { margin-top: 15px; font-size: 12px; color: gray; }
        .back-link { display: inline-block; margin-top: 20px; color: #2c5aa0; text-decoration: none; font-weight: bold; }

        .success { color: green; font-weight: bold; margin-bottom: 15px; padding: 10px; background: #e6f8f0; border-radius: 5px; border: 1px solid #c3e6cb; }
        .error { color: red; font-weight: bold; margin-bottom: 15px; padding: 10px; background: #ffeef0; border-radius: 5px; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>

    <?php include 'header.php'; ?>

    <div class="container">
        <div class="form-section">
            <h2>هل لديك استفسار أو شكوى؟</h2>

            <?php if($success) echo "<div class='success'>$success</div>"; ?>
            <?php if($error) echo "<div class='error'>$error</div>"; ?>

            <form method="POST">
                <label>الاسم</label>
                <input type="text" name="name" value="<?php echo isset($_SESSION['user_name']) ? htmlspecialchars($_SESSION['user_name']) : ''; ?>" required>

                <label>البريد الإلكتروني</label>
                <input type="email" name="email" required>

                <label>الموضوع</label>
                <select name="subject" required>
                    <option value="">اختر</option>
                    <option value="استفسار">استفسار</option>
                    <option value="شكوى">شكوى</option>
                </select>

                <label>الرسالة</label>
                <textarea name="message" rows="5" required></textarea>

                <button type="submit">إرسال</button>
            </form>
            <p class="note">
                * الزمن المتوقع لحل الشكوى: 5 أيام عمل من رفع الشكوى
            </p>
        </div>

        <div class="info-section">
            <h3>تواصل معنا</h3>
            <p>الهاتف: 920002005</p>
            <p>البريد: mylabs@gmail.com</p>
            <p>واتساب: 920002005</p>

            <a href="index.php" class="back-link">العودة للرئيسية</a>
        </div>
    </div>

</body>
</html>