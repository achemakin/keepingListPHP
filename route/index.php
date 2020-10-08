<?php
include $_SERVER['DOCUMENT_ROOT'] . '/templates/session_start.php';

if (isAuth(true)) {
    include $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';?>

    <h1><?=getTitleArrayThroughPath($mainMenu)?></h1>

    <?php 
    include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php';
}
