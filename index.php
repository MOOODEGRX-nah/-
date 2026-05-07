<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>مختبراتي - الرئيسية</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 0; line-height: 1.6; background-color: #f5f7fa; }        
        
        .hero { text-align: center; padding: 80px 20px; background-color: white; border-bottom: 1px solid #eee; box-shadow: 0 4px 10px rgba(0,0,0,0.02); }
        .hero h1 { color: #2c5aa0; font-size: 36px; margin-bottom: 10px; }
        .hero p { color: #555; font-size: 18px; margin-bottom: 25px; }
        .order-btn { background-color: blue; color: white; padding: 15px 35px; text-decoration: none; font-size: 18px; font-weight: bold; border-radius: 30px; display: inline-block; transition: 0.3s; box-shadow: 0 4px 10px rgba(0,0,255,0.2); }
        .order-btn:hover { background-color: darkblue; transform: translateY(-3px); }
        
        .steps-container { padding: 50px 5%; text-align: center; background-color: #f5f7fa; }
        .steps-container h2 { color: #2c3e50; margin-bottom: 30px; }
        .steps-flex { display: flex; justify-content: space-around; flex-wrap: wrap; gap: 20px; margin-top: 30px; }
        .step-item { flex: 1; min-width: 200px; text-align: center; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
        
        .section-title { color: blue; margin-top: 50px; margin-bottom: 30px; border-bottom: 2px solid blue; display: inline-block; padding-bottom: 10px; }
        
        .card-container { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin: 20px 5% 50px 5%; }
        .card { border: 1px solid #ddd; padding: 25px; background-color: white; text-align: center; transition: 0.3s; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.04); }
        .card:hover { border-color: blue; transform: translateY(-5px); box-shadow: 0 8px 15px rgba(0,0,255,0.1); }
        .card h3 { color: #333; margin-top: 0; }
        .detail-link { background: #f0f4f8; color: blue; font-weight: bold; text-decoration: none; display: inline-block; padding: 8px 15px; border-radius: 6px; margin-top: 15px; transition: 0.3s; }
        .detail-link:hover { background: blue; color: white; }
    </style>
</head>
<body>

    <?php include 'header.php'; ?>

    <section class="hero">
        <h1>منصة مختبراتي للتحاليل المنزلية</h1>
        <p>اطلب فحصك الحين، ويجيك المندوب إلى باب بيتك بكل راحة وأمان</p>
        <a href="labs_list.php" class="order-btn">تصفح الخدمات واطلب الآن</a>
    </section>

    <div class="steps-container">
        <h2>كيف تعمل منصة مختبراتي؟</h2>
        <div class="steps-flex">
            <div class="step-item">
                <h3 style="color: blue;">1. اطلب</h3>
                <p>اختر الفحوصات أو الباقات المناسبة لك</p>
            </div>
            <div class="step-item">
                <h3 style="color: green;">2. العينة</h3>
                <p>يصلك أخصائي سحب العينة في الوقت المحدد</p>
            </div>
            <div class="step-item">
                <h3 style="color: orange;">3. النتيجة</h3>
                <p>تصلك النتيجة المعتمدة في حسابك</p>
            </div>
        </div>
    </div>

    <div style="text-align: center;">
        <h2 class="section-title">معلومات طبية قد تهمك</h2>
        <div class="card-container">
            <div class="card">
                <h3>عن تحاليل الدم</h3>
                <a href="cbc.php" class="detail-link">عرض التفاصيل</a>
            </div>

            <div class="card">
                <h3>عن الغدة الدرقية</h3>
                <a href="thyroid.php" class="detail-link">عرض التفاصيل</a>
            </div>

            <div class="card">
                <h3>عن الفيتامينات</h3>
                <a href="about_vitamins.php" class="detail-link">عرض التفاصيل</a>
            </div>

            <div class="card">
                <h3>عن السكر والدهون</h3>
                <a href="sugar_fat.php" class="detail-link">عرض التفاصيل</a>
            </div>

            <div class="card">
                <h3>عن وظائف الكلى</h3>
                <a href="about_kidney.php" class="detail-link">عرض التفاصيل</a>
            </div>

            <div class="card">
                <h3>عن مخزون الحديد</h3>
                <a href="ferritin.php" class="detail-link">عرض التفاصيل</a>
            </div>
        </div>
    </div>

</body>
</html>