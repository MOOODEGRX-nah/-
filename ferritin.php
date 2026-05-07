<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>مختبراتي - دليل مخزون الحديد</title>
    <style>
        body { font-family: sans-serif; margin: 0; padding: 0; line-height: 1.6; background-color: white; }        
        .container { max-width: 800px; margin: 40px auto; border: 1px solid black; padding: 30px; background: white; }
        h1 { color: blue; text-align: center; border-bottom: 1px solid black; padding-bottom: 10px; }
        h2 { color: black; margin-top: 30px; border-right: 5px solid blue; padding-right: 10px; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        table, th, td { border: 1px solid black; }
        th { background-color: whitesmoke; padding: 12px; text-align: right; }
        td { padding: 12px; }
        .info-box { background-color: whitesmoke; border: 1px dashed black; padding: 15px; margin: 20px 0; }
        .highlight { font-weight: bold; color: blue; }
        .footer-note { font-size: 0.8em; color: gray; text-align: center; margin-top: 40px; border-top: 1px solid whitesmoke; padding-top: 10px; }
    </style>
</head>
<body>

    <?php include 'header.php'; ?>

    <div class="container">
        <h1>دليل مخزون الحديد (الفيريتين)</h1>
        
        <p>مخزون الحديد هو فحص يقيس كمية الحديد المخزنة في الجسم. الحديد ضروري لإنتاج الهيموجلوبين الذي ينقل الأكسجين في الدم.</p>

        <div class="info-box">
            <strong>نصيحة تقنية:</strong> عند فحص المختبر، ابحث عن كلمة <span class="highlight">Ferritin</span>. النتيجة الطبيعية تختلف بين الرجال والنساء.
        </div>

        <h2>1. أعراض نقص مخزون الحديد</h2>
        <table>
            <thead>
                <tr>
                    <th>العرض</th>
                    <th>الوصف</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>التعب المستمر</strong></td>
                    <td>شعور بالإرهاق حتى بعد الحصول على قسط كاف من النوم.</td>
                </tr>
                <tr>
                    <td><strong>تساقط الشعر</strong></td>
                    <td>يعتبر نقص الحديد من أشهر أسباب ضعف بصيلات الشعر وتكسر الأظافر.</td>
                </tr>
                <tr>
                    <td><strong>ضيق التنفس</strong></td>
                    <td>صعوبة في التنفس عند بذل مجهود بسيط أو صعود الدرج.</td>
                </tr>
                <tr>
                    <td><strong>شحوب البشرة</strong></td>
                    <td>فقدان النضارة المعتادة وميل لون البشرة إلى البياض أو الشحوب.</td>
                </tr>
            </tbody>
        </table>

        <h2>2. كيف ترفع مخزون الحديد بفعالية؟</h2>
        <table>
            <thead>
                <tr>
                    <th>المصدر والطريقة</th>
                    <th>ملاحظات هامة</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><span class="highlight">المصادر الحيوانية</span></td>
                    <td>مثل اللحوم الحمراء والكبدة حيث يكون الامتصاص أسرع.</td>
                </tr>
                <tr>
                    <td><span class="highlight">فيتامين C</span></td>
                    <td>تناول البرتقال أو الليمون مع الوجبة يزيد امتصاص الحديد بشكل كبير.</td>
                </tr>
                <tr>
                    <td><span class="highlight">تجنب الكافيين</span></td>
                    <td>الشاي والقهوة يمنعان امتصاص الحديد إذا شربا مباشرة بعد الأكل.</td>
                </tr>
            </tbody>
        </table>

        <h2>توصيات عامة</h2>
        <ul>
            <li>احرص على ترك ساعتين على الأقل بين وجبة الحديد وشرب الشاي.</li>
            <li>المكملات الغذائية قد تسبب اضطرابات هضمية، لذا استشر طبيبك للنوع الأنسب.</li>
            <li>يحتاج الجسم غالبا من 3 إلى 6 أشهر لتعويض المخزون المفقود.</li>
        </ul>

        <div class="footer-note">
            هذا المحتوى مرجع تعليمي، الفحوصات الطبية هي الفيصل في تحديد حاجتك للعلاج.
        </div>
    </div>

</body>
</html>