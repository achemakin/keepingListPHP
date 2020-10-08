<?php
include $_SERVER['DOCUMENT_ROOT'] . '/templates/session_start.php';

if (isAuth(true)) {
    include $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/posts/check_write_post.php';?>
    
    <main>
        <h1><?=getTitleArrayThroughPath($mainMenu)?></h1>
    
        <?php
        $getPosts = getPostsByUserId($getUser['id']);

        if (isset($_GET['message_id'])) {
            // страница просмотра сообщения
            $message = getMessageById($getPosts, $_GET['message_id']); ?>

            <h3><?=$message['title']?></h3>
            
            <div>Дата отправки: <?=$message['date']?></div>
            
            <p>Сообщение от пользователя: <?=$message['surname'] . ' ' . $message['name'] . ' ' . $message['patronymic']?>. Email: <?=$message['email']?></p>
            
            <p><?=$message['text']?></p>           
            
            <?php

            if ($message['is_open'] == '0') {
                isOpenUpdate($message['id']);
            }
        } else { 
            // страница просмотра списка сообщений
            if (!$getPosts) {?>
                <p>У вас нет сообщений</p>
            <?php } else { ?>
                <div class="posts-list">
                    <div class="posts-list__open">
                        <h3>Прочитанные сообщения:</h3>
                        
                        <?php showListPosts($getPosts);?> 
                    </div>
                    
                    <div class="posts-list__not-open">
                        <h3>Не прочитанные сообщения:</h3>

                        <?php showListPosts($getPosts, false);?>
                    </div>
                </div>

                <a class="to-write-post" href="/posts/add">Написать сообщение</a>
            <?php } 
        }?>
        
    </main>

    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php';
}