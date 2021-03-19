-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2021-03-19 04:24:08
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

-- --------------------------------------------------------

--
-- テーブルの構造 `chat_management`
--

CREATE TABLE `chat_management` (
  `management_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `chat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `group_namings`
--

CREATE TABLE `group_namings` (
  `naming_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `chat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `message_logs`
--

CREATE TABLE `message_logs` (
  `log_id` int(11) NOT NULL,
  `chat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` varchar(255) DEFAULT NULL,
  `isfile` blob DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `namings`
--

CREATE TABLE `namings` (
  `naming_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `opponent_id` int(11) NOT NULL,
  `chat_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_icon` blob DEFAULT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_icon`, `user_email`, `user_password`) VALUES
(10, 'ok', NULL, 'example@example.com', '$2y$10$geAb0y8eKPsm98zXuZl6YeGNbo2hBGgqa6Uipb9CSmUNTp5EavW7C'),
(11, 'abc', NULL, 'abc@abc.com', '$2y$10$0WblZlBJwbGZhuTC1po...kQZgwQJXshI6EEeapziGXYZ6ruxS35q');

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
  ADD KEY `opponent_id` (`opponent_id`);

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
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `chat_management`
--
ALTER TABLE `chat_management`
  MODIFY `management_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `group_namings`
--
ALTER TABLE `group_namings`
  MODIFY `naming_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `message_logs`
--
ALTER TABLE `message_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `namings`
--
ALTER TABLE `namings`
  MODIFY `naming_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
  ADD CONSTRAINT `namings_ibfk_2` FOREIGN KEY (`opponent_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
