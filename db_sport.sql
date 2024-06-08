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
(12, 'user', '$2y$10$OAmZeWvviJ4/fvV6sDVhLOZ/E3UdAR.Iq6BiZoSaGiA0CkTXOfWYK', 'user@gmail.com', 'client', NULL, NULL, 'None', NULL, 'Моставчук Петро Петрович'),
(13, 'client', '$2y$10$5VrshXbmo1DNqhsMkWasUOsZkCwAPSn.yq6dmMra/WJtvs2CEnDly', 'client@gmail.com', 'client', 176, 61, 'Sport+Pool', 'Personal', 'Кравченко Антон'),
(14, 'trainer', '$2y$10$TLcCq4jUuR.WL9QvLKXopeX/xRXDRemKJJpd8bcikVK4alAJHp7pO', 'trainer@gmail.com', 'trainer', 185, 70, 'Trainer', 'Fitness', 'Броварчук Наташа'),
(15, 'trainer_edit', '$2y$10$lz.o4410JKpjMZwc7uNu6u3bJ9FMGNiGUqq1lqdQgdjYK6ahig6vu', 'trainer_edit@gmail.com', 'trainer_edit', 177, 65, 'Trainer', 'Other', 'Пономаренко Владислав'),
(16, 'admin', '$2y$10$xzIWvctwy5kTUsUq8IIAB.ugTCzQprXGKuOl0i0Vryu4xgii67dim', 'admin@gmail.com', 'admin', 190, 77, 'Full', 'Other', 'Назар Петрович'),
(17, 'ludmila1991', '\\\\\\', 'ludmila@gmail.com', 'client', 165, 51, 'Sport', 'Sport', 'Людмила Петрівна'),
(18, 'slava1988p', '\\\\\\', 'vyacheslav88@gmail.com', 'client', 181, 70, 'Sport+Pool', 'Sport', 'Панасюк Вячеслав'),
(46, 'YarikA', '\\\\\\', 'yarik_thebest1999@gmail.com', 'client', 161, 60, 'Sport', 'Fitness', 'Ярослав Прядко'),
(19, 'nina1nina', '\\\\\\', 'nniinnaa@gmail.com', 'client', 169, 55, 'Full', 'Personal', 'Ніна Євгенівна'),
(20, 'po1yaaak', '\\\\\\', 'polyaaak1@gmail.com', 'client', 185, 69, 'Personal', 'Fitness', 'Поляк Адріян'),
(21, 'arkark3', '\\\\\\', 'arkadiy_1993@gmail.com', 'client', 170, 82, 'Sport', 'Fitness', 'Ерстенюк Аркадій'),
(22, 'Ymuroynuk', '\\\\\\', 'muryou_you@gmail.com', 'client', 169, 55, 'Sport+Pool', 'Sport', 'Миронюк Йосип'),
(23, 'Raisa95', '\\\\\\', 'raisa195@gmail.com', 'client', 179, 75, 'Full', 'Personal', 'Захарчук Раїса'),
(24, 'Ro79ma', '\\\\\\', 'roman1979@gmail.com', 'client', 167, 56, 'Sport+Pool', 'Fitness', 'Микитюк Роман'),
(25, 'OlenaO', '\\\\\\', 'olenahello@gmail.com', 'client', 169, 71, 'Personal', 'Personal', 'Олена Олександрівна'),
(26, 'Raisa95', '\\\\\\', 'ra111sa@gmail.com', 'client', 179, 59, 'Full', 'Personal', 'Захарчук Раїса'),
(27, 'OlenaFirst', '\\\\\\', 'ooolenka505@gmail.com', 'client', 169, 75, 'Sport+Pool', 'Fitness', 'Жигалко Олена'),
(28, 'Petro777', '\\\\\\', 'pertovip@gmail.com', 'client', 163, 53, 'Sport', 'Fitness', 'Щуровський Петро'),
(29, 'KolyaTS', '\\\\\\', 'tsehelyk203@gmail.com', 'client', 191, 75, 'Sport', 'Personal', 'Микола Цегелик'),
(30, '1gorovi4', '\\\\\\', 'kovalAI@gmail.com', 'client', 171, 67, 'Personal', 'Sport', 'Андрій Коваль'),
(31, 'Toros', '\\\\\\', 'TorosV2001@gmail.com', 'client', 183, 85, 'Full', 'Fitness', 'Владислав Торос'),
(32, 'Bodya2000', '\\\\\\', 'BogdanBogdanB@gmail.com', 'client', 190, 91, 'Sport', 'Personal', 'Богдан Бабій'),
(32, 'MaxT', '\\\\\\', 'TsTsTsTs111@gmail.com', 'client', 168, 64, 'Sport+Pool', 'Sport', 'Максим Цекот'),
(33, 'Jurak', '\\\\\\', 'jura2004@gmail.com', 'client', 189, 79, 'Full', 'Fitness', 'Тарас Журавленко'),
(34, 'Sever1n', '\\\\\\', 'severin191@gmail.com', 'trainer', 191, 80, 'Full', 'Personal', 'Северин Федорів'),
(35, 'Dan4', '\\\\\\', 'Dan444_Ig@gmail.com', 'trainer', 187, 77, 'Full', 'Personal', 'Данил Чик'),
(36, 'MaxAdmin', '\\\\\\', 'Pereviznykg@gmail.com', 'trainer', 184, 72, 'Full', 'Personal', 'Максим Перевізник'),
(37, 'Leo98', '\\\\\\', 'levko_leo1998g@gmail.com', 'trainer_edit', 179, 68, 'Full', 'Personal', 'Святослав Левко'),
(38, 'K0lyaM', '\\\\\\', 'MikolaM_1990g@gmail.com', 'trainer_edit', 190, 68, 'Full', 'Personal', 'Микола Михайлевич'),
(39, 'Den4ik', '\\\\\\', 'Kyshir_Deng@gmail.com', 'trainer_edit', 175, 69, 'Full', 'Personal', 'Денис Кушнір'),
(40, 'Karina4', '\\\\\\', 'filo4k_k@gmail.com', 'trainer_edit', 171, 57, 'Full', 'Personal', 'Каріна Чорнозуб'),
(41, 'MarPan', '\\\\\\', 'panasiuk_m2000@gmail.com', 'trainer_edit', 171, 57, 'Full', 'Personal', 'Марія Панасюк'),
(42, 'Pryadko5', '\\\\\\', 'ganna_pryadko5@gmail.com', 'admin', 163, 51, 'Full', 'Personal', 'Ганна Прядко'),
(43, 'AdminArtem', '\\\\\\', 'oliynukA1989@gmail.com', 'admin', 195, 89, 'Full', 'Personal', 'Артем Олійник'),
(44, 'Alex100', '\\\\\\', 'oleksiyMir44@gmail.com', 'client', 180, 73, 'Sport', 'Personal', 'Олексій Миронюк'),
(45, 'OlgaWorld', '\\\\\\', 'Ole4kaWorld@gmail.com', 'client', 172, 70, 'Full', 'Sport', 'Ольга Гаврилів'),
(46, 'kris', '\\\\\\', 'hrustya1995@gmail.com', 'client', 195, 71, 'Personal', 'Fitness', 'Лучкевич Христя');

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
(1, 'Олексій', '0508468068', 'HelloWorld111@gmail.com', 'Фітнес програми', 'Як стати членом клубу?', '2024-04-20 18:47:15'),
(2, 'Максим', '0694067259', 'maxsun555@gmail.com', 'Абонемент', 'Яка ціна абонементів?', '2024-04-21 19:44:47'),
(3, 'Олександр', '0506475645', 'alex_sanya123@gmail.com', 'Інша інформація', 'передзвоніть у мене питання', '2024-04-24 16:34:39'),
(4, 'Андрій', '0502859268', 'andriya_a@gmail.com', 'Абонемент', 'скільки ціна абонемента найдешевшого?', '2024-04-24 14:23:12'),
(5, 'Марко', '0692859638', 'markkk@gmail.com', 'Абонемент', 'Яка умова оренди абонементу?', '2024-04-25 11:01:15'),
(6, 'Надія', '0702757867', 'nckndn3333@gmail.com', 'Запитання щодо тренувань', 'Яким чином вибирають тренера?', '2024-04-25 12:22:03'),
(7, 'Марія', '0502859628', 'forwhyforwhat@gmail.com', 'Інша інформація', 'Чи можна зі своїми гантелями???', '2024-04-25 14:54:39'),
(8, 'Cергій', '0603668495', 'serg2iyko@gmail.com', 'Абонемент', 'як купити абонемент?', '2024-04-25 17:11:36'),
(9, 'Назар', '0504588361', 'NazarTS@gmail.com', 'Абонемент', 'привіт, подзвоніть до мене', '2024-04-26 10:12:35'),
(10, 'Тарас', '0508468068', 'tprots01@gmail.com', 'Запитання щодо тренувань', 'Які умови пробного тренування', '2024-04-27 12:13:44'),
(11, 'Данило', '0601365238', 'danylo_nag@gmail.com', 'Інша інформація', 'Можна орендувати ?', '2024-04-27 17:14:22'),
(12, 'Олег', '0609935745', 'oleg_pp12@gmail.com', 'Фітнес програми', 'Які саме у вас фітнес програми', '2024-04-27 14:19:00'),
(13, 'Надія', '0692468023', 'tprots01@gmail.com', 'Запитання щодо тренувань', 'Які вправи ви використовуєте?', '2024-04-28 14:50:49'),
(14, 'Марія', '0902364945', 'mar1yka4@gmail.com', 'Запитання щодо тренувань', 'Через скільки місяців я скину вагу?', '2024-04-28 15:23:44'),
(15, 'Ігор', '0602367521', 'md_igor2001@gmail.com', 'Запитання щодо тренувань', 'Чи можна робити фото під час вправ?', '2024-04-28 16:28:57'),
(16, 'Світлана', '0905066461', 'lanacanada55@gmail.com', 'Запитання щодо тренувань', 'Чи є спеціальні програми пенсіонерам?', '2024-04-28 19:28:57'),
(17, 'Андрій', '0993458668', 'adnriyko1995@gmail.com', 'Абонемент', 'Які умови повернення коштів?', '2024-04-29 14:29:52'),
(18, 'Руслан', '0694523466', 'ukrainewowruslan@gmail.com', 'Абонемент', 'На сайті вказані всі абонементи?', '2024-04-29 15:29:52'),
(19, 'Євген', '0903458264', 'yevgen1989@gmail.com', 'Фітнес програми', 'По якій програмі швидке похудіння??', '2024-04-29 18:31:09'),
(20, 'Інна', '0503523544', 'Inna1999@gmail.com', 'Фітнес програми', 'Що з фітнесу порекомендуєте?', '2024-04-29 18:31:09'),
(21, 'Ігор', '0692859038', 'MD_Igor19@gmail.com', 'Абонемент', 'чи э у вас дитячі програми?', '2024-04-29 18:52:09'),
(21, 'Дмитро', '0633456789', 'DimaColCol@gmail.com', 'Фітнес програми', 'Які програми для початківців?', '2024-04-29 19:31:09'),
(22, 'Василь', '0679876543', 'vasya123@gmail.com', 'Фітнес програми', 'Які вправи краще для збільшення маси?', '2024-04-29 20:20:45'),
(23, 'Ганна', '0502485648', 'gannaoliynuk4@gmail.com', 'Абонемент', 'Яка програма харчування', '2024-04-29 23:47:38');

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
(1, 'Проць Тарас Олегович', 'tprots01@gmail.com', '+380 50 846 80 68', '4441 1144 2810 1305', 'Давайте як найшвидше', '2024-04-24 19:48:39', 'SPORT Абонемент'),
(2, 'Чорногуз Марія Остапівна', 'Mariyka4guz@gmail.com', '+380 69 543 65 37', '4411 2255 3240 5525', '', '2024-04-24 21:49:29', 'Пробний Абонемент'),
(3, 'Іванов Сергій Петрович', 'sergey_ivanov@gmail.com', '+380 66 123 45 67', '5500 2233 1234 5678', 'Без додаткової інформації', '2024-05-01 10:15:20', 'SPORT+POOL Абонемент '),
(4, 'Петренко Анна Михайлівна', 'anna.petrenko@example.com', '+380 67 987 65 43', '5123 4567 8901 2345', 'Дякую!', '2024-05-02 11:20:45', 'FULL Абонемент'),
(5, 'Ковальов Денис Ігорович', 'denys.kovalov@gmail.com', '+380 50 222 33 44', '5378 9876 5432 1098', 'Прохання надати додаткову інформацію', '2024-05-03 12:30:15', 'SPORT+POOL Абонемент '),
(6, 'Григоренко Олександра Володимирівна', 'sasha_grigorenko@example.com', '+380 68 555 44 33', '5236 9867 1234 5678', 'Записати на групові заняття з понеділка', '2024-05-04 13:45:37', 'FULL Абонемент'),
(7, 'Лисенко Олег Іванович', 'oleg_lis@example.com', '+380 63 111 22 33', '5500 9876 5432 1098', 'Попросити про додатковий дисконт', '2024-05-05 14:55:10', 'SPORT Абонемент'),
(8, 'Сидоренко Юлія Василівна', 'julia_sid@example.com', '+380 50 222 33 44', '5123 6543 9876 3210', 'Дякую за допомогу', '2024-05-06 15:55:10', 'Пробний Абонемент'),
(9, 'Гордійчук Максим Олександрович', 'max.gord@example.com', '+380 67 333 44 55', '5241 7865 4321 0987', 'Прохання надати графік тренувань', '2024-05-07 16:55:10', 'SPORT+POOL Абонемент '),
(10, 'Литвиненко Вікторія Ігорівна', 'viktoria.lit@example.com', '+380 63 444 55 66', '5362 8954 3210 7654', 'Інформація про дитячі тренування', '2024-05-08 17:55:10', 'SPORT+POOL Абонемент '),
(11, 'Михайленко Валентина Віталіївна', 'valya.m@example.com', '+380 66 555 44 33', '5500 1234 5678 9012', 'Будь ласка, надішліть розклад тренувань', '2024-05-09 18:55:10', 'SPORT Абонемент'),
(12, 'Данилов Денис Петрович', 'den_dan@example.com', '+380 50 666 77 88', '5123 8901 2345 6789', 'Дякую за розуміння', '2024-05-10 19:55:10', 'FULL Абонемент'),
(13, 'Кравчук Людмила Миколаївна', 'ludmila.krav@example.com', '+380 67 777 88 99', '5241 2345 6789 0123', 'Чи є можливість оренди роздільного обладнання?', '2024-05-11 20:55:10', 'SPORT Абонемент'),
(14, 'Семенчук Артем Олегович', 'art_semenchuk@example.com', '+380 63 888 99 00', '5362 6789 0123 4567', 'Бажаю успіхів у вашому клубі!', '2024-05-12 21:55:10', 'FULL Абонемент');
(15, 'Цекот Максим Васильович', 'MaxTS1999@gmail.com', '+380 50 346 23 11', '2112 3322 3323 2323', '', '2024-05-14 22:19:57', 'SPORT+POOL Абонемент ');

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
(1, 'Заряд Зелених Витамінів(199₴)', 'Проць Тарас Олегович', 'tprots01@gmail.com', '+380 50 846 80 68', 'поштою', 2, 'Пимоненка 14', '4411 2355 9823 4313', 'Можна до понеділка?', 398.00, '2024-04-26 16:56:20'),
(2, 'Заряд Зелених Витамінів(199₴)', 'Лисенко Олег Іванович', 'valya.m@example.com', '+380 98 543 34 33', 'нашим кур\'єром', 3, 'Наукова 5', '1234 1234 1234 1234', 'Чи є можливіть як найшвидше?', 597.00, '2024-04-26 17:23:35'),
(3, 'Полунична Бомба(225₴)', 'Петренко Анна Михайлівна', 'anya1999@gmail.com', '+380 99 345 33 54', 'поштою', 1, 'Шевченка 94', '4231 4334 6522 5434', 'Питання відсутні', 225.00, '2024-04-26 20:25:43'),
(4, 'Гантелі на 10кг(674₴)', 'Гордійчук Максим Олександрович', 'max.gord@example.com', '+380 67 333 44 55', 'нашим кур\'єром', 5, 'Соборна 12', '5123 4567 0987 5432', 'Дякую', 3370.00, '2024-05-01 11:30:15'),
(5, 'Енергетичний Коктейль(179₴)', 'Михайленко Валентина Віталіївна', 'valya.m@example.com', '+380 66 555 44 33', 'самовивіз', 2, 'Велика Васильківська 30', '6010 1234 5678 9012', 'Чи можна отримати знижку?', 358.00, '2024-05-01 12:45:37'),
(6, 'Кокосова Вода(99₴)', 'Кравчук Людмила Миколаївна', 'ludmila.krav@example.com', '+380 67 777 88 99', 'поштою', 3, 'Грушевського 55', '5500 4321 0987 7654', 'Дякую за сервіс', 297.00, '2024-05-01 14:55:10'),
(7, 'Гантелі на 5кг(485₴)', 'Лисенко Олег Іванович', 'julia_sid@example.com', '+380 50 222 33 44', 'нашим кур\'єром', 1, 'Київська 20', '7890 5678 1234 3456', 'Дякую', 485.00, '2024-05-02 10:15:20'),
(8, 'Білий спортивний костюм(1390₴)', 'Ковальов Денис Ігорович', 'denys.kovalov@gmail.com', '+380 50 222 33 44', 'самовивіз', 4, 'Лісна 7', '4321 0987 6543 2109', 'Дякую за швидку доставку', 5560.00, '2024-05-03 11:20:45'),
(9, 'Коктейль з Фруктів(129₴)', 'Литвиненко Вікторія Ігорівна', 'viktoria.lit@example.com', '+380 63 444 55 66', 'поштою', 2, 'Соборний 3', '9876 5432 1098 7654', 'Будь ласка, доставте якомога швидше', 258.00, '2024-05-04 12:30:15'),
(10, 'Темно-Зелений спортивний костюм(2000₴)', 'Данилов Денис Петрович', 'den_dan@example.com', '+380 50 666 77 88', 'нашим кур\'єром', 3, 'Центральна 10', '6789 0123 4567 8901', 'Чи є можливість замовити додаткову кількість?', 6000.00, '2024-05-05 13:45:37'),
(11, 'Протеїновий Шейк(199₴)', 'Кравчук Людмила Миколаївна', 'ludmila.krav@example.com', '+380 67 777 88 99', 'самовивіз', 1, 'Петропавлівська 22', '5432 1098 7654 3210', 'Дякую за якісний продукт', 199.00, '2024-05-06 14:55:10'),
(12, 'Гантелі на 1кг(150₴)', 'Михайленко Валентина Віталіївна', 'valya.m@example.com', '+380 66 555 44 33', 'самовивіз', 2, 'Велика Васильківська 30', '6010 1234 5678 9012', 'Дякую за швидку доставку', 300.00, '2024-05-07 15:25:10'),
(13, 'Червоний Спортивний костюм(2150₴)', 'Петренко Анна Михайлівна', 'anya1999@gmail.com', '+380 99 345 33 54', 'поштою', 3, 'Шевченка 94', '4231 4334 6522 5434', 'Будь ласка, доставте якомога швидше', 6450.00, '2024-05-08 16:30:15'),
(14, 'Гантелі на 5кг(485₴)', 'Цекот Максим Васильович', 'max.gord@example.com', '+380 67 333 44 55', 'нашим кур\'єром', 1, 'Соборна 12', '5123 4567 0987 5432', 'Дякую за якісний продукт', 485.00, '2024-05-09 17:45:20'),
(15, 'Гантелі на 15кг(989₴)', 'Сидоренко Юлія Василівна', 'julia_sid@example.com', '+380 50 222 33 44', 'нашим кур\'єром', 2, 'Київська 20', '7890 5678 1234 3456', 'Дякую', 1978.00, '2024-05-10 18:00:00'),
(16, 'Фруктовий Шейк(189₴)', 'Литвиненко Вікторія Ігорівна', 'viktoria.lit@example.com', '+380 63 444 55 66', 'поштою', 3, 'Соборний 3', '9876 5432 1098 7654', 'Будь ласка, доставте якомога швидше', 567.00, '2024-05-11 12:30:00'),
(17, 'Енергетична Експлозія(115₴)', 'Данилов Денис Петрович', 'den_dan@example.com', '+380 50 666 77 88', 'нашим кур\'єром', 4, 'Центральна 10', '6789 0123 4567 8901', 'Чи є можливість замовити додаткову кількість?', 460.00, '2024-05-12 15:45:00'),
(18, 'Молочний Коктейль(149₴)', 'Павлик Анастасія Олексіївна', 'pavlik.anastasiya@example.com', '+380 67 111 22 33', 'самовивіз', 2, 'Головна 14', '4111 2222 3333 4444', 'Дякую', 298.00, '2024-05-13 09:30:00'),
(19, 'Сет "Заряд Нано-Вітамінів"(555₴)', 'Ковальов Ігор Васильович', 'kovalov.igor@example.com', '+380 50 333 44 55', 'поштою', 5, 'Нова 5', '5555 6666 7777 8888', 'Дякую, будь ласка, надішліть швидше', 1110.00, '2024-05-14 10:45:00'),
(20, 'Подвійний запал Папаї(285₴)', 'Орлов Михайло Андрійович', 'orlov.mikhail@example.com', '+380 67 444 55 66', 'нашим кур\'єром', 3, 'Вулиця Героїв 18', '7777 8888 9999 0000', 'Будь ласка, надішліть найякісніший продукт', 855.00, '2024-05-15 12:00:00'),
(21, 'Заряд Зелених Витамінів(199₴)', 'Лисенко Олег Іванович', 'sydorenkOO@gmail.com', '+380 99 453 34 54', 'поштою', 3, 'Соборний 7', '6425 5345 5342 3425', 'Дякую!', 597.00, '2024-05-13 16:07:26');

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
