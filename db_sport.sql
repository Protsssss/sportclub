-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Час створення: Трв 05 2024 р., 22:27
-- Версія сервера: 10.4.32-MariaDB
-- Версія PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `db_sport`
--

-- --------------------------------------------------------

--
-- Структура таблиці `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('client','trainer','trainer_edit','admin') DEFAULT 'client',
  `height` float DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `subscription` enum('None','Sport','Sport+Pool','Full','Trainer') DEFAULT 'None',
  `trainer_type` enum('Fitness','Sport','Personal','Other') DEFAULT NULL,
  `full_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп даних таблиці `clients`
--

INSERT INTO `clients` (`id`, `username`, `password`, `email`, `role`, `height`, `weight`, `subscription`, `trainer_type`, `full_name`) VALUES
(12, '222', '$2y$10$OAmZeWvviJ4/fvV6sDVhLOZ/E3UdAR.Iq6BiZoSaGiA0CkTXOfWYK', 'sss_sss@gmail.com', 'client', 67, 4, 'Sport', 'Sport', 'ААА'),
(13, 'client', '$2y$10$5VrshXbmo1DNqhsMkWasUOsZkCwAPSn.yq6dmMra/WJtvs2CEnDly', 'cli1ent@gmail.com', 'client', 2, 2, 'Sport', 'Sport', '22 22'),
(14, 'trainer', '$2y$10$TLcCq4jUuR.WL9QvLKXopeX/xRXDRemKJJpd8bcikVK4alAJHp7pO', 'train3er@gmail.com', 'client', 123, 132, 'Sport', 'Fitness', '123312 123312'),
(15, 'trainer_edit', '$2y$10$lz.o4410JKpjMZwc7uNu6u3bJ9FMGNiGUqq1lqdQgdjYK6ahig6vu', 'trainer_edit@gmail.com', 'trainer_edit', 0, 0, 'Sport+Pool', 'Fitness', 'Курт Кобейн Олександрович'),
(16, 'admin', '$2y$10$xzIWvctwy5kTUsUq8IIAB.ugTCzQprXGKuOl0i0Vryu4xgii67dim', 'admin@gmail.com', 'admin', 0, 0, 'None', 'Fitness', 'admin'),
(17, 'member', '$2y$10$ImF4yHPsBqOnGs7CM7eHnevTrupe6AxC8Jl4qpiA9N7ENPOY5VkMS', 'member@gmail.com', 'trainer', 0, 0, 'None', 'Fitness', 'Trainer1_0'),
(18, 'member1', '$2y$10$I30NIHinNlcTFiU5GnlI5.VNRJ2OUQljMMUQtGKAY2vfl.zCHUwFC', 'member1@gmail.com', 'trainer', 0, 0, 'Sport', 'Fitness', 'Trainer1_1'),
(20, 'member3', '$2y$10$LeMjl3DXu4//uYKIjk6wD.CetQLIQThK0bXtHL6iA3bumDaVTu4nC', 'member3@gmail.com', 'trainer_edit', 5, 0, 'None', 'Fitness', 'Trainer2_3');

-- --------------------------------------------------------

--
-- Структура таблиці `client_trainer_relationships`
--

CREATE TABLE `client_trainer_relationships` (
  `client_id` int(11) NOT NULL,
  `trainer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп даних таблиці `client_trainer_relationships`
--

INSERT INTO `client_trainer_relationships` (`client_id`, `trainer_id`) VALUES
(13, 18);

-- --------------------------------------------------------

--
-- Структура таблиці `contact_requests`
--

CREATE TABLE `contact_requests` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп даних таблиці `contact_requests`
--

INSERT INTO `contact_requests` (`id`, `name`, `telephone`, `email`, `subject`, `message`, `created_at`) VALUES
(1, 'Олексій', '0508468068', 'TEST@gmail.com', 'Фітнес програми', 'НЕ ШАРЮ, поясніть', '2024-04-20 18:47:15'),
(2, 'Олексій', '053428068', '234o@mail.ru', 'Абонемент', '234234234', '2024-04-20 19:44:47'),
(3, 'Олексій', '380503459294', 'alex@gmail.com', 'Інша інформація', 'передзвоніть i have a problem', '2024-04-24 16:34:39'),
(4, 'Андрій', '380502859268', 'andriya_a@gmail.com', 'Абонемент', 'скільки ціна?', '2024-04-24 16:43:12'),
(5, 'Маркоо', '38077777777', 'markkk@gmail.com', 'Абонемент', 'наберіть мені', '2024-04-24 17:01:15'),
(6, 'Надія', '+380502757867', 'nckndn@GMAIL.COM', 'Запитання щодо тренувань', 'ХОЧУ ТРЕНУВАТИСЬ СЬОГОДНІ', '2024-04-24 17:04:03'),
(7, 'мАРІЯ', '+380502859628', 'SDKFK@GMAIL.COM', 'Інша інформація', 'ПІДКАЖІТЬ ЛАСКА', '2024-04-24 17:04:39'),
(8, 'сергій', '+380502868495', 'sergay@gmail.com', 'Абонемент', 'гроші', '2024-04-24 17:11:36'),
(9, 'Тарас', '0508468068', 'tprots01@gmail.com', 'Абонемент', 'привіт', '2024-04-24 17:12:35'),
(10, 'ТарасССССС', '0508468068', 'tprots01@gmail.com', 'Запитання щодо тренувань', 'ЕЕЕ', '2024-04-24 17:13:44'),
(11, 'ТарасССССС', '0508468068', 'tprots01@gmail.com', 'Інша інформація', 'віааівіавіав', '2024-04-24 17:14:22'),
(12, 'ТарасССССС', '0508468068', 'tprots01@gmail.com', 'Фітнес програми', 'віаавіаів', '2024-04-24 17:19:00'),
(13, 'ТарасССССС', '0508468068', 'tprots01@gmail.com', 'Запитання щодо тренувань', 'іаваівваі', '2024-04-24 17:20:49'),
(14, 'Проць Тарас', '0508468068', 'tprots01@gmail.com', '', 'аіввіа', '2024-04-24 17:23:44'),
(15, 'Проць Тарас', '0508468068', 'tprots01@gmail.com', 'Запитання щодо тренувань', 'ваіаівваіавіваі', '2024-04-24 17:28:57'),
(16, 'Проць Тарас', '0508468068', 'tprots01@gmail.com', 'Запитання щодо тренувань', 'ваіаівваіавіваі', '2024-04-24 17:28:57'),
(17, 'Проць Тарас', '0508468068', 'tprots01@gmail.com', 'Абонемент', 'іфвфівфів', '2024-04-24 17:29:52'),
(18, 'Проць Тарас', '0508468068', 'tprots01@gmail.com', 'Абонемент', 'іфвфівфів', '2024-04-24 17:29:52'),
(19, 'Проць Тарас', '0508468068', 'tprots01@gmail.com', 'Фітнес програми', 'іфвівф', '2024-04-24 17:31:09'),
(20, '123', '213321', 'mdksfmksfd@gmail.com', 'Абонемент', '321213312123', '2024-05-03 22:47:38');

-- --------------------------------------------------------

--
-- Структура таблиці `purchases`
--

CREATE TABLE `purchases` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(21) NOT NULL,
  `card` varchar(21) NOT NULL,
  `additional_info` text DEFAULT NULL,
  `purchase_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `abonement_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп даних таблиці `purchases`
--

INSERT INTO `purchases` (`id`, `name`, `email`, `phone`, `card`, `additional_info`, `purchase_date`, `abonement_type`) VALUES
(1, 'Проць Тарас Олегович', 'tprots01@gmail.com', '+380 50 846 80 68', '4441 1144 2810 1305', 'FFFFFFFFFFFFF', '2024-04-24 21:48:39', ''),
(2, 'Проць Тарас Олегович', 'tprots01@gmail.com', '+380 50 846 80 68', '4441 1144 2810 1305', 'FFFFFFFFFFFFF', '2024-04-24 21:49:29', ''),
(3, 'Проць Тарас Олегович', 'tprots01@gmail.com', '+380 50 846 80 68', '4441 1144 2810 1305', 'FFFFFFFFFFFFF', '2024-04-24 21:51:48', ''),
(4, 'sdfsfddsffsd', 'dsfsdffds@gmail.com', '+380 50 846 80 68', '1234 1234 1234 1234', '24414141', '2024-04-24 21:52:43', ''),
(5, 'affsddfsdsf sfdfsd', 'dfssdfsfd@gmail.com', '+380 40 040 40 40', '4353 4534 5353 5345', '35353534353434', '2024-04-24 21:58:13', ''),
(6, 'іваіваііва', 'sdfkksmdf@gmail.com', '+380 50 846 88 68', '0900 9090 9090 9090', 'dsffsdsfdfdsfsdfsd', '2024-04-24 22:08:16', 'SPORT Абонемент'),
(7, 'dsdsfdfsdsf', 'sdgkgsdmsdf@gmail.com', '+380 50 050 50 50', '2112 3322 3323 2323', '', '2024-04-24 22:11:19', 'Пробний Абонемент'),
(8, 'dsdsfdfsdsf', 'sdgkgsdmsdf@gmail.com', '+380 50 050 50 50', '2112 3322 3323 2323', 'віаіва', '2024-04-24 22:19:57', 'SPORT Абонемент');

-- --------------------------------------------------------

--
-- Структура таблиці `shop_purchases`
--

CREATE TABLE `shop_purchases` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(17) NOT NULL,
  `delivery` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `card` varchar(19) NOT NULL,
  `additional_info` text DEFAULT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `purchase_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп даних таблиці `shop_purchases`
--

INSERT INTO `shop_purchases` (`id`, `product_name`, `name`, `email`, `phone`, `delivery`, `quantity`, `address`, `card`, `additional_info`, `total_price`, `purchase_date`) VALUES
(1, 'Заряд Зелених Витамінів(199₴)', 'Проць Тарас Олегович', 'sdkmfkmsdffmk@gmail.com', '+380 50 846 80 68', 'поштою', 2, 'Пимоненка 145', '1234 1234 1234 1234', 'віаіваіавваі', 0.00, '2024-04-26 19:56:20'),
(2, 'Заряд Зелених Витамінів(199₴)', 'Проць Тарас Олегович', 'sdkmfkmsdffmk@gmail.com', '+380 50 846 80 68', 'поштою', 2, 'Пимоненка 145', '1234 1234 1234 1234', 'віаіваіавваі', 0.00, '2024-04-26 20:23:35'),
(3, 'Заряд Зелених Витамінів(199₴)', 'Проць Тарас Олегович', 'sdkmfkmsdffmk@gmail.com', '+380 50 846 80 68', 'поштою', 2, 'Пимоненка 145', '1234 1234 1234 1234', 'віаіваіавваі', 0.00, '2024-04-26 20:25:43'),
(4, 'Заряд Зелених Витамінів(199₴)', 'Проць Тарас Олегович', 'sdkmfkmsdffmk@gmail.com', '+380 50 846 80 68', 'поштою', 3, 'Пимоненка 145', '1234 1234 1234 1234', 'віаіваіавваі', 0.00, '2024-04-26 20:29:19'),
(5, 'Полунична Бомба(225₴)', 'Ковалишин Ігор Миколайович', 'sdfkmlsdkmf@gmail.com', '+380 50 846 80 68', 'поштою', 1, 'sadsad', '1231 2312 3123 1231', '123231123132231123', 0.00, '2024-04-27 09:23:08'),
(6, 'Полунична Бомба(225₴)', 'Ковалишин Ігор Миколайович', 'sdfkmlsdkmf@gmail.com', '+380 50 846 80 68', 'поштою', 1, 'sadsad', '1231 2312 3123 1231', '123231123132231123', 0.00, '2024-04-27 09:25:18'),
(7, 'Зелений Енерго-Виток(169₴)', 'іва фівавівіфа фіав', 'mjsdfgkjmdksf@gmail.com', '+380 50 848 48 48', 'поштою', 1, '324sdf', '1231 2312 3123 1231', '345', 0.00, '2024-04-27 09:26:51'),
(8, 'Зелений Енерго-Виток(169₴)', 'іва фівавівіфа фіав', 'mjsdfgkjmdksf@gmail.com', '+380 50 848 48 48', 'поштою', 3, '324sdf', '1231 2312 3123 1231', '345', 0.00, '2024-04-27 09:27:02'),
(9, 'Гантелі на десять кг(674₴)', 'іва фівавівіфа фіав', 'mjsdfgkjmdksf@gmail.com', '+380 50 848 48 48', 'поштою', 3, '879ukh', '1231 2312 3123 1231', '', 0.00, '2024-04-27 09:33:32'),
(10, 'Енергетична Експлозія(115₴)', 'іва фівавівіфа фіав', 'mjsdfgkjmdksf@gmail.com', '+380 50 848 48 48', 'нашим кур\'єром', 3, '', '1231 2312 3123 1231', '', 0.00, '2024-04-27 09:46:58'),
(11, 'Енергетична Експлозія(115₴)', 'іва фівавівіфа фіав', 'mjsdfgkjmdksf@gmail.com', '+380 50 848 48 48', 'нашим кур\'єром', 2, '', '1231 2312 3123 1231', '', 0.00, '2024-04-27 09:56:56'),
(12, 'Заряд Зелених Витамінів(199₴)', 'Проць Проць Проць', 'kmjsdfknsdfn@gmail.com', '+380 50 505 00 50', 'поштою', 2, '231132', '1234 4321 1234 4321', '123123', 0.00, '2024-04-27 10:07:29'),
(13, 'Зелений Енерго-Виток(169₴)', 'sdfsdfsd', 'lkmsdfkmsdfmk@gmail.com', '+385 05 050 05 05', 'нашим кур\'єром', 2, '', '2313 2112 3231 2311', '', 0.00, '2024-04-27 10:18:13'),
(14, 'Зелений Енерго-Виток(169₴)', 'sdfsdfsd', 'lkmsdfkmsdfmk@gmail.com', '+385 05 050 05 05', 'нашим кур\'єром', 2, '', '2313 2112 3231 2311', '', 0.00, '2024-04-27 10:32:04'),
(15, 'Гантелі на один кг(150₴)', 'sdfsdfsd', 'lkmsdfkmsdfmk@gmail.com', '+385 05 050 05 05', 'нашим кур\'єром', 2, '', '2313 2112 3231 2311', '', 0.00, '2024-04-27 11:01:31'),
(16, 'Заряд Зелених Витамінів(199₴)', 'sfdfds sdffs sdff', 'sdfdfsdfs@gmail.com', '+380 00 000 00 00', 'поштою', 3, '1111111111111', '1111 1111 1111 1111', '11111111111111111111111111111', 0.00, '2024-04-27 11:03:14'),
(17, 'Заряд Зелених Витамінів(199₴)', 'sfdfds sdffs sdff', 'sdfdfsdfs@gmail.com', '+380 00 000 00 00', 'поштою', 2, '1111111111111', '1111 1111 1111 1111', '11111111111111111111111111111', 0.00, '2024-04-27 11:10:16'),
(18, 'Зелений Енерго-Виток(169₴)', 'Gfdg gdsfg sgf', 'dsfkmsdfkmsfd@gmail.com', '+380 50 846 80 68', 'поштою', 2, '123', '1231 2354 6787 2346', '5', 0.00, '2024-04-27 12:50:27'),
(19, 'Заряд Зелених Витамінів(199₴)', 'dfgdfgdfgdfgdfgd', 'dfgfdg@gmail.com', '+999 99 999 99 99', 'поштою', 3, '3422222222', '3422 2222 2222 2222', '2222222222222222222222222', 0.00, '2024-05-03 22:43:02'),
(20, 'Світло-зелений спортивний костюм(1990₴)', 'fdggdf', 'dfgggfg@gmail.com', '+435 35 353 53 53', 'нашим кур\'єром', 2, '', '2342 3423 4234 2342', '', 0.00, '2024-05-03 22:54:42'),
(21, 'Заряд Зелених Витамінів(199₴)', 'asdsad', 'saddas@gmail.com', '+435 35 353 53 53', 'нашим кур\'єром', 2, '', '3244 4444 4444 4444', '', 0.00, '2024-05-03 22:56:06'),
(22, 'Заряд Зелених Витамінів(199₴)', 'dsfsfds', 'sdfsdf@gmail.com', '+999 99 999 99 99', 'поштою', 3, '32444444444', '4322 2222 2222 2222', '324242424242424242424242424', 0.00, '2024-05-03 23:15:14'),
(23, 'Заряд Зелених Витамінів(199₴)', 'dsfsfds', 'sdfsdf@gmail.com', '+999 99 999 99 99', 'поштою', 3, '32444444444', '4322 2222 2222 2222', '324242424242424242424242424', 0.00, '2024-05-03 23:15:30'),
(24, 'Заряд Зелених Витамінів(199₴)', 'dsfsfds', 'sdfsdf@gmail.com', '+999 99 999 99 99', 'поштою', 3, '32444444444', '4322 2222 2222 2222', '324242424242424242424242424', 0.00, '2024-05-03 23:15:34'),
(25, 'Заряд Зелених Витамінів(199₴)', '4355555555555', 'dfggdf@gmail.com', '+999 99 999 99 99', 'нашим кур\'єром', 2, '', '3444 4444 4444 4444', '34444444444444', 0.00, '2024-05-03 23:16:01'),
(26, 'Полунична Бомба(225₴)', 'пібібіб', 'dsfsdf@gmail.com', '+999 99 999 99 99', 'поштою', 3, '534', '1111 1111 1111 1111', '111', 0.00, '2024-05-04 15:59:20'),
(27, 'Заряд Зелених Витамінів(199₴)', 'фівфівфівфів', 'kmosafdmkdaskm@gmail.com', '+999 99 999 99 99', 'поштою', 3, '5436', '6455 5555 5555 5555', '456666666666', 0.00, '2024-05-04 16:07:26');

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `client_trainer_relationships`
--
ALTER TABLE `client_trainer_relationships`
  ADD PRIMARY KEY (`client_id`,`trainer_id`),
  ADD KEY `trainer_id` (`trainer_id`);

--
-- Індекси таблиці `contact_requests`
--
ALTER TABLE `contact_requests`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `shop_purchases`
--
ALTER TABLE `shop_purchases`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблиці `contact_requests`
--
ALTER TABLE `contact_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблиці `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблиці `shop_purchases`
--
ALTER TABLE `shop_purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Обмеження зовнішнього ключа збережених таблиць
--

--
-- Обмеження зовнішнього ключа таблиці `client_trainer_relationships`
--
ALTER TABLE `client_trainer_relationships`
  ADD CONSTRAINT `client_trainer_relationships_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `client_trainer_relationships_ibfk_2` FOREIGN KEY (`trainer_id`) REFERENCES `clients` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
