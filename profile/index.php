<?php
include $_SERVER['DOCUMENT_ROOT'] . '/templates/session_start.php';

if (isAuth(true)) {
    include $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php'; ?>

    <main>
        <h1><?=getTitleArrayThroughPath($mainMenu)?></h1>
        
        <ul>
            <li> ID пользователя: <?= $getUser['id'] . ';' ?> </li>
            <li> ФИО: <?= $getUser['surname'] . ' ' . $getUser['name'] . ' ' . $getUser['patronymic']?>;</li>
            <li> Электронная почта: <?= $getUser['email']?>;</li>
            <li> Пароль: <?= $getUser['password']?>;</li>
            <li> Телефон: <?= $getUser['phone']?>; </li>
            <li> Флаг активности пользователя: <?= ($getUser['active'] ? 'активен' : 'не активен')?>;</li>
            <li> Получать уведомления <?= ($getUser['notice'] ? 'согласен' : 'не согласен')?>;</li>
            <li> Группы, в которых состоит пользователь: 
                <ul>
                    <?php
                    foreach ($getUser['groups'] as $group) { ?>
                        <li> <?= $group ?> </li>
                    <?php } ?>
                </ul>
            </li>
        </ul>    
    </main>

    <?php    
    include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php';
}