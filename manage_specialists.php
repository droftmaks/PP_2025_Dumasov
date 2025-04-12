<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}
include 'header.inc';
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_specialist'])) {
        // Добавить специалиста
        $name = $_POST['name'];
        $description = $_POST['description'];

        // Обработка фото
        $photo = '';
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $targetDir = "art/";  // Указываем папку art для сохранения фотографий
            $photo = $targetDir . basename($_FILES["photo"]["name"]);
            move_uploaded_file($_FILES["photo"]["tmp_name"], $photo);
        }

        $stmt = $conn->prepare("INSERT INTO spec (name, description, photo) VALUES (?, ?, ?)");
        $stmt->execute([$name, $description, $photo]);
    } elseif (isset($_POST['edit_specialist'])) {
        // Редактировать специалиста
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];

        // Обработка фото
        $photo = $_POST['existing_photo']; // Сохранить текущую фотографию, если новая не загружена
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $targetDir = "art/";  // Указываем папку art для сохранения фотографий
            $photo = $targetDir . basename($_FILES["photo"]["name"]);
            move_uploaded_file($_FILES["photo"]["tmp_name"], $photo);
        }

        $stmt = $conn->prepare("UPDATE spec SET name = ?, description = ?, photo = ? WHERE id_spec = ?");
        $stmt->execute([$name, $description, $photo, $id]);
    } elseif (isset($_POST['delete_specialist'])) {
        // Удалить специалиста
        $id = $_POST['id'];
        $stmt = $conn->prepare("DELETE FROM spec WHERE id_spec = ?");
        $stmt->execute([$id]);
    }
}

// Получаем всех специалистов
$stmt = $conn->prepare("SELECT * FROM spec");
$stmt->execute();
$specialists = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <link rel="shortcut icon" href="art/logo-stomgrad-simple-new.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Специалисты | Админ-панель</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container mt-5">


    <!-- Форма для добавления нового специалиста -->
    <div class="mb-4">
        <h3>Добавить специалиста</h3>
        <form action="manage_specialists.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Имя специалиста</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Описание</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <div class="mb-3">
                <label for="photo" class="form-label">Фотография</label>
                <input type="file" class="form-control" id="photo" name="photo">
            </div>
            <button type="submit" name="add_specialist" class="btn btn-success">Добавить</button>
        </form>
    </div>

    <!-- Список специалистов -->
    <h3>Список специалистов</h3>
    <div class="table-responsive">
        <table class="table table-bordered text-white custom-table w-100">
            <thead class="thead-light">
                <tr>
                    <th>Имя</th>
                    <th>Описание</th>
                    <th>Фотография</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($specialists as $specialist): ?>
                    <tr>
                        <td><?= htmlspecialchars($specialist['name']) ?></td>
                        <td><?= htmlspecialchars($specialist['description']) ?></td>
                        <td>
                            <?php if ($specialist['photo']): ?>
                                <img src="<?= htmlspecialchars($specialist['photo']) ?>" alt="Фото" class="img-fluid" style="width: 100px; height: 100px;">
                            <?php else: ?>
                                Нет фото
                            <?php endif; ?>
                        </td>
                        <td>
                            <!-- Редактировать специалиста -->
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editSpecialistModal<?= $specialist['id_spec'] ?>">Редактировать</button>
        
                            <!-- Удалить специалиста -->
                            <form action="manage_specialists.php" method="POST" style="display:inline-block;">
                                <input type="hidden" name="id" value="<?= $specialist['id_spec'] ?>">
                                <button type="submit" name="delete_specialist" class="btn btn-danger" onclick="return confirm('Вы уверены, что хотите удалить этого специалиста?');">Удалить</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Модальное окно для редактирования специалиста -->
                    <div class="modal fade" id="editSpecialistModal<?= $specialist['id_spec'] ?>" tabindex="-1" aria-labelledby="editSpecialistModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="manage_specialists.php" method="POST" enctype="multipart/form-data">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editSpecialistModalLabel">Редактировать специалиста</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="id" value="<?= $specialist['id_spec'] ?>">
                                        <input type="hidden" name="existing_photo" value="<?= $specialist['photo'] ?>">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Имя специалиста</label>
                                            <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($specialist['name']) ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Описание</label>
                                            <textarea class="form-control" id="description" name="description" required><?= htmlspecialchars($specialist['description']) ?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="photo" class="form-label">Фотография</label>
                                            <input type="file" class="form-control" id="photo" name="photo">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                                        <button type="submit" name="edit_specialist" class="btn btn-primary">Сохранить изменения</button>
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
