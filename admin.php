<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}
include 'header.inc';
require 'db.php';
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <link rel="shortcut icon" href="art/logo-stomgrad-simple-new.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ-панель | МедГрад</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center display-5 fw-bold mb-4 subtitle">Админ-панель</h2>

    <div class="row">
        <div class="col-md-4">
            <a href="manage_services.php" class="admin-card text-center p-4 rounded shadow">
                <h3>Услуги</h3>
                <p>Добавить, редактировать, удалить</p>
            </a>
        </div>
        <div class="col-md-4">
            <a href="manage_specialists.php" class="admin-card text-center p-4 rounded shadow">
                <h3>Специалисты</h3>
                <p>Добавить, редактировать, удалить</p>
            </a>
        </div>
        <div class="col-md-4">
            <a href="manage_appointments.php" class="admin-card text-center p-4 rounded shadow">
                <h3>Записи на приём</h3>
                <p>Просмотр и удаление</p>
            </a>
        </div>
    </div>

</div>

<?php include 'footer.inc'; ?>
</body>
</html>
