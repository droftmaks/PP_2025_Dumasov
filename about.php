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
<h2 class="h2 display-5 fw-bold text-center mb-4 subtitle">О нас</h2>

    <div class="row align-items-center mb-5">
        <div class="col-md-6">
            <img src="art/123.png" alt="Наша клиника" class="img-fluid rounded shadow">
        </div>
        <div class="col-md-6">
            <p class="lead">
                Добро пожаловать в <b>МедГрад</b> – современный медицинский центр с высококвалифицированными специалистами. Мы предлагаем качественную диагностику и лечение по доступным ценам.
            </p>
            <p>
                📍 Наша клиника расположена в центре города, оснащена новейшим оборудованием и готова помочь вам в любое время!
                
            </p>
        </div>
    </div>

    <div class="contact-box p-4 rounded text-center shadow">
        <h4 class="fw-bold">Наш адрес</h4>
        <p>г. Новоалтайск, ул. Деповская, д. 36</p>
        <h4 class="fw-bold">Контакты</h4>
        <p>📞 55-14-14</p>
        <p>✉ info@medgrad.ru</p>
        <h4 class="fw-bold">График</h4>
        <p>Пн-Пт: 9:00 – 20:00</p>
        <p>Сб: 9:00 – 17:00</p>
        <p>Вс: 9:00 – 13:00</p>
    </div>

    <div class="map-container mt-4">
        <iframe class="w-100 rounded shadow"
            height="400"
            style="border:0;"
            loading="lazy"
            allowfullscreen
            referrerpolicy="no-referrer-when-downgrade"
            src="https://yandex.ru/map-widget/v1/?lang=ru_RU&scroll=true&source=constructor-api&um=constructor%3A0143b85b3aa03a755a3328f0b6ba91cee096650ee72f53854a1a15bf3d37d67c">
        </iframe>
    </div>
</div>

<?php include 'footer.inc'; ?>
</body>
</html>
