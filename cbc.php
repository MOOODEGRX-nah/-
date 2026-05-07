<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مختبراتي - دليل تحاليل الدم</title>
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
        h1.main-title {
            color: #0000ff;
            text-align: center;
            font-size: 2.5em;
            margin-bottom: 30px;
            font-weight: bold;
        }
        .intro-text {
            text-align: right;
            font-size: 1.1em;
            margin-bottom: 25px;
        }
        .info-box {
            border: 1px dashed #333;
            padding: 20px;
            margin-bottom: 40px;
            font-size: 1.05em;
            background-color: whitesmoke;
        }
        h2.section-title {
            color: #000;
            font-size: 1.8em;
            border-right: 8px solid #0000ff;
            padding-right: 15px;
            margin-top: 50px;
            margin-bottom: 25px;
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        th, td {
            border: 1px solid #777;
            padding: 12px 20px;
            text-align: right;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
            width: 30%;
        }
        .col-value {
            width: 70%;
        }
        .footer-list {
            margin-top: 30px;
        }
        ul {
            list-style-type: none;
            padding-right: 20px;
        }
        ul li {
            margin-bottom: 10px;
        }
        ul li::before {
            content: "•";
            color: #000;
            display: inline-block;
            width: 1em;
            margin-right: -1em;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <?php include 'header.php'; ?>

<div class="container">
    <h1 class="main-title">دليل تحاليل الدم وأنواعها</h1>
    
    <p class="intro-text">تعتبر تحاليل الدم مرآة لصحة الجسم، حيث تساعد في مراقبة الوظائف الحيوية واكتشاف أي خلل في مراحله المبكرة.</p>

    <div class="info-box">
        <strong>معلومة هامة:</strong> تنقسم تحاليل الدم إلى عدة فئات، أهمها صورة الدم الكاملة (CBC) التي تقيس خلايا الجسم، وتحاليل الكيمياء الحيوية التي تقيس المواد المذابة في الدم كالسكر والدهون.
    </div>

    <h2 class="section-title">1. تحليل صورة الدم الكاملة (CBC)</h2>
    <table>
        <thead>
            <tr>
                <th>الفحص</th>
                <th class="col-value">الفائدة الرئيسية</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>خلايا الدم البيضاء WBC</strong></td>
                <td>دعم الجهاز المناعي والكشف عن وجود عدوى أو التهاب.</td>
            </tr>
            <tr>
                <td><strong>خلايا الدم الحمراء RBC</strong></td>
                <td>نقل الأكسجين، وتحديد وجود حالات فقر الدم.</td>
            </tr>
            <tr>
                <td><strong>الهيموجلوبين HGB</strong></td>
                <td>قياس قوة الدم وقدرته على تغذية الأعضاء بالأكسجين.</td>
            </tr>
            <tr>
                <td><strong>الصفائح الدموية PLT</strong></td>
                <td>ضرورية لعملية تجلط الدم وحماية الجسم من النزيف.</td>
            </tr>
        </tbody>
    </table>

    <h2 class="section-title">2. تحاليل السكر والدهون</h2>
    <table>
        <thead>
            <tr>
                <th>الفحص</th>
                <th class="col-value">الفائدة الرئيسية</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>السكر التراكمي HbA1c</strong></td>
                <td>مراقبة معدل السكر في الدم خلال الأشهر الثلاثة الماضية.</td>
            </tr>
            <tr>
                <td><strong>الكوليسترول النافع HDL</strong></td>
                <td>يعمل على حماية الشرايين والقلب من التصلب.</td>
            </tr>
            <tr>
                <td><strong>الكوليسترول الضار LDL</strong></td>
                <td>مراقبة ترسب الدهون التي قد تسبب ضيق الشرايين.</td>
            </tr>
        </tbody>
    </table>

    <div class="footer-list">
        <h2 class="section-title">نصائح عامة</h2>
        <ul>
            <li>احرص على شرب الماء بشكل طبيعي قبل سحب عينة الدم.</li>
            <li>يُفضل الصيام لمدة 10 ساعات عند إجراء فحص الدهون أو السكر الصائم.</li>
            <li>استشر الطبيب دائماً عند قراءة النتائج للحصول على تشخيص دقيق.</li>
        </ul>
    </div>
</div>

</body>
</html>