<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}
include 'header.inc';
require 'db.php';

// Обработка удаления записи
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_appointment'])) {
    $id = $_POST['id'];
    $stmt = $conn->prepare("DELETE FROM appointment WHERE id_appointment = ?");
    $stmt->execute([$id]);
}

// Получаем все записи о приёмах
$stmt = $conn->prepare("SELECT * FROM appointment");
$stmt->execute();
$appointments = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <link rel="shortcut icon" href="art/logo-stomgrad-simple-new.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Записи на приём | Админ-панель</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container mt-5">


    <!-- Список записей -->
    <h3>Список записей</h3>
    <div class="table-responsive">
        <table class="table table-bordered text-white custom-table w-100">
            <thead class="thead-light">
                <tr>
                    <th>Имя</th>
                    <th>Телефон</th>
                    <th>Email</th>
                    <th>Дата</th>
                    <th>Комментарий</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($appointments as $appointment): ?>
                    <tr>
                        <td><?= htmlspecialchars($appointment['name']) ?></td>
                        <td><?= htmlspecialchars($appointment['phone']) ?></td>
                        <td><?= htmlspecialchars($appointment['email']) ?></td>
                        <td><?= htmlspecialchars($appointment['date']) ?></td>
                        <td><?= htmlspecialchars($appointment['comment']) ?></td>
                        <td>
                            <!-- Удалить запись -->
                            <form action="manage_appointments.php" method="POST" style="display:inline-block;">
                                <input type="hidden" name="id" value="<?= $appointment['id_appointment'] ?>">
                                <button type="submit" name="delete_appointment" class="btn btn-danger" onclick="return confirm('Вы уверены, что хотите удалить эту запись?');">Удалить</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'footer.inc'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
