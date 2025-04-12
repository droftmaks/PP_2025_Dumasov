<head>
<link rel="icon" type="image/png" href="art/111.png">
<link rel="shortcut icon" href="art/favicon.ico">
</head>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<header class="text-white py-3">
    <h1 class="mt-3">МедГрад</h1>
    <div class="container text-center">
        <nav class="header-nav">
            <a href="index.php" class="header-link">Главная</a>
            <a href="about.php" class="header-link">О нас</a>
            <a href="price.php" class="header-link">Услуги</a>
            <a href="spec.php" class="header-link">Специалисты</a>

            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="appointment.php" class="header-link">Записаться на приём</a>
                <a href="user.php" class="header-link">Профиль</a>

                <?php if ($_SESSION['role'] == 'admin'): ?>
                    <a href="admin.php" class="header-link">Админ-панель</a>
                <?php endif; ?>

                <a href="logout.php" class="header-link">Выйти</a>
            <?php else: ?>
                <a href="login.php" class="header-link">Войти</a>
            <?php endif; ?>
        </nav>
    </div>
</header>
