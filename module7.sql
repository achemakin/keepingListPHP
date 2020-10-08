-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 14 2020 г., 23:32
-- Версия сервера: 8.0.19
-- Версия PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `module7`
--

-- --------------------------------------------------------

--
-- Структура таблицы `color`
--

CREATE TABLE `color` (
  `id` int NOT NULL,
  `hex` varchar(7) CHARACTER SET utf32 COLLATE utf32_general_ci NOT NULL,
  `color` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Дамп данных таблицы `color`
--

INSERT INTO `color` (`id`, `hex`, `color`) VALUES
(1, '#000000', 'black'),
(2, '#FF0000', 'red'),
(3, '#00FF00', 'green');

-- --------------------------------------------------------

--
-- Структура таблицы `groups`
--

CREATE TABLE `groups` (
  `id` int NOT NULL,
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `groups`
--

INSERT INTO `groups` (`id`, `title`, `description`) VALUES
(1, 'Администратор', 'Имеет полный доступ к сайту.'),
(2, 'Зарегистрированный пользователь', 'Пользователь, который может просматривать все разделы сайта, но не может писать сообщения'),
(3, 'Пользователь имеющий право писать сообщения', 'Пользователь, который может просматривать все разделы сайта и может писать сообщения');

-- --------------------------------------------------------

--
-- Структура таблицы `groups_users`
--

CREATE TABLE `groups_users` (
  `groups_id` int NOT NULL,
  `users_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `groups_users`
--

INSERT INTO `groups_users` (`groups_id`, `users_id`) VALUES
(1, 1),
(3, 1),
(2, 2),
(2, 3),
(2, 4),
(3, 4),
(2, 6),
(3, 6);

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE `messages` (
  `id` int NOT NULL,
  `section_id` int NOT NULL,
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `text` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sender_id` int NOT NULL,
  `recipient_id` int NOT NULL,
  `is_open` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`id`, `section_id`, `title`, `text`, `date`, `sender_id`, `recipient_id`, `is_open`) VALUES
(1, 2, 'Задание', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Hic, quam? Inventore dolor ipsam excepturi nihil quam veniam facilis amet, commodi assumenda illum corrupti hic culpa modi nisi veritatis quidem quibusdam.', '2020-07-28 23:11:29', 1, 4, 1),
(2, 2, 'Задание 2', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quas voluptatum atque perspiciatis! Dignissimos, at, amet, magnam odit voluptatum provident eos quia unde expedita animi rem atque. Sapiente iure eum aperiam!', '2020-09-04 23:16:15', 1, 4, 1),
(3, 2, 'Задание 3', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quas voluptatum atque perspiciatis! Dignissimos, at, amet, magnam odit voluptatum provident eos quia unde expedita animi rem atque. Sapiente iure eum aperiam!', '2020-09-04 23:18:03', 1, 4, 0),
(4, 2, 'Задание 4', 'Далеко-далеко за словесными горами, в стране гласных и согласных живут рыбные тексты. Гор заманивший своих строчка ты вершину, даль предупреждал наш рекламных подпоясал путь рыбного рыбными скатился пояс обеспечивает маленький меня реторический.', '2020-09-04 23:24:49', 6, 4, 0),
(5, 3, 'Привет 1', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Hic, quam? Inventore dolor ipsam excepturi nihil quam veniam facilis amet, commodi assumenda illum corrupti hic culpa modi nisi veritatis quidem quibusdam.', '2020-09-11 22:32:01', 6, 1, 0),
(6, 6, 'Покупка 1', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Hic, quam? Inventore dolor ipsam excepturi nihil quam veniam facilis amet, commodi assumenda illum corrupti hic culpa modi nisi veritatis quidem quibusdam.', '2020-09-11 22:33:02', 4, 1, 0),
(7, 7, 'Список 1', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Hic, quam? Inventore dolor ipsam excepturi nihil quam veniam facilis amet, commodi assumenda illum corrupti hic culpa modi nisi veritatis quidem quibusdam.', '2020-09-10 22:35:21', 4, 1, 0),
(8, 8, 'Реклама 1', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Hic, quam? Inventore dolor ipsam excepturi nihil quam veniam facilis amet, commodi assumenda illum corrupti hic culpa modi nisi veritatis quidem quibusdam.', '2020-09-02 22:36:02', 4, 1, 0),
(9, 5, 'Общение 1', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Hic, quam? Inventore dolor ipsam excepturi nihil quam veniam facilis amet, commodi assumenda illum corrupti hic culpa modi nisi veritatis quidem quibusdam.', '2020-09-01 22:37:15', 4, 1, 0),
(10, 8, 'Реклама 2', 'мвамысмвысыв ыва цыывасы ываы в ываы  выаывасмы', '2020-09-11 23:13:24', 4, 1, 0),
(11, 5, 'Про животных', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Illum modi tempore quis voluptatum perspiciatis quos exercitationem aspernatur, praesentium nobis, ad hic ex pariatur omnis dolor! Laborum dolorem aperiam laboriosam unde!', '2020-09-12 22:32:57', 1, 4, 0),
(15, 2, '50', 'qwerty', '2020-09-12 22:45:44', 1, 1, 1),
(16, 2, '60', 'qwerty123456', '2020-09-12 22:55:01', 1, 1, 1),
(17, 7, '112233', 'fdgvvfasd argadf fg adfrg agadgad adgf', '2020-09-14 21:41:41', 4, 1, 0),
(18, 7, '112233', 'fdgvvfasd argadf fg adfrg agadgad adgf', '2020-09-14 21:48:11', 4, 1, 0),
(19, 8, '00000', 'fdgadf gafdga a', '2020-09-14 21:48:42', 4, 1, 1),
(20, 5, '555555', 'erfwqef rfgewq fq rqref q', '2020-09-14 22:11:42', 4, 1, 1),
(28, 3, '11111', '111222333444555', '2020-09-14 23:30:14', 1, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `sections`
--

CREATE TABLE `sections` (
  `id` int NOT NULL,
  `section` varchar(50) NOT NULL,
  `color` int NOT NULL,
  `date` datetime NOT NULL,
  `user` int NOT NULL,
  `parent_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `sections`
--

INSERT INTO `sections` (`id`, `section`, `color`, `date`, `user`, `parent_id`) VALUES
(1, 'Основные', 1, '2020-07-28 23:34:02', 1, NULL),
(2, 'по работе', 2, '2020-07-28 23:41:04', 1, 1),
(3, 'личные', 2, '2020-07-28 23:43:04', 1, 1),
(4, 'Оповещения', 1, '2020-07-28 23:43:52', 3, NULL),
(5, 'форумы', 3, '2020-07-28 23:44:39', 3, 4),
(6, 'магазины', 2, '2020-07-28 23:45:17', 3, 4),
(7, 'подписки', 3, '2020-07-28 23:45:45', 6, 4),
(8, 'Спам', 2, '2020-07-28 23:47:52', 2, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `surname` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(50) NOT NULL,
  `patronymic` varchar(50) DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `notice` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `surname`, `name`, `patronymic`, `email`, `phone`, `password`, `active`, `notice`) VALUES
(1, 'Чемакин', 'Александр', 'Андреевич', 'kotor79@gmail.com', '89217193288', '$2y$10$KOa39PL0OxSFuFQ32Q0.rOne.AV8j3YqCPjqNdYadM4h.PKScB5d2', 0, 1),
(2, 'Федоров', 'Петр', NULL, 'fedorov@mail.ru', NULL, '$2y$10$KOa39PL0OxSFuFQ32Q0.rOne.AV8j3YqCPjqNdYadM4h.PKScB5d2', 0, 0),
(3, 'Максимов', 'Максим', 'Максимович', 'max@yandex.кu', '9990909999', '$2y$10$KOa39PL0OxSFuFQ32Q0.rOne.AV8j3YqCPjqNdYadM4h.PKScB5d2', 0, 0),
(4, 'Анисимов', 'Алексей', 'Андреевич', 'anisimov@mail.ru', '86572223421', '$2y$10$KOa39PL0OxSFuFQ32Q0.rOne.AV8j3YqCPjqNdYadM4h.PKScB5d2', 0, 0),
(6, 'Игнатьев', 'Владимир', 'Антонович', 'ign@gmail.com', '89217193233', '$2y$10$KOa39PL0OxSFuFQ32Q0.rOne.AV8j3YqCPjqNdYadM4h.PKScB5d2', 0, 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `groups_users`
--
ALTER TABLE `groups_users`
  ADD PRIMARY KEY (`groups_id`,`users_id`),
  ADD KEY `id_users` (`users_id`);

--
-- Индексы таблицы `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender` (`sender_id`),
  ADD KEY `recipient` (`recipient_id`),
  ADD KEY `section_id` (`section_id`);

--
-- Индексы таблицы `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sections_ibfk_2` (`color`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `sections_ibfk_4` (`user`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `color`
--
ALTER TABLE `color`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT для таблицы `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `groups_users`
--
ALTER TABLE `groups_users`
  ADD CONSTRAINT `groups_users_ibfk_1` FOREIGN KEY (`groups_id`) REFERENCES `groups` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `groups_users_ibfk_2` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`recipient_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `messages_ibfk_3` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `sections`
--
ALTER TABLE `sections`
  ADD CONSTRAINT `sections_ibfk_2` FOREIGN KEY (`color`) REFERENCES `color` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `sections_ibfk_3` FOREIGN KEY (`parent_id`) REFERENCES `sections` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `sections_ibfk_4` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
