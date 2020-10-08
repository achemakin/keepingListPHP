<?php
if (!$getUser['canWritePost']) { ?>
        <main>
            <p>Вы сможете отправлять сообщения после прохождения модерации</p>
        </main>        
    <?php
    
    include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php';    
    exit;
}