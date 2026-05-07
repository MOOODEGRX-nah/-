<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>مختبر مكة الشامل - الفحوصات</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, sans-serif; background: #f5f7fa; margin: 0; direction: rtl; font-size: 18px; }
        .user-nav { background: white; padding: 12px 25px; border-radius: 30px; border: 1px solid #ddd; display: flex; align-items: center; gap: 10px; font-weight: bold; font-size: 16px; }
        .main-nav { background: white; padding: 12px 30px; border-radius: 30px; border: 1px solid #ddd; display: flex; align-items: center; gap: 25px; }
        .main-nav a { text-decoration: none; color: black; font-weight: bold; }
        .logo-text { color: blue; font-size: 28px; font-weight: bold; margin-left: 15px; }

        .container { width: 85%; margin: auto; padding: 40px 0; }
        .page-title { text-align: center; color: #333; margin-bottom: 40px; font-size: 42px; font-weight: bold; }

        .packages-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 30px; margin-bottom: 60px; }
        .package-card { background: white; padding: 35px; border-radius: 20px; border: 1px solid #eee; text-align: center; transition: 0.3s; }
        .package-card h3 { color: blue; margin-top: 0; font-size: 28px; font-weight: bold; }
        .price { font-size: 30px; color: green; font-weight: bold; margin: 15px 0; }

        .btn-blue-outline { display: inline-block; padding: 12px 30px; background: transparent; color: blue; border: 2px solid blue; border-radius: 10px; cursor: pointer; font-weight: bold; font-size: 18px; text-decoration: none; transition: 0.3s; width: 100%; box-sizing: border-box; }
        .btn-blue-outline:hover { background: blue; color: white; }

        .services-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 25px; }
        .service-item { background: white; padding: 30px; border-radius: 15px; border: 1px solid #eee; text-align: center; transition: 0.3s; }
        .service-item h4 { margin-top: 0; font-size: 24px; font-weight: bold; }

        .check-list { text-align: right; margin: 25px 0; font-size: 19px; display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
        .check-list label { display: block; cursor: pointer; }
        .back-link { display: block; text-align: center; margin-top: 50px; color: blue; text-decoration: none; font-weight: bold; font-size: 20px; }
    </style>
</head>
<body>
  
    <?php include 'header.php'; ?>

    <div class="container">
        <h1 class="page-title">مختبر مكة الشامل</h1>
        <div class="packages-grid">
            
            <div class="package-card">
                <h3>الباقة المخصصة</h3>
                <form action="cart.php" method="POST" style="margin:0;">
					<div class="check-list">
                        <label><input type="checkbox" name="custom_tests[]" value="فحص الدم|120"> فحص دم شامل (120)</label>
                        <label><input type="checkbox" name="custom_tests[]" value="فحص السكر|50"> فحص سكر (50)</label>
                        <label><input type="checkbox" name="custom_tests[]" value="فيتامين د|190"> فيتامين د (190)</label>
                        <label><input type="checkbox" name="custom_tests[]" value="الكوليسترول|80"> كوليسترول (80)</label>
                        <label><input type="checkbox" name="custom_tests[]" value="وظائف الكلى|110"> وظائف كلى (110)</label>
                        <label><input type="checkbox" name="custom_tests[]" value="وظائف كبد|115"> وظائف كبد (115)</label>
                    </div>
                    <input type="hidden" name="lab_name" value="مختبر مكة الشامل">
                    <button type="submit" name="add_custom_package" class="btn-blue-outline">إضافة المختارات للسلة</button>
                </form>
            </div>
            
            <div class="package-card">
                <h3>الباقة الفاخرة</h3>
                <p>تشمل جميع الفحوصات الستة المتاحة</p>
                <div class="price">550 ريال</div>
                <form action="cart.php" method="POST" style="margin:0;">
                    <input type="hidden" name="item_name" value="الباقة الفاخرة">
                    <input type="hidden" name="item_price" value="550">
                    <input type="hidden" name="lab_name" value="مختبر مكة الشامل">
                    <button type="submit" name="add_to_cart" class="btn-blue-outline">إضافة الباقة كاملة</button>
                </form>
            </div>
        </div>
        
        <div class="services-grid">
            <div class="service-item">
                <h4>فحص الدم</h4>
                <div class="price">120 ريال</div>
                <form action="cart.php" method="POST" style="margin:0;">
                    <input type="hidden" name="item_name" value="فحص الدم">
                    <input type="hidden" name="item_price" value="120">
                    <input type="hidden" name="lab_name" value="مختبر مكة الشامل">
                    <button type="submit" name="add_to_cart" class="btn-blue-outline">إضافة للسلة</button>
                </form>
            </div>
            
            <div class="service-item">
                <h4>فحص السكر</h4>
                <div class="price">50 ريال</div>
                <form action="cart.php" method="POST" style="margin:0;">
                    <input type="hidden" name="item_name" value="فحص السكر">
                    <input type="hidden" name="item_price" value="50">
                    <input type="hidden" name="lab_name" value="مختبر مكة الشامل">
                    <button type="submit" name="add_to_cart" class="btn-blue-outline">إضافة للسلة</button>
                </form>
            </div>
            
            <div class="service-item">
                <h4>فيتامين د</h4>
                <div class="price">190 ريال</div>
                <form action="cart.php" method="POST" style="margin:0;">
                    <input type="hidden" name="item_name" value="فيتامين د">
                    <input type="hidden" name="item_price" value="190">
                    <input type="hidden" name="lab_name" value="مختبر مكة الشامل">
                    <button type="submit" name="add_to_cart" class="btn-blue-outline">إضافة للسلة</button>
                </form>
            </div>
            
            <div class="service-item">
                <h4>الكوليسترول</h4>
                <div class="price">80 ريال</div>
                <form action="cart.php" method="POST" style="margin:0;">
                    <input type="hidden" name="item_name" value="الكوليسترول">
                    <input type="hidden" name="item_price" value="80">
                    <input type="hidden" name="lab_name" value="مختبر مكة الشامل">
                    <button type="submit" name="add_to_cart" class="btn-blue-outline">إضافة للسلة</button>
                </form>
            </div>
            
            <div class="service-item">
                <h4>وظائف الكلى</h4>
                <div class="price">110 ريال</div>
                <form action="cart.php" method="POST" style="margin:0;">
                    <input type="hidden" name="item_name" value="وظائف الكلى">
                    <input type="hidden" name="item_price" value="110">
                    <input type="hidden" name="lab_name" value="مختبر مكة الشامل">
                    <button type="submit" name="add_to_cart" class="btn-blue-outline">إضافة للسلة</button>
                </form>
            </div>
            
            <div class="service-item">
                <h4>وظائف كبد</h4>
                <div class="price">115 ريال</div>
                <form action="cart.php" method="POST" style="margin:0;">
                    <input type="hidden" name="item_name" value="وظائف كبد">
                    <input type="hidden" name="item_price" value="115">
                    <input type="hidden" name="lab_name" value="مختبر مكة الشامل">
                    <button type="submit" name="add_to_cart" class="btn-blue-outline">إضافة للسلة</button>
                </form>
            </div>
        </div>
        <a href="index.php" class="back-link">العودة للرئيسية</a>
    </div>

</body>
</html>