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
    <div class="hero">
        <img src="art/Plus-Symbol-Vector-PNG-Images.png" alt="МедГрад" class="logo">
        <h1 class="title">Добро пожаловать в МедГрад</h1>
        <p class="subtitle">Мы заботимся о вашем здоровье</p>
    </div>

    <div class="container mt-5">
    <h2 class="text-center mb-4">Наши услуги</h2>
    <div class="service-list">
        <button class="service-btn" data-target="service1">Консультация</button>
        <p id="service1" class="service-desc">Мы предоставляем профессиональные медицинские консультации.</p>

        <button class="service-btn" data-target="service2">Диагностика</button>
        <p id="service2" class="service-desc">Современные методы диагностики для точного определения состояния здоровья.</p>

        <button class="service-btn" data-target="service3">Лечение</button>
        <p id="service3" class="service-desc">Индивидуальные программы лечения с применением современных технологий.</p>

        <button class="service-btn" data-target="service4">Реабилитация</button>
        <p id="service4" class="service-desc">Комплексные программы восстановления после заболеваний и операций.</p>

        <button class="service-btn" data-target="service5">Анализы</button>
        <p id="service5" class="service-desc">Широкий спектр лабораторных анализов с высокой точностью.</p>

        <button class="service-btn" data-target="service6">Вакцинация</button>
        <p id="service6" class="service-desc">Профилактические прививки для детей и взрослых.</p>
    </div>
</div>


    <script src="script.js"></script>
</body>
</html>
<?php include 'footer.inc'; ?>
