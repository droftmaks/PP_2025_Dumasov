<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT id_user FROM users WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->fetch()) {
        $error = "Этот email уже зарегистрирован!";
    } else {

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (email, pass, role) VALUES (?, ?, 'user')");
        if ($stmt->execute([$email, $hashed_password])) {
            $_SESSION['success'] = "Вы успешно зарегистрированы!";
            header("Location: login.php");
            exit();
        } else {
            $error = "Ошибка регистрации! Попробуйте снова.";
        }
    }
}
?>

<?php include 'header.inc'; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <link rel="shortcut icon" href="art/logo-stomgrad-simple-new.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="login-box p-5 rounded shadow">
<h2 class="h2 display-5 fw-bold text-center mb-4 subtitle">Регистрация</h2>

        <!-- Вывод ошибки, если есть -->
        <?php if (isset($error)): ?>
            <div class="alert alert-danger text-center"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <input type="email" class="form-control form-input" name="email" placeholder="Введите Email" required>
            </div>
            <div class="mb-3">
                <input type="password" class="form-control form-input" name="password" placeholder="Введите пароль" required>
            </div>
            <button type="submit" class="btn btn-light w-100">Зарегистрироваться</button>
        </form>

        <p class="mt-3 text-center">
            Есть аккаунт? <a href="login.php" class="register-link">Войти</a>
        </p>
    </div>
</div>

<script src="script.js"></script>
</body>
</html>
<?php include 'footer.inc'; ?>
