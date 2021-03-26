-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2021-03-26 04:52:37
-- サーバのバージョン： 10.4.17-MariaDB
-- PHP のバージョン: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `library_am`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `book_name` varchar(100) NOT NULL,
  `book_genre` varchar(100) NOT NULL,
  `book_author` varchar(100) NOT NULL,
  `date_added` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `books`
--

INSERT INTO `books` (`book_id`, `book_name`, `book_genre`, `book_author`, `date_added`) VALUES
(3, 'Ryaya', 'Fantasy', 'Naoki', '2021-03-19');

-- --------------------------------------------------------

--
-- テーブルの構造 `chat`
--

CREATE TABLE `chat` (
  `chat_id` int(11) NOT NULL,
  `last_modify` timestamp NOT NULL DEFAULT current_timestamp(),
  `chat_type` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `chat`
--

INSERT INTO `chat` (`chat_id`, `last_modify`, `chat_type`) VALUES
(38, '2021-03-26 00:42:15', 0),
(39, '2021-03-26 03:21:31', 1),
(40, '2021-03-26 03:20:02', 1),
(41, '2021-03-26 03:20:27', 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `chat_management`
--

CREATE TABLE `chat_management` (
  `management_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `chat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `chat_management`
--

INSERT INTO `chat_management` (`management_id`, `user_id`, `chat_id`) VALUES
(47, 10, 38),
(48, 11, 38),
(49, 13, 38),
(50, 10, 39),
(51, 11, 39),
(52, 17, 40),
(53, 10, 40),
(54, 17, 41),
(55, 10, 41),
(56, 11, 41),
(57, 13, 41),
(58, 16, 41);

-- --------------------------------------------------------

--
-- テーブルの構造 `group_namings`
--

CREATE TABLE `group_namings` (
  `naming_id` int(11) NOT NULL,
  `chat_name` varchar(255) NOT NULL,
  `chat_id` int(11) NOT NULL,
  `group_icon` varchar(255) NOT NULL DEFAULT './icon/group/default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `group_namings`
--

INSERT INTO `group_namings` (`naming_id`, `chat_name`, `chat_id`, `group_icon`) VALUES
(13, 'ok', 38, './icon/group/default.png'),
(14, 'group6', 41, './icon/group/default.png');

-- --------------------------------------------------------

--
-- テーブルの構造 `message_logs`
--

CREATE TABLE `message_logs` (
  `log_id` int(11) NOT NULL,
  `chat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` varchar(255) DEFAULT NULL,
  `isfile` varchar(255) NOT NULL DEFAULT 'nothing',
  `exists_message` varchar(255) NOT NULL,
  `exists_file` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `message_logs`
--

INSERT INTO `message_logs` (`log_id`, `chat_id`, `user_id`, `message`, `isfile`, `exists_message`, `exists_file`, `date`) VALUES
(71, 38, 10, 'p', 'nothing', 'yes', 'no', '2021-03-26 00:42:15'),
(72, 39, 10, 'nothing', 'images/39/Fri Mar 26 2021 11:12:37 GMT+0900 (日本標準時)icon_default.png', 'no', 'yes', '2021-03-26 02:12:37'),
(73, 39, 10, 'php', 'nothing', 'yes', 'no', '2021-03-26 02:12:51'),
(74, 39, 11, 'p', 'nothing', 'yes', 'no', '2021-03-26 02:16:36'),
(75, 39, 11, 'a', 'nothing', 'yes', 'no', '2021-03-26 02:40:43'),
(76, 40, 17, 'p', 'nothing', 'yes', 'no', '2021-03-26 03:20:02'),
(77, 39, 10, 'nothing', 'images/39/Fri Mar 26 2021 12:21:31 GMT+0900 (日本標準時)72975551 (1).png', 'no', 'yes', '2021-03-26 03:21:31');

-- --------------------------------------------------------

--
-- テーブルの構造 `namings`
--

CREATE TABLE `namings` (
  `naming_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `opponent_id` int(11) NOT NULL,
  `chat_id` int(11) NOT NULL,
  `chat_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `namings`
--

INSERT INTO `namings` (`naming_id`, `user_id`, `opponent_id`, `chat_id`, `chat_name`) VALUES
(69, 10, 11, 39, 'abc'),
(70, 11, 10, 39, 'ok'),
(71, 17, 10, 40, 'naoki'),
(72, 10, 17, 40, 'murata');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_icon` varchar(255) NOT NULL DEFAULT './images/icon_default.png',
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_icon`, `user_email`, `user_password`) VALUES
(10, 'ok', './images/icon_default.png', 'example@example.com', '$2y$10$geAb0y8eKPsm98zXuZl6YeGNbo2hBGgqa6Uipb9CSmUNTp5EavW7C'),
(11, 'abc', './images/icon_default.png', 'abc@abc.com', '$2y$10$0WblZlBJwbGZhuTC1po...kQZgwQJXshI6EEeapziGXYZ6ruxS35q'),
(13, 'user3', './images/icon_default.png', 'user3@example.com', '$2y$10$ZwFgbH0spXyXqD0KfZ5rceknKZKr4gI4kZMHc3yP1doEMoJOQ3YnC'),
(16, 'a', './images/icon_default.png', 'coless115@gmail.com', '$2y$10$NSTHqVX42ssHBREZTd9qp.MBkJsX5qV0HbVRfNxUuspAgFOo0gRsS'),
(17, 'murata', './images/icon_default.png', 'murata@ecc.com', '$2y$10$7EWyj8Q1TKyTFm5.XhSetuHppOWGiPH0juMDbRBq64Nxue1IA2LvO');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`,`book_name`);

--
-- テーブルのインデックス `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chat_id`);

--
-- テーブルのインデックス `chat_management`
--
ALTER TABLE `chat_management`
  ADD PRIMARY KEY (`management_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `chat_id` (`chat_id`);

--
-- テーブルのインデックス `group_namings`
--
ALTER TABLE `group_namings`
  ADD PRIMARY KEY (`naming_id`),
  ADD KEY `chat_id` (`chat_id`);

--
-- テーブルのインデックス `message_logs`
--
ALTER TABLE `message_logs`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `chat_id` (`chat_id`),
  ADD KEY `user_id` (`user_id`);

--
-- テーブルのインデックス `namings`
--
ALTER TABLE `namings`
  ADD PRIMARY KEY (`naming_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `opponent_id` (`opponent_id`),
  ADD KEY `chat_id` (`chat_id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `uique_email` (`user_email`),
  ADD UNIQUE KEY `user_email` (`user_email`),
  ADD KEY `user_id` (`user_id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- テーブルの AUTO_INCREMENT `chat`
--
ALTER TABLE `chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- テーブルの AUTO_INCREMENT `chat_management`
--
ALTER TABLE `chat_management`
  MODIFY `management_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- テーブルの AUTO_INCREMENT `group_namings`
--
ALTER TABLE `group_namings`
  MODIFY `naming_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- テーブルの AUTO_INCREMENT `message_logs`
--
ALTER TABLE `message_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- テーブルの AUTO_INCREMENT `namings`
--
ALTER TABLE `namings`
  MODIFY `naming_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `chat_management`
--
ALTER TABLE `chat_management`
  ADD CONSTRAINT `chat_management_ibfk_1` FOREIGN KEY (`chat_id`) REFERENCES `chat` (`chat_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `chat_management_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;

--
-- テーブルの制約 `group_namings`
--
ALTER TABLE `group_namings`
  ADD CONSTRAINT `group_namings_ibfk_1` FOREIGN KEY (`chat_id`) REFERENCES `chat` (`chat_id`) ON UPDATE CASCADE;

--
-- テーブルの制約 `message_logs`
--
ALTER TABLE `message_logs`
  ADD CONSTRAINT `message_logs_ibfk_1` FOREIGN KEY (`chat_id`) REFERENCES `chat` (`chat_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `message_logs_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;

--
-- テーブルの制約 `namings`
--
ALTER TABLE `namings`
  ADD CONSTRAINT `namings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `namings_ibfk_2` FOREIGN KEY (`opponent_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `namings_ibfk_3` FOREIGN KEY (`chat_id`) REFERENCES `chat` (`chat_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
