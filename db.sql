-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Хост: localhost:3306
-- Время создания: Авг 29 2017 г., 02:01
-- Версия сервера: 5.5.42
-- Версия PHP: 5.5.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- База данных: `yii2advanced`
--

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `text` text NOT NULL,
  `theme_id` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `name`, `date`, `text`, `theme_id`) VALUES
(1, 'новость 1', '2017-08-26', 'тествыа ывавыа выаыва', 1),
(2, 'alax', '2018-03-15', 'text news', 3),
(3, 'news 3', '2017-09-20', 'sdfsdzcc', 1),
(4, 'news 4', '2017-08-27', 'sdfs dsfdsf dzcc', 2),
(5, 'news 5', '2017-08-27', 'sdf sddsfzcc', 2),
(6, 'news 6', '2017-08-27', 'kopqm sdfsdfjn zcc\r\nфыаывп\r\nавп ыва ыапв пва рап рпа рапр па\r\nавпрпарпарвашдпрыва вы аровыарылв выароыва ыва выа\r\nыа ыапв ав ы в фы ф а ук е ке ку ц у ясчлплап вапаврп', 1),
(7, 'Срочные новости!!!', '2017-08-27', 'sdf  sdfliewiu sdzcc', 1),
(8, 'news 8', '2017-08-27', 'sdfололоо ло ло выуцкsdzcc', 1),
(9, 'news 9', '2017-08-27', 'ахха кек лол sdfsdzcc', 1),
(10, 'Новая статья от админа', '2017-07-31', 'алаху акбар \r\nололо\r\nкек\r\nчек', 1),
(11, 'интересно', '2016-08-28', 'бал бла бла', 1),
(12, 'Еще одна новость', '2016-08-28', 'бубубу', 1),
(13, 'Крутое название', '2017-08-28', 'бла бла 123123ыва пап вап\r\nва пвап \r\nвыа ываыв\r\n аыва', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `themes`
--

CREATE TABLE `themes` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `themes`
--

INSERT INTO `themes` (`id`, `name`) VALUES
(1, 'Город снов'),
(2, 'Космос'),
(3, 'Спорт');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL,
  `username` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `auth_key` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password_hash`, `password_reset_token`, `email`, `auth_key`, `status`, `created_at`, `updated_at`, `password`) VALUES
(1, 'anton', '$2y$13$4//REPGRyy8gYYwk89ygG.4lLI80WYBtyN5RpVQSqYxI5xVY4EoZq', '', 'bysslaev@gmail.com', 'ht6kMzvFWtiGKWhPBnMUBLvmjZRnPzlz', 10, 1503909817, 1503909817, ''),
(2, 'admin', '$2y$13$PhOSVqEBj.GOy666yj3C4ewqa3E6Y8w9FQ2HU6LV9WeWJSaXYaFhi', '', 'admin@example.com', '89EnQI8JfDlwQhSddj_Zm2d9gRf3sMMy', 10, 1503909886, 1503909886, '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `theme_id` (`theme_id`);

--
-- Индексы таблицы `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT для таблицы `themes`
--
ALTER TABLE `themes`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`theme_id`) REFERENCES `themes` (`id`);
