<?php
include $_SERVER['DOCUMENT_ROOT'] . '/templates/session_start.php';

include $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';
?>
    <h1><?=getTitleArrayThroughPath($mainMenu)?></h1>

    <h2>Возможности проекта —</h2>

    <p>Вести свои личные списки, например покупки в магазине, цели, задачи и многое другое. Делится списками с друзьями и просматривать списки друзей.</p>
</td>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/templates/form_login.php';

include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; 
?>
