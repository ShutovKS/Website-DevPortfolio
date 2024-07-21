-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: MySQL-8.2
-- Время создания: Июл 21 2024 г., 09:57
-- Версия сервера: 8.2.0
-- Версия PHP: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `DevPortfolioDatabase`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
                         `id` int UNSIGNED NOT NULL,
                         `username` varchar(255) NOT NULL,
                         `full_name` varchar(255) NOT NULL,
                         `link_to_photo` varchar(255) DEFAULT NULL,
                         `email` varchar(255) NOT NULL,
                         `phone` varchar(20) DEFAULT NULL,
                         `job` varchar(255) DEFAULT NULL,
                         `location_city` varchar(255) DEFAULT NULL,
                         `location_country` varchar(255) DEFAULT NULL,
                         `social_website` varchar(255) DEFAULT NULL,
                         `social_github` varchar(255) DEFAULT NULL,
                         `social_vk` varchar(255) DEFAULT NULL,
                         `social_telegram` varchar(255) DEFAULT NULL,
                         `password_hash` varchar(255) NOT NULL,
                         `salt` varchar(32) NOT NULL,
                         `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                         `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                         `is_author` tinyint(1) NOT NULL DEFAULT '0',
                         `is_admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `full_name`, `link_to_photo`, `email`, `phone`, `job`, `location_city`, `location_country`, `social_website`, `social_github`, `social_vk`, `social_telegram`, `password_hash`, `salt`, `created_at`, `updated_at`, `is_author`, `is_admin`) VALUES
                                                                                                                                                                                                                                                                                        (1, 'admin_username', 'Main admin', 'https://github.githubassets.com/assets/pull-shark-default-498c279a747d.png', 'admin@mail.com', '345-678-9012', 'Admin', 'Toronto', 'Canada', 'https://bobthompson.com', 'https://github.com/bobthompson', 'bobthompson', 'bobthompson', 'b1bf4e915954747316564d958a501a693528e7cc5360fdd9efa33b487f2c7345', 'bec8ac4a0227e26acbd2ccf63af6eb56', '2024-07-15 18:28:38', '2024-07-20 13:51:46', 1, 1),
                                                                                                                                                                                                                                                                                        (2, 'user_1_username', 'User 1', 'https://github.githubassets.com/assets/pull-shark-default-498c279a747d.png', 'user1@mail.com', '465-678-9012', 'Manager', 'Toronto', 'Canada', 'https://bobthompson.com', 'https://github.com/bobthompson', 'https://vk.com/bobthompson', 'bobthompson', 'b1bf4e915954747316564d958a501a693528e7cc5360fdd9efa33b487f2c7345', 'bec8ac4a0227e26acbd2ccf63af6eb56', '2024-07-15 18:28:38', '2024-07-20 15:11:45', 1, 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
    MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
