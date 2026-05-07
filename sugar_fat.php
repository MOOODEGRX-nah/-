<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مختبراتي - تحاليل السكر والدهون</title>
    <style>
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            line-height: 1.8; 
            background-color: #ffffff; 
            color: #333; 
            margin: 0; 
            padding: 0;
        }
        .container { 
            max-width: 900px; 
            margin: 40px auto; 
            padding: 0 20px; 
        }
        .back-link { margin-bottom: 20px; display: block; color: #0000ff; text-decoration: none; font-weight: bold; }
        h2.section-title { color: #000; font-size: 2.2em; border-right: 15px solid #0000ff; padding-right: 15px; margin-top: 20px; margin-bottom: 25px; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; border: 1px solid #777; }
        th, td { border: 1px solid #777; padding: 15px 25px; text-align: right; }
        th { background-color: #f2f2f2; font-weight: bold; }
    </style>
</head>
<body>

    <?php include 'header.php'; ?>

<div class="container">
    <a href="index.php" class="back-link">← العودة للدليل الشامل</a>

    <h2 class="section-title">تحاليل السكر والدهون</h2>

    <table>
        <thead>
            <tr>
                <th>الفحص</th>
                <th>الفائدة الرئيسية</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>السكر التراكمي HbA1c</strong></td>
                <td>مراقبة معدل السكر في الدم لآخر 3 أشهر.</td>
            </tr>
            <tr>
                <td><strong>الكوليسترول النافع HDL</strong></td>
                <td>حماية الشرايين والقلب من التصلب.</td>
            </tr>
            <tr>
                <td><strong>الكوليسترول الضار LDL</strong></td>
                <td>مراقبة ترسب الدهون في الشرايين.</td>
            </tr>
            <tr>
                <td><strong>الدهون الثلاثية TG</strong></td>
                <td>قياس مستوى الدهون المرتبطة بالنظام الغذائي.</td>
            </tr>
        </tbody>
    </table>
</div>

</body>
</html>