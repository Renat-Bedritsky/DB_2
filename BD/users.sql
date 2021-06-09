-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июн 09 2021 г., 17:45
-- Версия сервера: 10.4.17-MariaDB
-- Версия PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `users`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `login` text NOT NULL,
  `password` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- ССЫЛКИ ТАБЛИЦЫ `users`:
--

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `date`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', '2021-06-05 00:00:00'),
(2, 'Alex', 'c33367701511b4f6020ec61ded352059', '2021-06-05 01:00:00'),
(3, 'Peter', 'a8698009bce6d1b8c2128eddefc25aad', '2021-06-05 02:00:00'),
(4, 'secret', 'e10adc3949ba59abbe56e057f20f883e', '2021-06-06 19:52:52'),
(5, 'Bob', '827ccb0eea8a706c4c34a16891f84e7b', '2021-06-06 21:50:54'),
(6, 'Renat', '827ccb0eea8a706c4c34a16891f84e7b', '2021-06-09 15:56:50');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
