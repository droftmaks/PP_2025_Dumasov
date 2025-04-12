<?php 
include 'header.inc'; 
include 'db.php';

$stmt = $conn->prepare("SELECT name, description, photo FROM spec");
$stmt->execute();
$specialists = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <h2 class="h2 display-5 fw-bold text-center mb-4 subtitle">Наши специалисты</h2>
    <div class="row">
        <?php if (!empty($specialists)): ?>
            <?php foreach ($specialists as $specialist): ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="specialist-card p-4 rounded shadow">
                        <img src="<?= htmlspecialchars($specialist['photo']) ?>" alt="Доктор" class="doctor-img">
                        <h3><?= htmlspecialchars($specialist['name']) ?></h3>
                        <p><?= htmlspecialchars($specialist['description']) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">Специалисты временно отсутствуют.</p>
        <?php endif; ?>
    </div>
</div>

<?php include 'footer.inc'; ?>
</body>
</html>
