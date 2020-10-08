<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/templates/session_start.php';
    session_destroy();
    header ('Location: /');