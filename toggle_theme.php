<?php
session_start();

if (isset($_SESSION['theme']) && $_SESSION['theme'] === 'dark') {
    $_SESSION['theme'] = 'light';
} else {
    $_SESSION['theme'] = 'dark';
}

$redirect_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.php';
header("Location: " . $redirect_url);
exit;
?>