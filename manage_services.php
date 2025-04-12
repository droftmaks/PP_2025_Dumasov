<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}
include 'header.inc';
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_service'])) {
        // Добавить услугу
        $name = $_POST['name'];
        $price = $_POST['price'];

        $stmt = $conn->prepare("INSERT INTO services (name, price) VALUES (?, ?)");
        $stmt->execute([$name, $price]);
    } elseif (isset($_POST['edit_service'])) {
        // Редактировать услугу
        $id = $_POST['id'];
        $name = $_POST['name'];
        $price = $_POST['price'];

        $stmt = $conn->prepare("UPDATE services SET name = ?, price = ? WHERE id_services = ?");
        $stmt->execute([$name, $price, $id]);
    } elseif (isset($_POST['delete_service'])) {
        // Удалить услугу
        $id = $_POST['id'];
        $stmt = $conn->prepare("DELETE FROM services WHERE id_services = ?");
        $stmt->execute([$id]);
    }
}

// Получаем все услуги
$stmt = $conn->prepare("SELECT * FROM services");
$stmt->execute();
$services = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <link rel="shortcut icon" href="art/logo-stomgrad-simple-new.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Услуги | Админ-панель</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container mt-5">


    <!-- Форма для добавления новой услуги -->
    <div class="mb-4">
        <h3>Добавить услугу</h3>
        <form action="manage_services.php" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Название услуги</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Цена</label>
                <input type="number" class="form-control" id="price" name="price" required>
            </div>
            <button type="submit" name="add_service" class="btn btn-success">Добавить</button>
        </form>
    </div>

    <!-- Список услуг -->
    <h3>Список услуг</h3>
    <div class="table-responsive">
            <table class="table table-bordered text-white custom-table w-100">
                <thead class="thead-light">
            <tr>
                <th>Название</th>
                <th>Цена</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($services as $service): ?>
                <tr>
                    <td><?= htmlspecialchars($service['name']) ?></td>
                    <td><?= htmlspecialchars($service['price']) ?></td>
                    <td>
                        <!-- Редактировать услугу -->
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editServiceModal<?= $service['id_services'] ?>">Редактировать</button>
    
                        <!-- Удалить услугу -->
                        <form action="manage_services.php" method="POST" style="display:inline-block;">
                            <input type="hidden" name="id" value="<?= $service['id_services'] ?>">
                            <button type="submit" name="delete_service" class="btn btn-danger" onclick="return confirm('Вы уверены, что хотите удалить эту услугу?');">Удалить</button>
                        </form>
                    </td>
                </tr>

                <!-- Модальное окно для редактирования услуги -->
                <div class="modal fade" id="editServiceModal<?= $service['id_services'] ?>" tabindex="-1" aria-labelledby="editServiceModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="manage_services.php" method="POST">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editServiceModalLabel">Редактировать услугу</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="id" value="<?= $service['id_services'] ?>">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Название услуги</label>
                                        <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($service['name']) ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Цена</label>
                                        <input type="number" class="form-control" id="price" name="price" value="<?= htmlspecialchars($service['price']) ?>" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                                    <button type="submit" name="edit_service" class="btn btn-primary">Сохранить изменения</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</div>

<?php include 'footer.inc'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
