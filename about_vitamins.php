<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>مختبراتي - دليل الفيتامينات</title>
    <style>
        body { font-family: sans-serif; margin: 0; padding: 0; line-height: 1.6; background-color: white; }
        
        /* تم إزالة أكواد الهيدر القديمة من هنا */
        
        .container { max-width: 800px; margin: 40px auto; border: 1px solid black; padding: 30px; background: white; }
        h1 { color: blue; text-align: center; border-bottom: 1px solid black; padding-bottom: 10px; }
        h2 { color: black; margin-top: 30px; border-right: 5px solid blue; padding-right: 10px; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        table, th, td { border: 1px solid black; }
        th { background-color: whitesmoke; padding: 12px; text-align: right; }
        td { padding: 10px; }
        .info-box { background-color: whitesmoke; border: 1px dashed black; padding: 15px; margin: 20px 0; }
        .footer-note { font-size: 0.8em; color: gray; text-align: center; margin-top: 40px; border-top: 1px solid whitesmoke; padding-top: 10px; }
    </style>
</head>
<body>

    <?php include 'header.php'; ?>

    <div class="container">
        <h1>دليل الفيتامينات وأنواعها</h1>
        
        <p>الفيتامينات هي مركبات عضوية أساسية يحتاجها الجسم للحفاظ على صحته وأداء وظائفه الحيوية بشكل سليم.</p>

        <div class="info-box">
            <strong>معلومة هامة:</strong> تنقسم الفيتامينات إلى نوعين: ذائبة في الدهون (تخزن في الجسم) وذائبة في الماء (تحتاج لتعويض مستمر).
        </div>

        <h2>1. الفيتامينات الذائبة في الدهون</h2>
        <table>
            <thead>
                <tr>
                    <th>الفيتامين</th>
                    <th>الفائدة الرئيسية</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>فيتامين A</strong></td>
                    <td>تقوية النظر، دعم الجهاز المناعي، وسلامة الجلد.</td>
                </tr>
                <tr>
                    <td><strong>فيتامين D</strong></td>
                    <td>امتصاص الكالسيوم وتقوية العظام والأسنان.</td>
                </tr>
                <tr>
                    <td><strong>فيتامين E</strong></td>
                    <td>مضاد للأكسدة يحمي الخلايا من التلف.</td>
                </tr>
                <tr>
                    <td><strong>فيتامين K</strong></td>
                    <td>ضروري لعملية تجلط الدم ومنع النزيف.</td>
                </tr>
            </tbody>
        </table>

        <h2>2. الفيتامينات الذائبة في الماء</h2>
        <table>
            <thead>
                <tr>
                    <th>الفيتامين</th>
                    <th>الفائدة الرئيسية</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>مجموعة فيتامينات B</strong></td>
                    <td>تحويل الغذاء إلى طاقة ودعم وظائف الأعصاب والدماغ.</td>
                </tr>
                <tr>
                    <td><strong>فيتامين C</strong></td>
                    <td>إنتاج الكولاجين، سرعة التئام الجروح، ورفع المناعة.</td>
                </tr>
            </tbody>
        </table>

        <h2>نصائح عامة</h2>
        <ul>
            <li>احرص على تنوع مصادر الغذاء للحصول على الفيتامينات بشكل طبيعي.</li>
            <li>يُفضل استشارة الطبيب قبل تناول المكملات الغذائية بجرعات عالية.</li>
            <li>التعرض المعتدل لأشعة الشمس يساعد في الحصول على كفايتك من فيتامين D.</li>
        </ul>

        <div class="footer-note">
            تم إعداد هذا الدليل لأغراض تعليمية وتثقيفية فقط.
        </div>
    </div>

</body>
</html>