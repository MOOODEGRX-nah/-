<?php
$host = 'sql209.infinityfree.com';
$dbname = 'if0_41582905_my_website';
$username = 'if0_41582905';
$password = 'YrAulJXbozzmq'; 

try {

    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("خطأ في الاتصال بقاعدة البيانات: " . $e->getMessage());
}
?>
