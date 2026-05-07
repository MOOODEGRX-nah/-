<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>مختبراتي - قائمة المختبرات</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, sans-serif; background: #f8fafc; margin: 0; direction: rtl; }
        
        .logo-text { color: blue; font-size: 32px; font-weight: 900; }
        .main-nav a { text-decoration: none; color: #444; font-weight: 600; margin-right: 25px; font-size: 18px; }

        .container { width: 80%; margin: 50px auto; }
        .page-header { text-align: center; margin-bottom: 50px; }
        .page-header h1 { font-size: 36px; color: #1e293b; margin-bottom: 10px; }
        .page-header p { color: #64748b; font-size: 18px; }

        .lab-row { 
            background: white; 
            border-radius: 20px; 
            margin-bottom: 30px; 
            display: flex; 
            overflow: hidden; 
            box-shadow: 0 4px 15px rgba(0,0,0,0.05); 
            transition: 0.3s;
            border: 1px solid #eee;
            height: 280px; 
        }
        .lab-row:hover { transform: translateY(-5px); box-shadow: 0 8px 25px rgba(0,0,0,0.1); border-color: blue; }

        .lab-image { width: 350px; height: 100%; object-fit: cover; }

        .lab-details { padding: 30px; flex-grow: 1; display: flex; flex-direction: column; justify-content: center; }
        .lab-name { font-size: 26px; font-weight: 800; color: blue; margin: 0 0 10px 0; }
        .lab-info { color: #555; font-size: 17px; margin-bottom: 8px; font-weight: 500; }
        .lab-phone { color: #2563eb; font-size: 17px; margin-bottom: 15px; font-weight: 600; direction: ltr; text-align: right; }
        .rating { color: #fbbf24; font-size: 20px; margin-bottom: 20px; }
        .rating span { color: #94a3b8; font-size: 14px; margin-right: 5px; }

        .btn-select { 
            align-self: flex-start; 
            background: blue; 
            color: white; 
            padding: 12px 35px; 
            border-radius: 12px; 
            text-decoration: none; 
            font-weight: 700; 
            font-size: 16px; 
            transition: 0.3s; 
        }
        .btn-select:hover { background: darkblue; }
    </style>
</head>
<body>

    <?php include 'header.php'; ?>

    <div class="container">
        <div class="page-header">
            <h1>مختبرات مكة المكرمة</h1>
            <p>اختر المختبر الأقرب إليك لبدء حجز فحوصاتك</p>
        </div>

        <div class="lab-row">
            <img src="https://images.pexels.com/photos/2280571/pexels-photo-2280571.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="مختبر بطحاء قريش" class="lab-image">
            <div class="lab-details">
                <h2 class="lab-name">مختبر بطحاء قريش</h2>
                <p class="lab-info">الموقع: بطحاء قريش، شارع عتاب بن أسيد</p>
                <p class="lab-phone">هاتف: 012-555-1234</p>
                <div class="rating">★★★★☆ <span>(4.5 تقييم قوقل)</span></div>
                <a href="Bat'ha Quraish.php" class="btn-select">عرض الفحوصات</a>
            </div>
        </div>

        <div class="lab-row">
            <img src="https://images.pexels.com/photos/3825539/pexels-photo-3825539.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="مختبر الشوقية الطبي" class="lab-image">
            <div class="lab-details">
                <h2 class="lab-name">مختبر الشوقية الطبي</h2>
                <p class="lab-info">الموقع: الشوقية، طريق عبد القادر كوشك</p>
                <p class="lab-phone">هاتف: 012-555-5678</p>
                <div class="rating">★★★★★ <span>(4.9 تقييم قوقل)</span></div>
                <a href="Shawqiyya.php" class="btn-select">عرض الفحوصات</a>
            </div>
        </div>

        <div class="lab-row">
            <img src="https://images.pexels.com/photos/3735709/pexels-photo-3735709.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="مختبر مكة الشامل" class="lab-image">
            <div class="lab-details">
                <h2 class="lab-name">مختبر مكة الشامل</h2>
                <p class="lab-info">الموقع: العزيزية، طريق المسجد الحرام</p>
                <p class="lab-phone">هاتف: 012-555-9000</p>
                <div class="rating">★★★★☆ <span>(4.4 تقييم قوقل)</span></div>
                <a href="Makkah.php" class="btn-select">عرض الفحوصات</a>
            </div>
        </div>

    </div>

</body>
</html>