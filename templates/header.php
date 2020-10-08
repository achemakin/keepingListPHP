<?php
include $_SERVER['DOCUMENT_ROOT'] . '/lib/main_menu.php';
include $_SERVER['DOCUMENT_ROOT'] . '/helpers/helper.php';

$authorization = null;
$displayAuthorizationForm = isset($_GET['login']) && $_GET['login'] == 'yes';
$userLogin = '';
$inputLogin = '';
$inputPassword = '';
$canWritePost = false;

if (isset($_COOKIE['login'])) {
    $userLogin = filterInputText($_COOKIE['login']);    
    $getUser = getUserByEmail($userLogin); 
}

if (isAuth()) {
    $authorization = true;
    $displayAuthorizationForm = false;
    setcookie('login', $userLogin, time() + 3600 * 24 * 30, '/');
}

if (isset($_POST['login'])) {
    $inputLogin = filterInputText($_POST['login']);
    $inputPassword = filterInputText($_POST['password']);

    $displayAuthorizationForm = true;
    $authorization = false;        

    $getUser = getUserByEmail($inputLogin);
        
    if ($getUser && password_verify($inputPassword, $getUser['password'])) {        
        $_SESSION['auth'] = 'yes';
        $authorization = true;
        $displayAuthorizationForm = false;
        setcookie('login', $getUser['email'], time() + 3600 * 24 * 30, '/');
    }
}
?>

<!DOCTYPE html>

<html lang="ru">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Project - ведение списков</title>

        <link href="/styles.css" rel="stylesheet">
    </head>

    <body>
        <div class="header">
            <div class="logo">
                <img src="/i/logo.png" width="68" height="23" alt="Project">
            </div>

            <div class="clearfix"></div>
        </div>

        <div class="clear">            
            <?php showMenu($mainMenu, SORT_ASC, 'main-menu', 'sort'); ?>           
        </div>

        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td class="left-collum-index">
     
