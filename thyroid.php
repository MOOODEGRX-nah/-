<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>مختبراتي - تحاليل الغدة الدرقية</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 0; line-height: 1.6; background-color: white; }
        .container { max-width: 900px; margin: 50px auto; padding: 20px; }
        .back-link { display: inline-block; margin-bottom: 20px; color: blue; text-decoration: none; font-weight: bold; }
        
        .section-header { margin-bottom: 30px; }
        h1.title { 
            color: black; 
            font-size: 2.2em; 
            margin: 0; 
            padding-right: 20px; 
            border-right: 15px solid blue; 
            font-weight: bold;
        }
        
        table { width: 100%; border-collapse: collapse; margin-top: 20px; border: 1px solid black; }
        th, td { border: 1px solid black; padding: 15px 20px; text-align: right; }
        th { background-color: #f2f2f2; font-weight: bold; width: 30%; }
        .col-value { width: 70%; }
    </style>
</head>
<body>

    <?php include 'header.php'; ?>

    <div class="container">
        <a href="index.php" class="back-link">← العودة للرئيسية</a>
        
        <div class="section-header">
            <h1 class="title">تحاليل الغدة الدرقية (Thyroid)</h1>
        </div>

        <table>
            <thead>
                <tr>
                    <th>الفحص</th>
                    <th class="col-value">الفائدة الرئيسية</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>TSH</strong></td>
                    <td>الهرمون المنبه للغدة؛ لتشخيص الخمول أو النشاط الزائد.</td>
                </tr>
                <tr>
                    <td><strong>Free T4</strong></td>
                    <td>يقيس هرمون الثيروكسين الحر المسؤول عن تنظيم الأيض.</td>
                </tr>
                <tr>
                    <td><strong>Free T3</strong></td>
                    <td>يستخدم لتأكيد حالات فرط نشاط الغدة الدرقية.</td>
                </tr>
                <tr>
                    <td><strong>TPO</strong></td>
                    <td>تحليل الأجسام المضادة للكشف عن أمراض الغدة المناعية.</td>
                </tr>
            </tbody>
        </table>
    </div>

</body>
</html>