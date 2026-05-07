<?php
$is_dark = isset($_SESSION['theme']) && $_SESSION['theme'] === 'dark';
?>

<style>

    .main-header { 
        display: flex; 
        justify-content: space-between; 
        align-items: center; 
        padding: 15px 5%; 
        background-color: white; 
        border-bottom: 2px solid whitesmoke; 
        transition: background-color 0.3s, border-color 0.3s;
    }
    .header-rounded-box {
        display: flex;
        align-items: center;
        border: 1px solid #a0aabf; 
        border-radius: 50px; 
        padding: 8px 25px; 
        background-color: white;
        transition: background-color 0.3s, border-color 0.3s;
    }
    .header-logo {
        margin: 0; 
        color: blue; 
        font-size: 24px; 
        margin-left: 20px;
        text-decoration: none;
        font-weight: bold;
    }
    .header-nav-links { 
        display: flex; 
        align-items: center; 
    }
    .header-nav-links a { 
        text-decoration: none; 
        color: black; 
        margin-left: 20px; 
        font-weight: bold; 
        font-size: 15px;
    }
    .header-nav-links a:hover {
        color: blue;
    }
    .header-separator { 
        margin-left: 15px; 
        margin-right: 15px; 
        color: #a0aabf; 
        font-weight: normal;
    }
    .header-auth-nav {
        display: flex;
        align-items: center;
        font-size: 15px;
    }
    .header-auth-nav a { 
        text-decoration: none; 
        color: blue; 
        font-weight: bold; 
    }
    .city-text {
        font-weight: bold;
        color: black;
    }

    .profile-icon-wrapper {
        position: relative;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        background-color: #222; 
        border-radius: 50%;
        text-decoration: none;
        transition: 0.3s;
    }
    .profile-icon-wrapper:hover {
        transform: scale(1.05);
        box-shadow: 0 3px 8px rgba(0,0,0,0.15);
    }
    .profile-icon-wrapper svg {
        fill: white; 
        width: 20px;
        height: 20px;
    }
    .status-dot {
        position: absolute;
        bottom: -2px;
        right: -2px;
        width: 12px;
        height: 12px;
        background-color: #198754; 
        border: 2px solid white;
        border-radius: 50%;
    }

    .theme-toggle-btn {
        background: #f0f0f0;
        border: 1px solid #ccc;
        border-radius: 50%;
        width: 34px;
        height: 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        margin-left: 15px; 
        font-size: 16px;
        transition: 0.3s;
    }
    .theme-toggle-btn:hover {
        background: #e0e0e0;
        transform: scale(1.1);
    }


    <?php if ($is_dark): ?>
        body, html {
            background-color: #121212 !important;
        }
        
        .header-rounded-box, .form-section, .cart-items, .checkout-form, 
        .package-card, .service-item, .order-card, .content, .invoice-box, .form-box, 
        .step-item, .card, .lab-row, .profile-container, .info-box, .highlight-box, 
        .booking-card {
            background-color: #1e1e1e !important;
            border: 1px solid #3a3a3a !important; 
            box-shadow: 0 4px 15px rgba(0,0,0,0.4) !important;
        }

        .main-header, .hero, .steps-container {
            background-color: #1e1e1e !important;
            border-bottom: 1px solid #3a3a3a !important;
            box-shadow: none !important;
        }

        body, p, label, li, th, td, h1, h2, h3, h4, h5, h6, .city-text, 
        .header-nav-links a, span:not(.badge):not(.status-tag) {
            color: #e2e8f0 !important;
        }

        .hero h1, .section-title, .page-title, .logo-text, .main-title, .title, 
        .lab-name, .back-link, .package-card h3, .lab-phone, .header-auth-nav a, 
        .header-logo, .cart-items h2, .checkout-form h2, .content h2, 
        .form-section h2, .info-section h3, .highlight {
            color: #60a5fa !important; 
        }
        
        .section-title, .page-title, .main-title, .title, .content h2 {
            border-color: #60a5fa !important;
        }

        .price { color: #4ade80 !important; } 

        .step-item:nth-child(1) h3 { color: #60a5fa !important; }
        .step-item:nth-child(2) h3 { color: #4ade80 !important; } 
        .step-item:nth-child(3) h3 { color: #fb923c !important; } 

        button, .order-btn, .btn, .btn-select, .invoice-btn, .edit-icon-btn, .btn-email {
            background-color: #2563eb !important; 
            color: #ffffff !important; 
            border: none !important;
        }
        button:hover, .order-btn:hover, .btn:hover, .btn-select:hover, .invoice-btn:hover {
            background-color: #1d4ed8 !important;
        }

        button.btn-checkout, button.btn-print, button.save-btn, .btn-checkout, .btn-print, .save-btn {
            background-color: #059669 !important; 
            color: #ffffff !important;
        }
        button.btn-checkout:hover, button.btn-print:hover, button.save-btn:hover, .btn-checkout:hover {
            background-color: #047857 !important;
        }

        button.cancel-btn, button.logout-icon-btn, .cancel-btn, .logout-icon-btn, .btn-red, a.remove-btn {
            background-color: #dc2626 !important; 
            color: #ffffff !important;
        }
        button.cancel-btn:hover, button.logout-icon-btn:hover, .cancel-btn:hover, .btn-red:hover, a.remove-btn:hover {
            background-color: #b91c1c !important;
        }

        .btn-blue-outline, .detail-link {
            background-color: transparent !important;
            color: #60a5fa !important; 
            border: 2px solid #60a5fa !important;
        }
        .btn-blue-outline:hover, .detail-link:hover {
            background-color: #60a5fa !important;
            color: #121212 !important;
        }

        table, th, td {
            border-color: #444 !important;
            background-color: transparent !important;
        }
        th { background-color: #2a2a2a !important; color: #60a5fa !important; }

        input, select, textarea {
            background-color: #2a2a2a !important;
            color: #ffffff !important;
            border: 1px solid #555 !important;
        }
        input:focus, select:focus, textarea:focus {
            border-color: #60a5fa !important;
            box-shadow: 0 0 5px rgba(96, 165, 250, 0.3) !important;
        }

        .success, .msg.success, .success-msg {
            background-color: rgba(16, 185, 129, 0.15) !important; 
            color: #34d399 !important; 
            border: 1px solid rgba(16, 185, 129, 0.3) !important;
        }
        .error, .msg.error, .error-msg {
            background-color: rgba(239, 68, 68, 0.15) !important; 
            color: #fca5a5 !important; 
            border: 1px solid rgba(239, 68, 68, 0.3) !important;
        }
        
        .status-processing { 
            background-color: rgba(234, 179, 8, 0.15) !important; 
            color: #facc15 !important; 
            border: 1px solid rgba(234, 179, 8, 0.4) !important; 
        }
        .status-cancelled { 
            background-color: rgba(239, 68, 68, 0.15) !important; 
            color: #fca5a5 !important; 
            border: 1px solid rgba(239, 68, 68, 0.4) !important; 
        }
        .status-completed { 
            background-color: rgba(16, 185, 129, 0.15) !important; 
            color: #34d399 !important; 
            border: 1px solid rgba(16, 185, 129, 0.4) !important; 
        }

        .status-tag { background-color: #333 !important; color: #60a5fa !important; }
        .theme-toggle-btn { background: #333 !important; border: 1px solid #555 !important; color: #fff !important; }
        .theme-toggle-btn:hover { background: #444 !important; }
    <?php endif; ?>
</style>

<header class="main-header">
    <div class="header-rounded-box">
        <a href="index.php" class="header-logo">مختبراتي</a>
        <nav class="header-nav-links">
            <a href="index.php">الرئيسية</a>
            <a href="labs_list.php">المختبرات و الفحوصات</a>
            <a href="contact.php">تواصل معنا</a>
        </nav>
    </div>

    <div class="header-rounded-box header-auth-nav">
        
        <a href="toggle_theme.php" class="theme-toggle-btn" title="تبديل المظهر">
            <?= $is_dark ? '☀️' : '🌙' ?>
        </a>

        <span class="city-text">مكة</span>
        <span class="header-separator">|</span>
        
        <?php 
        $cart_count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
        
        if(isset($_SESSION['user_id'])): 
        ?>
            <a href="cart.php" style="color: #198754; font-weight: bold; text-decoration: none;">
                السلة (<span style="color:red;"><?= $cart_count ?></span>)
            </a>
            <span class="header-separator">|</span>

            <a href="myacct.php" style="color: #0d6efd;">طلباتي</a>
            <span class="header-separator" style="margin-left: 20px;">|</span>
            
            <a href="profile.php" class="profile-icon-wrapper" title="الملف الشخصي">
                <svg viewBox="0 0 24 24">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                </svg>
                <span class="status-dot"></span>
            </a>
            
        <?php else: ?>
            <a href="login.php?action=login">تسجيل دخول</a>
            <span class="header-separator">|</span>
            <a href="login.php?action=signup">إنشاء حساب</a>
        <?php endif; ?>
    </div>
</header>