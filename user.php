<?php
session_start();
require 'db.php'; 

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if (!$conn) {
    die("Ошибка: нет соединения с базой данных.");
}

$stmt = $conn->prepare("SELECT name, phone, email, date, comment FROM appointment WHERE id_user = ?");
$stmt->execute([$user_id]);
$appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<?php include 'header.inc'; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <link rel="shortcut icon" href="art/logo-stomgrad-simple-new.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>МедГрад</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center display-5 fw-bold mb-4 subtitle">Мои записи на приём</h2>

    <?php if (count($appointments) > 0): ?>
        <div class="table-responsive">
            <table class="table table-bordered text-white custom-table w-100">
                <thead class="thead-light">
                    <tr>
                        <th>ФИО</th>
                        <th>Телефон</th>
                        <th>Email</th>
                        <th>Дата</th>
                        <th>Комментарий</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($appointments as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['name']) ?></td>
                            <td><?= htmlspecialchars($row['phone']) ?></td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                            <td><?= htmlspecialchars($row['date']) ?></td>
                            <td><?= htmlspecialchars($row['comment']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="text-center">Вы пока не записаны на приём.</p>
    <?php endif; ?>

</div>

<?php include 'footer.inc'; ?>
</body>
</html>
