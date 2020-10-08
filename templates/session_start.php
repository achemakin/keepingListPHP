<?php
session_name('session_id');
ini_set('session.gc_maxlifetime', 60*20);
ini_set('session.cookie_lifetime', 60*20);
session_set_cookie_params(60*20);

session_start();

/**
 * Функция для проверки авторизации пользователя
 * @param bool $isRedirectToMain - нужно-ли вызывать goToMain()
 * @return bool $auth - пользователь авторизован или не авторизован
 */
function isAuth($isRedirectToMain = false) {    
    $auth = isset($_SESSION['auth']) && $_SESSION['auth'] == 'yes';
    
    /* if(!$auth && $isRedirectToMain){
        goToMain();
    } */
    
    return $auth;
}

/**
 * Функция для перехода на главную страницу с параметром /?login=yes 
 */
function goToMain() {
    header('Location: /?login=yes');
}
