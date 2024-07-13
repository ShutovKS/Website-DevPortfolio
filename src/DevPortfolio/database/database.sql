SET
time_zone = "+00:00";

--
-- База данных: `DevPortfolioDatabase`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users`
(
    `id`            INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name`          VARCHAR(255) NOT NULL,
    `email`         VARCHAR(255) NOT NULL UNIQUE,
    `password_hash` VARCHAR(255) NOT NULL,
    `salt`          VARCHAR(32)  NOT NULL,
    `created_at`    TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`    TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `is_author`     TINYINT(1) NOT NULL DEFAULT '0',
    `is_admin`      TINYINT(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Данные таблицы `users`
--

INSERT INTO `users` (`name`, `email`, `password_hash`, `salt`, `is_author`, `is_admin`)
VALUES ('User One', 'userone@example.com', MD5(RAND() * 100000), CONCAT('SALT-', FLOOR(RAND() * 100)), 1, 0),
       ('User Two', 'usertwo@example.com', MD5(RAND() * 200000), CONCAT('SALT-', FLOOR(RAND() * 200)), 0, 1),
       ('User Three', 'usethree@example.com', MD5(RAND() * 300000), CONCAT('SALT-', FLOOR(RAND() * 300)), 1, 0),
       ('User Four', 'userfour@example.com', MD5(RAND() * 400000), CONCAT('SALT-', FLOOR(RAND() * 400)), 0, 1),
       ('User Five', 'userfive@example.com', MD5(RAND() * 500000), CONCAT('SALT-', FLOOR(RAND() * 500)), 1, 0),
       ('User Six', 'usersix@example.com', MD5(RAND() * 600000), CONCAT('SALT-', FLOOR(RAND() * 600)), 0, 1),
       ('User Seven', 'useven@example.com', MD5(RAND() * 700000), CONCAT('SALT-', FLOOR(RAND() * 700)), 1, 0),
       ('User Eight', 'useight@example.com', MD5(RAND() * 800000), CONCAT('SALT-', FLOOR(RAND() * 800)), 0, 1),
       ('User Nine', 'ninetwo@example.com', MD5(RAND() * 900000), CONCAT('SALT-', FLOOR(RAND() * 900)), 1, 0),
       ('User Ten', 'tentwo@example.com', MD5(RAND() * 1000000), CONCAT('SALT-', FLOOR(RAND() * 1000)), 0, 1);

-- --------------------------------------------------------