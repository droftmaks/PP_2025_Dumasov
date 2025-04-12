<?php 
include 'header.inc'; 
include 'db.php';

$stmt = $conn->prepare("SELECT name, price FROM services");
$stmt->execute();
$services = $stmt->fetchAll(PDO::FETCH_ASSOC);
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

<div class="container-fluid mt-5 px-5">
    <h2 class="text-center display-5 fw-bold mb-4 subtitle">Наши услуги</h2>

    <section class="main__price">
        <h2 class="h2 display-4 fw-bold text-center mb-4 subtitle">
            Цены, размещенные на сайте, не являются публичной офертой, определяемой положениями статьи 437 Гражданского кодекса Российской Федерации. 
            Перед получением услуги необходимо уточнять цены у ответственных сотрудников клиники: ООО Медицинский центр «СтомГрад». Тел.: 55-14-14
        </h2>
        
        <div class="table-responsive">
            <table class="table table-bordered text-white custom-table w-100"> 
                <thead class="thead-light">
                    <tr>
                        <th class="text-center">Наименование услуги</th>
                        <th class="text-center">Цена, руб</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($services)): ?>
                        <?php foreach ($services as $service): ?>
                            <tr>
                                <td><?= htmlspecialchars($service['name']) ?></td>
                                <td class="text-center"><?= htmlspecialchars($service['price']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="2" class="text-center">Услуги временно отсутствуют</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</div>

<?php include "footer.inc"; ?>
</body>
</html>
