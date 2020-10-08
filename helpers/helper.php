<?php 

/**
 * Функция возвращает отсортированный массив в соответствии с полученными параметрами
 * @param array $array массив который нужно отсортировать
 * @param int $sort как сортировать по возростанию или убыванию (SORT_ASC, SORT_DESC)
 * @param string $key ключ по которому проводить сортировку
 * @return array $array отсортированный  в соответствии с полученными параметрами массив 
 */
function arraySort (array $array, int $sort, string $key = 'sort'): array
{     
    array_multisort(array_column($array, $key), $sort, $array);
    return $array;
}

/**
 * Функция возвращает строку исходя из условий либо без изменений либо обрезанную
 * @param string $line строка которую нужно проверить и в случае необходимости изменить
 * @param int $length длина строки с которой необходимо обрезать
 * @param string $appends что вставить вместо вырезанного
 * @return string $line вернуть полученную строку
 */
function cutString(string $line, int $length = 12, string $appends = '...'): string
{
    if (mb_strlen($line) > $length+3) {
        $line = mb_substr($line, 0, $length) . $appends;
    }

    return $line;
}

/**
 * Функция возвращает текст заголовка исходя из текущего Path
 * @param array $array массив неодбходимых значений
 * @return string $item['title'] текст заголовка исходя из текущего Path
 */
function getTitleArrayThroughPath(array $array) 
{
    foreach ($array as $item) {
        if (isCurrentUrl($item['path'])) {
            return $item['title'];
        }
    }

    return 'Страница отсутствует.';
}

/**
 * Функция выводит пункты меню в соответствии с заданной сортировкой
 * @param array $array массив неодбходимых значений
 * @param int $sort как сортировать по возростанию или убыванию (SORT_ASC, SORT_DESC)
 * @param string $classUl наименование класса для меню
 * @param string $key ключ по которому проводить сортировку * 
 */
function showMenu (array $array, int $sort, string $classUl, string $key = 'sort')
{    
    include $_SERVER['DOCUMENT_ROOT'] . '/templates/show_menu.php';
}

/** 
 * Функция возвращает true или false в зависимости от того является ли переданный url текущим
 * @param string $url url который необходимо проверить текущий или нет
 * @return bool либо true либо false
 */
function isCurrentUrl($url){
    return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) == $url;
}

/**
 * Функция фильтрации и проверки данных, полученных от пользователя
 * @param string $inputText данные, которые необходимо проверить
 * @return string проверенные данные
 */
function filterInputText(string $inputText): string
{
    $inputText = strip_tags($inputText);
    $inputText = htmlspecialchars($inputText);   

    return $inputText;
}

/**
 * Функция подключения к базе данных
 * @return object информация о соединении
 */
function getConnection() : object 
{
    $bdHost = 'localhost';
    $bdLogin = 'root';
    $bdPassword = 'root';
    $bdName = 'module7';
    
    static $bd;

    if (empty($bd)) {
        $bd = mysqli_connect($bdHost, $bdLogin, $bdPassword, $bdName);
        
        if (!$bd) {
            echo mysqli_connect_error();
            echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
            echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
            echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
            exit();
        }    
    } 

    return $bd;
}

/**
 * Функция получает данные пользователя из БД
 * @param string $email электронная почта пользователя
 * @return array данные пользователя
 */
function getUserByEmail(string $email) : array
{
    $email = mysqli_real_escape_string(getConnection(), $email);
        
    $result = mysqli_query(getConnection(), "
        SELECT `u`.*, `gu`.`groups_id`, `g`.`title`  
        FROM `users` AS `u` 
        JOIN `groups_users` AS `gu` ON `u`.`id` = `users_id` 
        JOIN `groups` AS `g` ON `g`.`id` = `groups_id` 
        WHERE `email` = '$email'
    ");

    if (mysqli_num_rows($result) != 0) {
        $getUser =  mysqli_fetch_assoc($result);
        $groupsId = [];

        foreach($result as $row) {              
            $getUser['groups'][] = $row['title'];
            $groupsId[] = $row['groups_id'];
        }
        
        $getUser['canWritePost'] = false;
        foreach($groupsId as $row) {
            if ($row == 3) {
                $getUser['canWritePost'] = true;
            }
        }   
    } else {
        $getUser = [];
    }

    return $getUser;
}

/**
 * Функция получает список пользователей, которые могут писать сообщения 
 * @return array данные пользователя
 */
function getUsersCanWritePosts(): array
{
    $usersCanWritePosts = mysqli_fetch_all(mysqli_query(getConnection(), "
        SELECT `id`, `surname`, `name`, `patronymic`, `email` 
        FROM `users`, `groups_users` 
        WHERE `groups_id` = '3' AND `users_id` = `id`
    "), MYSQLI_ASSOC);

    return $usersCanWritePosts; 
}

/**
 * Функция получает список доступных разделов и их цвет
 * @return array список разделов
 */
function getSectionsList(): array
{
    $sectionsList = mysqli_fetch_all(mysqli_query(getConnection(), "
        SELECT `s`.`id`, `s`.`section`, `s`.`parent_id`, `c`.`hex` 
        FROM `sections` AS `s`, `color` AS `c` 
        WHERE `c`.`id` = `s`.`color`
    "), MYSQLI_ASSOC);

    return $sectionsList;
}

/**
 * Функция получает сообщения пользователя из БД
 * @param int $id - id пользователя
 * @return array сообщения пользователя
 */
function getPostsByUserId(int $id): array 
{
    $id = mysqli_real_escape_string(getConnection(), $id);

    $getPosts = [];
    
    $result = mysqli_query(getConnection(), "
        SELECT  `m`.*, 
                `s`.`section`, `s`.`color`, `s`.`date`, `s`.`user`, `s`.`parent_id`, 
                `c`.`hex`, 
                `u`.`surname`, `u`.`name`, `u`.`patronymic`, `u`.`email`
        FROM `messages` AS `m`, 
             `sections` AS `s`, 
             `color` AS `c`, 
             `users` AS `u` 
        WHERE `recipient_id` = '$id' 
            AND `section_id` = `s`.`id` 
            AND `c`.`id` = `s`.`color` 
            AND `u`.`id` = `m`.`sender_id`
    ");
                
    $getPosts = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $getPosts; 
}

/**
 * Функция меняет признак с не прочитаннго сообщения на прочитано
 * @param int $id - id сообщения
 */
function isOpenUpdate(int $id) {
    $id = mysqli_real_escape_string(getConnection(), $id);
    mysqli_query(getConnection(), "UPDATE `messages` SET `is_open` = '1' WHERE `messages`.`id` = '$id'");
}

/**
 * Функция добавляет новое сообщение в БД
 * @param array $message - сообщение
 * @param string $senderId - текущий пользователь, который отправляет сообщение
 * @return bool успешно ли отправилось сообщение
 */
function addMessage(array $message, string $senderId) {
    $title = mysqli_real_escape_string(getConnection(), $message['title']);
    $text = mysqli_real_escape_string(getConnection(), $message['text']);
    $recipientId = mysqli_real_escape_string(getConnection(), $message['user_id']);
    $section = mysqli_real_escape_string(getConnection(), $message['section_id']); 

    $result = mysqli_query(getConnection(), "INSERT INTO `messages` (`section_id`, `title`, `text`, `sender_id`, `recipient_id`) VALUES ('$section', '$title', '$text', '$senderId', '$recipientId')");   

    return $result ?: false;
}

/**
 * Функция выводит список либо причитанных сообщений либо не прочитанных
 * @param array $getPosts - массив сообщений
 * @param bool $isOpen - признак того, было ли сообщение открыто пользователем или нет (по умолчанию было открыто)
 */
function showListPosts(array $getPosts, bool $isOpen = true) {
    include $_SERVER['DOCUMENT_ROOT'] . '/posts/show_list_posts.php';
}

/**
 * Функция находит сообщение из массива сообщений по id
 * @param array $messages массив сообщений
 * @param string $id - id сообщения
 * @return array данные сообщения
 */
function getMessageById(array $messages, string $id): array
{
    foreach ($messages as $message) {        
        if ($message['id'] == $id) {
            return $message;
        }
    }
}