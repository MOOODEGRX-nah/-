<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>مختبراتي - دليل وظائف الكلى</title>
    <style>
        body { font-family: sans-serif; margin: 0; padding: 0; line-height: 1.6; background-color: white; }
        
        .container { max-width: 900px; margin: 40px auto; border: 1px solid black; padding: 30px; background: white; }
        h1 { color: blue; text-align: center; border-bottom: 1px solid black; padding-bottom: 10px; }
        h2 { color: black; margin-top: 35px; border-right: 5px solid blue; padding-right: 12px; }
        .highlight-box { background-color: whitesmoke; border: 1px dashed black; padding: 15px; margin: 20px 0; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        table, th, td { border: 1px solid black; }
        th { background-color: whitesmoke; padding: 12px; text-align: right; }
        td { padding: 12px; }
        .status-tag { font-weight: bold; color: blue; background: #eee; padding: 2px 8px; border-radius: 4px; font-family: monospace; }
        .warning { color: red; font-weight: bold; }
        .footer-note { font-size: 0.85em; color: gray; text-align: center; margin-top: 40px; border-top: 1px solid whitesmoke; padding-top: 15px; }
    </style>
</head>
<body>

    <?php include 'header.php'; ?>

    <div class="container">
        <h1>دليل فحوصات ووظائف الكلى</h1>
        
        <p>تعمل الكلى على موازنة الأملاح والسوائل في الجسم، وإفراز هرمونات تتحكم في ضغط الدم وإنتاج خلايا الدم الحمراء.</p>

        <div class="highlight-box">
            <strong>لماذا نفحص الكلى؟</strong> للكشف المبكر عن أي قصور قد لا تظهر أعراضه إلا في مراحل متأخرة، خاصة لمرضى السكري والضغط.
        </div>

        <h2>1. أهم تحاليل وظائف الكلى</h2>
        <table>
            <thead>
                <tr>
                    <th>التحليل</th>
                    <th>الرمز العلمي</th>
                    <th>ماذا يخبرنا؟</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>الكرياتينين</strong></td>
                    <td><span class="status-tag">Creatinine</span></td>
                    <td>فضلات ناتجة عن العضلات؛ ارتفاعه يشير لضعف في تصفية الكلى.</td>
                </tr>
            </tbody>
        </table>
        
        <div class="footer-note">
            هذا الدليل مرجع تثقيفي، يرجى مراجعة الطبيب المختص عند ظهور أي نتائج غير طبيعية.
        </div>
    </div>

</body>
</html>