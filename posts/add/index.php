<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/templates/session_start.php';

    if (isAuth(true)) {
        include $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';

        include $_SERVER['DOCUMENT_ROOT'] . '/posts/check_write_post.php';

        $usersCanWritePosts = getUsersCanWritePosts();
        $sectionsList = getSectionsList();

        $title = '';
        $text = '';
        $recipientId = '';
        $sectionId = ''; 

        if (!empty($_POST) && !addMessage($_POST, $getUser['id'])) {
            echo 'Сообщение не отправлено ' .  mysqli_error(getConnection());
            $title = $_POST['title'];
            $text = $_POST['text'];
            $recipientId = $_POST['user_id'];
            $sectionId = $_POST['section_id']; 
        }?>

        <main>
            <h1>Написать сообщение</h1>

            <form action="/posts/add/" method="POST">
                <p> Заголовок сообщения: </p>
                <input type="text" name="title" value="<?=$title?>" size="50" maxlength = "50" required>

                <p> Сообщение:</p>
                <textarea name="text" id="" cols="50" rows="10" required><?=$text?></textarea>

                <p> Кому направить сообщение: </p>
                <select name="user_id" required>
                    <option></option>
                    <?php
                        foreach ($usersCanWritePosts as $user) {?>
                            <option value="<?=$user['id']?>" <?=($recipientId == $user['id']) ? 'selected' : ''?>>
                                <?=implode(' ', $user)?>
                            </option>
                        <?php } ?>
                </select>

                <p> Выберете раздел сообщения: </p>
                <select name="section_id" required>
                    <option></option>
                    <?php
                        foreach ($sectionsList as $section) {?>                           
                            <option value="<?=$section['id']?>" <?=($sectionId == $section['id']) ? 'selected' : ''?> style="color: <?=$section['hex']?>"><?=$section['section']?></option>
                        <?php } ?>
                </select>

                <br>
                <br>

                <button type="submit">Отправить сообщение</button>
            </form>
        </main>

    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php';
}