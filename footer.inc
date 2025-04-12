<footer class="text-white py-4">
    <div class="container text-center">
        <nav class="footer-nav">
            <a href="index.php" class="footer-link">Главная</a>
            <a href="about.php" class="footer-link">О нас</a>
            <a href="price.php" class="footer-link">Услуги</a>
            <a href="spec.php" class="footer-link">Специалисты</a>

            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="appointment.php" class="footer-link">Записаться на приём</a>
                <a href="user.php" class="footer-link">Профиль</a>

                <?php if ($_SESSION['role'] == 'admin'): ?>
                    <a href="admin.php" class="footer-link">Админ-панель</a>
                <?php endif; ?>

                <a href="logout.php" class="footer-link">Выйти</a>
            <?php else: ?>
                <a href="login.php" class="footer-link">Войти</a>
            <?php endif; ?>
        </nav>
        <p class="mt-3">© 2025 МедГрад. Все права защищены.</p>
    </div>
</footer>
