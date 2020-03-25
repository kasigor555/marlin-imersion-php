-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Мар 25 2020 г., 19:16
-- Версия сервера: 10.4.11-MariaDB
-- Версия PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `product_catalog`
--

-- --------------------------------------------------------

--
-- Структура таблицы `groups`
--

CREATE TABLE `groups` (
  `id` int(3) NOT NULL,
  `name` varchar(255) NOT NULL,
  `permissions` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `groups`
--

INSERT INTO `groups` (`id`, `name`, `permissions`) VALUES
(1, 'Standart user', ''),
(2, 'Administrator', '{\"admin\": 1}');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(3) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_desc` text NOT NULL,
  `group_id` tinyint(3) NOT NULL DEFAULT 1,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `user_desc`, `group_id`, `created`, `updated`) VALUES
(1, 'Admin', 'aaa@aaa.aaa', '$2y$10$c93HJ9ugWXpCA2Qj28yVE.TBzW0iVzPhLxuiW7Xjx25/6HX.cSlUe', 'Я тут админ, и всё!', 2, '2020-03-24 11:46:07', '2020-03-25 21:03:05'),
(2, 'Manager-1', 'mmm@mmm.mmm', '$2y$10$4ZA3bO2s5lLoSWMGemVqae9r5Wgd8ShMz6UGkuqSTj1ZtBEJ.ZpWC', '', 1, '2020-03-24 11:46:07', '2020-03-24 14:46:07'),
(3, 'User -1 ', 'uuu@uuu.uuu', '$2y$10$1gKytQkjN1VX11Zu3fsti.xXXQLopA8eXctdD.jEHCUJI7nbup18K', 'Привет! Я новый пользователь вашего проекта, хочу перейти на уровень 3!', 1, '2020-03-24 11:48:20', '2020-03-24 14:56:11'),
(4, 'User - 2', 'www@www.www', '$2y$10$/Nx2OoS0EAZtHogOSnX.6OO7BxeK6.wYlGVh491xs.7Jfu/pVLHoq', '', 1, '2020-03-24 13:07:44', '2020-03-24 16:07:44'),
(5, 'User - 3', 'qwe@qwe.qwe', '$2y$10$MArVIsIHWVsTAEcPGrjVlOTeReXqoUAH22aZ/7FLBdJER1FcGqwom', '', 1, '2020-03-24 22:07:25', '2020-03-25 01:07:25'),
(6, 'User - 4', 'sss@sss.sss', '$2y$10$HrR3qEHWJLWGNXLNQ9Cvy.hk.YNjH1Ft8t4p.qN05bPgaS.fC.SGG', '', 1, '2020-03-25 15:45:05', '2020-03-25 18:45:05');

-- --------------------------------------------------------

--
-- Структура таблицы `user_sessions`
--

CREATE TABLE `user_sessions` (
  `id` int(3) NOT NULL,
  `user_id` int(3) NOT NULL,
  `hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_sessions`
--

INSERT INTO `user_sessions` (`id`, `user_id`, `hash`) VALUES
(1, 1, 'd2124ac3a18178178ecf2af165b851cd65e9b45d05081f745ffbda6a64bc0b4f'),
(2, 2, '993dcdd71b2ebe8aaf52ec209b64c26e15182ac87a272d856406cb25f6f1627c'),
(3, 6, 'e95d604876e7ea9c89052a1d22ec50188075696d43c6d57b49b5f3c5ea5af805');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `user_sessions`
--
ALTER TABLE `user_sessions`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
