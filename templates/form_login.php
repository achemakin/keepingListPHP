</td>
<td class="right-collum-index">        
    <div class="project-folders-menu">
        <ul class="project-folders-v">
            <li class="<?= $displayAuthorizationForm ? 'project-folders-v-active' : ' '; ?>">
                <a href="/?login=yes">Авторизация</a>
            </li>

            <li>
                <a href="#">Регистрация</a>
            </li>

            <li>
                <a href="#">Забыли пароль?</a>
            </li>
        </ul>

        <div class="clearfix"></div>
    </div>

<?php                
if ($authorization) {   
    include $_SERVER['DOCUMENT_ROOT'] . '/include/success.php';    
} elseif ($authorization === false) {
    include $_SERVER['DOCUMENT_ROOT'] . '/include/error.php';
}

if ($displayAuthorizationForm): ?>
    <div class="index-auth">
        <form action="/?login=yes" method="POST">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td class="iat">
                    <?php 
                    if ($userLogin && $authorization == null) : ?>
                        <p> Здравствуйте, <?= $getUser['name'] . ' ' . $getUser['surname'] ?>! Для входа введите пароль или 
                            <a href="./templates/username_exit.php">смените пользователя</a>.
                        </p>

                        <input type= "hidden" size="30" name="login" value="<?=$getUser['email']?>" required>
                    <?php  else :  ?>
                        <label for="login_id">Ваш e-mail:</label>
                        
                        <input id="login_id" size="30" name="login" value="<?=$inputLogin?>" required>
                    <?php endif ?>
                    </td>
                </tr>
                
                <tr>
                    <td class="iat">
                        <label for="password_id">Ваш пароль:</label>

                        <input id="password_id" size="30" name="password" value="<?=$inputPassword?>" type="password" required>
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="submit" value="Войти">
                    </td>
                </tr>
            </table>
        </form>
    </div>
<?php endif;