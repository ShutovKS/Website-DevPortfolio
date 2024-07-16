SET
time_zone = "+00:00";

--
-- База данных: `DevPortfolioDatabase`
--

-- --------------------------------------------------------

--
-- Таблица `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`
(
    `id`               INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `username`         VARCHAR(255) NOT NULL,
    `full_name`        VARCHAR(255) NOT NULL,
    `link_to_photo`    VARCHAR(255),
    `email`            VARCHAR(255) NOT NULL UNIQUE,
    `phone`            VARCHAR(20) UNIQUE,
    `job`              VARCHAR(255),
    `location_city`    VARCHAR(255),
    `location_country` VARCHAR(255),
    `social_website`   VARCHAR(255),
    `social_github`    VARCHAR(255),
    `social_vk`        VARCHAR(255),
    `social_telegram`  VARCHAR(255),
    `password_hash`    VARCHAR(255) NOT NULL,
    `salt`             VARCHAR(32)  NOT NULL,
    `created_at`       TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`       TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `is_author`        TINYINT(1) NOT NULL DEFAULT '0',
    `is_admin`         TINYINT(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Данные таблицы `users`
--

INSERT INTO `users` (`username`, `full_name`, `link_to_photo`, `email`, `phone`, `job`,
                     `location_city`, `location_country`, `social_website`, `social_github`,
                     `social_vk`, `social_telegram`, `password_hash`, `salt`, `created_at`,
                     `updated_at`, `is_author`, `is_admin`)

VALUES ('jdoe', 'John Doe',
        'https://fikiwiki.com/uploads/posts/2022-02/1644852415_12-fikiwiki-com-p-kartinki-admina-12.png',
        'jdoe@example.com', '123-456-7890', 'Developer', 'New York', 'USA', 'https://johndoe.com',
        'https://github.com/johndoe', 'https://vk.com/johndoe', 'https://t.me/johndoe',
        '2de3c0eb7f7e2414a13bdaa5a56f1e5a66a7dbdaf6c576976ba4e3eb0be2fa4b', '392ae3280f1d45bd5ffc20602a92dc0e', NOW(),
        NOW(), 1, 0),
       ('asmith', 'Alice Smith',
        'https://fikiwiki.com/uploads/posts/2022-02/1644852415_12-fikiwiki-com-p-kartinki-admina-12.png',
        'asmith@example.com', '234-567-8901', 'Designer', 'London', 'UK', 'https://alicesmith.com',
        'https://github.com/alicesmith', 'https://vk.com/alicesmith', 'https://t.me/alicesmith',
        '2de3c0eb7f7e2414a13bdaa5a56f1e5a66a7dbdaf6c576976ba4e3eb0be2fa4b', '392ae3280f1d45bd5ffc20602a92dc0e', NOW(),
        NOW(), 0, 0),
       ('bthompson', 'Bob Thompson',
        'https://fikiwiki.com/uploads/posts/2022-02/1644852415_12-fikiwiki-com-p-kartinki-admina-12.png',
        'bthompson@example.com', '345-678-9012', 'Manager', 'Toronto', 'Canada', 'https://bobthompson.com',
        'https://github.com/bobthompson', 'https://vk.com/bobthompson', 'https://t.me/bobthompson',
        '2de3c0eb7f7e2414a13bdaa5a56f1e5a66a7dbdaf6c576976ba4e3eb0be2fa4b', '392ae3280f1d45bd5ffc20602a92dc0e', NOW(),
        NOW(), 1, 1);

-- Пароль для всех пользователей: 123456

-- --------------------------------------------------------

--
-- Таблица `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles`
(
    `id`         INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user_id`    INT(11) UNSIGNED NOT NULL,
    `title`      VARCHAR(255) NOT NULL,
    `content`    TEXT         NOT NULL,
    `created_at` TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `published`  TINYINT(1) NOT NULL DEFAULT '0',
    FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Данные таблицы `articles`
--

INSERT INTO `articles` (`user_id`, `title`, `content`, `created_at`, `updated_at`, `published`)
VALUES (1, 'First Article by John Doe', 'This is the content of the first article by John Doe.', NOW(), NOW(), 1),
       (2, 'First Article by Alice Smith', 'This is the content of the first article by Alice Smith.', NOW(), NOW(), 1),
       (3, 'First Article by Bob Thompson', 'This is the content of the first article by Bob Thompson.', NOW(), NOW(), 1);

