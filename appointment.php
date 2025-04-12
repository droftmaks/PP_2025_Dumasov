<?php 
include 'header.inc'; 
require 'db.php'; // Подключение к базе данных

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();

    // Проверка авторизации
    if (!isset($_SESSION['user_id'])) {
        echo "<script>alert('Для записи на приём необходимо авторизоваться.'); window.location = 'login.php';</script>";
        exit;
    }

    // Получение данных
    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $date = $_POST['date'];
    $comment = trim($_POST['message']);
    $id_user = $_SESSION['user_id'];

    // Валидация
    if (empty($name) || empty($phone) || empty($email) || empty($date)) {
        echo "<script>alert('Все поля (кроме комментария) обязательны!');</script>";
    } else {
        $today = date('Y-m-d');
        $maxDate = date('Y-m-d', strtotime('+2 months'));

        if ($date < $today || $date > $maxDate) {
            echo "<script>alert('Дата должна быть не раньше сегодняшнего дня и не позднее чем через 2 месяца.');</script>";
        } else {
            // SQL-запрос
            $stmt = $conn->prepare("INSERT INTO appointment (name, phone, email, date, comment, id_user) 
                                    VALUES (:name, :phone, :email, :date, :comment, :id_user)");

            if ($stmt->execute([
                'name' => $name,
                'phone' => $phone,
                'email' => $email,
                'date' => $date,
                'comment' => $comment,
                'id_user' => $id_user
            ])) {
                echo "<script>alert('Вы успешно записались на приём!'); window.location = 'index.php';</script>";
            header("Location: user.php"); 
        } else {
            echo "<script>alert('Ошибка при записи. Попробуйте позже.');</script>";
            }
        }
    }
}
?>

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
    <h2 class="h2 display-5 fw-bold text-center mb-4 subtitle">Запись на приём</h2>

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="appointment-form p-4 rounded shadow">
                <form action="appointment.php" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">ФИО</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Введите ваше имя" required>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Телефон</label>
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="+7 (___) ___-__-__" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="example@mail.com" required>
                    </div>

                    <div class="mb-3">
                        <label for="date" class="form-label">Дата приёма</label>
                        <input type="date" class="form-control" id="date" name="date"
                            min="<?= date('Y-m-d') ?>" 
                            max="<?= date('Y-m-d', strtotime('+2 months')) ?>" 
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="message" class="form-label">Комментарий</label>
                        <textarea class="form-control" id="message" name="message" rows="3" placeholder="Дополнительная информация (необязательно)"></textarea>
                    </div>

                    <button type="submit" class="btn btn-light w-100">Записаться</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.inc'; ?>
</body>
</html>

