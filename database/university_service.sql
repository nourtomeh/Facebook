-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2019 at 12:00 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET
SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET
AUTOCOMMIT = 0;
START TRANSACTION;
SET
time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `university_service`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments`
(
    `id`         int(10) NOT NULL,
    `txt`        text         NOT NULL,
    `user_id`    int(10) NOT NULL,
    `post_id`    int(10) NOT NULL,
    `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages`
(
    `id`         int(10) NOT NULL,
    `created_at` date NOT NULL,
    `from_id`    int(10) NOT NULL,
    `to_id`      int(10) NOT NULL,
    `txt`        text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post`
(
    `id`         int(10) NOT NULL,
    `txt`        varchar(1000) NOT NULL,
    `created_at` varchar(255)  NOT NULL,
    `user_id`    int(10) NOT NULL,
    `filepath`   varchar(500)  NOT NULL DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user`
(
    `id`         int(10) NOT NULL,
    `name`       varchar(255) NOT NULL,
    `email`      varchar(255) NOT NULL,
    `password`   varchar(255) NOT NULL,
    `age`        varchar(255) NOT NULL,
    `img`        varchar(255) NOT NULL DEFAULT 'img/default.jpg',
    `major`      varchar(255) NOT NULL DEFAULT '-',
    `university` varchar(255) NOT NULL DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
    ADD PRIMARY KEY (`id`),
  ADD KEY `FK_1` (`post_id`),
  ADD KEY `FK2` (`user_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
    ADD PRIMARY KEY (`id`),
  ADD KEY `from_id` (`from_id`),
  ADD KEY `to_id` (`to_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
    ADD PRIMARY KEY (`id`),
  ADD KEY `FK_PersonOrder` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
    MODIFY `id` int (10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
    MODIFY `id` int (10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
    MODIFY `id` int (10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
    MODIFY `id` int (10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
    ADD CONSTRAINT `FK2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON
DELETE
CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
    ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`from_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`to_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `post`
--
ALTER TABLE `post`
    ADD CONSTRAINT `FK_PersonOrder` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

CREATE TABLE `friendships`
(
    `friendship_id` INT AUTO_INCREMENT PRIMARY KEY,
    `user1_id`      INT,
    `user2_id`      INT,
    `status`        ENUM('pending', 'accepted', 'declined') DEFAULT 'pending',
    `timestamp`     TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user1_id`) REFERENCES `user` (`id`),
    FOREIGN KEY (`user2_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `groups`
(
    `id`         int(10) NOT NULL AUTO_INCREMENT,
    `name`       varchar(255) NOT NULL,
    `created_at` varchar(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `user_groups` (
                               `user_id` int(10) NOT NULL,
                               `group_id` int(10) NOT NULL,
                               PRIMARY KEY (`user_id`, `group_id`),
                               FOREIGN KEY (`user_id`) REFERENCES `user`(`id`) ,
                               FOREIGN KEY (`group_id`) REFERENCES `groups`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;