
<?php
    require_once 'resources/database.php';
/*    $text=file_get_contents("resources/program-names.txt");
    $programNames=explode("\n","$text");*/

/*    echo '<pre>';
    var_dump($programNames);
    echo '</pre>';*/
?>


<!DOCTYPE HTML>
<html lang="ru">
    <head>
        <link rel="stylesheet" href="css/style.css">
        <script type="text/javascript" src="js/main.js"></script>
        <meta charset="UTF-8">
        <title>Выбор траектории студента</title>
    </head>
    <body>
        <header class="main-header">
            <div class="container">
                <nav class="main-menu">
                    <ul>
                        <li><a href="#">Об институте</a></li>
                        <li><a href="#">Абитуриенту</a></li>
                        <li><a href="#">Студенту</a></li>
                        <li><a href="#">Выпускнику</a></li>
                        <li><a href="#">Сотруднику</a></li>
                        <li><a href="#">Наука</a></li>
                        <li><a href="#">Контакты</a></li>
                    </ul>
                </nav>
                <div class="header-top">
                    <div class="promo">
                        <div class="logo">
                            <img src="img/logo.png" width="118" height="72" alt="Лого ИРИТ-РТФ">
                        </div>
                        <div class="promo-title">ВЫБОР ТРАЕКТОРИИ СТУДЕНТА</div>
                        <p>Планирование дальнейшего обучения начинается с определения вашей индивидуальной траектории</p>
                    </div>
                </div>
            </div>
        </header>

        <section class="drop-zone">
            <div class="container">
                <nav class="template-menu">
                    <ul>
                        <li><a href="#">Разработка ПО</a></li>
                        <li><a href="#">Веб-программирование</a></li>
                        <li><a href="#">Системный анализ</a></li>
                        <li><a href="#">Тестирование ПО</a></li>
                    </ul>
                </nav>
                <div id="drop_zone" ondrop="drop(event, this)" ondragover="allowDrop(event)" >
                    <div class="tip">Выберите программы из списка ниже и перетащите их в это поле
                        или воспользуйтесь готовыми шаблонами,
                        чтобы выбрать направление вашего обучения.</div>
                </div>
                <button onclick="readDropZoneData()">Подтвердить план программы</button>
            </div>
        </section>

        <section class="object-zone" ondrop="drop(event, this)" ondragover="allowDrop(event)">
            <div class="container">
                <?php foreach ($sql_requests as $request) : ?>
                    <?php $programNames= get_programs_info($link,$request); ?>
                    <div id="<?php echo$programNames[0]["Блок"];?>" class="objects" ondrop="drop(event, this)" ondragover="allowDrop(event)">
                        <h2><?php echo $programNames[0]["Блок"];?></h2>
                        <?php foreach ($programNames as $program) : ?>
                            <div id="<?php echo $program["id"];?>" class="object" draggable="true" ondragstart="drag(event)"
                                 title="<?php echo $programNames[0]["Блок"];?>">
                                <div class="object-header">
                                    <p class="program-name"><?php echo  $program["Название программы"];?></p>
                                </div>
                                <p class="program-description"><?php echo  $program["Описание программы"];?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
        </section>

        <footer class="main-footer">
            <div class="container">
                <div class="footer-top">
                    <div class="copyright">
                        <p>© ФГАОУ ВО «УрФУ имени первого<br>Президента России Б.Н. Ельцина»</p>
                    </div>
                    <div class="social-nets">
                        <h3>Мы в социальных сетях:</h3>
                        <ul>
                            <li><a href="#">
                                    <img src="img/vk-logo.png" width="48" height="48" alt="Лого VK">
                                </a></li>
                            <li><a href="#">
                                    <img src="img/fb-logo.png" width="48" height="48" alt="Лого FB">
                                </a></li>
                            <li><a href="#">
                                    <img src="img/tw-logo.png" width="48" height="48" alt="Лого TW">
                                </a></li>
                        </ul>
                        <p>© 2019 Институт радиоэлектроники<br>и информационных технологий - РтФ</p>
                    </div>
                    <div class="address">
                        <p>Институт радиоэлектроники<br>и информационных технологий - РтФ<br>
                            Россия, г. Екатеринбург, ул. Мира 32<br>Дирекция: +7 (343) 375-97-00<br>
                            E-mail: rtf@urfu.ru</p>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>