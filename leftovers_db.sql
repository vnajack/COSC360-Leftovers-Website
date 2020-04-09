-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2020 at 05:59 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `leftovers_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `eventID` int(11) NOT NULL,
  `eventTitle` varchar(45) NOT NULL,
  `eventPoster` varchar(100) DEFAULT NULL,
  `eventDate` datetime NOT NULL,
  `eventLocation` varchar(50) NOT NULL,
  `eventDescription` varchar(1000) NOT NULL,
  `creatorUsername` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`eventID`, `eventTitle`, `eventPoster`, `eventDate`, `eventLocation`, `eventDescription`, `creatorUsername`) VALUES
(2, 'How-to Kombucha', '2019-04-12-How-to Kombucha.jpg', '2019-04-12 18:00:00', 'Upper Collegium', 'More information for this event.', NULL),
(3, 'How-to Pickle', '2019-02-13-How-to Pickle.jpg', '2019-02-13 17:00:00', 'Upper Collegium', 'More information here!', NULL),
(5, 'Easy Recipes', '2020-04-03-Easy Recipes.png', '2020-04-03 12:00:00', 'UNC', 'Learn some easy recipes', NULL),
(13, 'How to Pickle', '2020-04-15-How to Pickle.jpg', '2020-04-15 14:00:00', 'Global Collegium', 'Learn how to pickle pretty much anything. We supply the ingredients. You bring your own jar!', 'MistyTheGreat');

-- --------------------------------------------------------

--
-- Table structure for table `fooddonation`
--

CREATE TABLE `fooddonation` (
  `id` int(11) NOT NULL,
  `donor` varchar(80) NOT NULL,
  `foodDescription` varchar(200) NOT NULL,
  `kg` varchar(10) NOT NULL,
  `pickUpDate` datetime NOT NULL,
  `eventName` varchar(100) DEFAULT NULL,
  `eventLocation` varchar(50) DEFAULT NULL,
  `eventContact` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fooddonation`
--

INSERT INTO `fooddonation` (`id`, `donor`, `foodDescription`, `kg`, `pickUpDate`, `eventName`, `eventLocation`, `eventContact`) VALUES
(1, 'sunshine', 'test', '50', '2020-04-16 10:00:00', '', '', NULL),
(3, 'sunshine', 'Apples', '5', '2020-04-06 16:00:00', '', '', NULL),
(4, 'other', 'A lot of fresh apples', '1', '2020-04-08 15:00:00', 'Student name', 'Foyer of the library', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `foodpost`
--

CREATE TABLE `foodpost` (
  `postID` int(11) NOT NULL,
  `timeOfPost` datetime NOT NULL,
  `minutesSafe` int(11) NOT NULL,
  `postFoodItems` varchar(80) NOT NULL,
  `postDescription` varchar(200) NOT NULL,
  `postLocation` varchar(50) NOT NULL,
  `postAmount` int(11) NOT NULL,
  `postPicture` varchar(125) NOT NULL,
  `donorName` varchar(80) DEFAULT NULL,
  `postUsername` varchar(50) DEFAULT NULL,
  `postEditUsername` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `foodpost`
--

INSERT INTO `foodpost` (`postID`, `timeOfPost`, `minutesSafe`, `postFoodItems`, `postDescription`, `postLocation`, `postAmount`, `postPicture`, `donorName`, `postUsername`, `postEditUsername`) VALUES
(1, '2020-01-15 10:03:00', 30, 'Scones, Iced Coffee, Kashi bars, and Smoothies', 'Free scones, ice coffee, Kashi bars, and smoothies in the Global Collegia EME!!', 'Global Collegia in EME', 1, '2020-01-15-1003.jpg', NULL, NULL, NULL),
(2, '2020-01-07 13:20:00', 30, 'Pastries, Juice, and Kashi bars', 'Welcome back from winter break! Here are some pastries, juice, and Kashi bars!', 'UNC collegia', 2, '2020-01-07-1320.jpg', NULL, NULL, NULL),
(3, '2019-12-13 13:40:00', 30, 'Lasagna and Sandwiches', 'Come grab some fuel! Beef and spinach lasagna, veggie lasagna, and veggie sandwiches!', 'Global collegia', 3, '2019-12-13-1340.jpg', NULL, NULL, NULL),
(4, '2019-12-12 15:55:00', 30, 'Sandwiches and Chicken', 'Leftovers from Sunshine!', 'The Pantry\'s fridge and freezer (UNC)', 2, '2019-12-12-1555.jpg', NULL, NULL, NULL),
(8, '2020-04-05 16:27:38', 20, 'Variety of Sandwiches', '', 'Global and UNC Collegia', 5, '2020-04-02-01-00-sandwiches.jpg', 'Sunshine', 'MistyTheGreat', 'MistyTheGreat');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `typeOfUser` varchar(20) NOT NULL,
  `yearOfStudy` int(11) DEFAULT NULL,
  `program` varchar(30) DEFAULT NULL,
  `whyVolunteer` varchar(100) NOT NULL,
  `availabilityChoices` varchar(50) DEFAULT NULL,
  `skills` varchar(250) DEFAULT NULL,
  `other` varchar(500) DEFAULT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `profilePicture` varchar(100) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `phonenum` varchar(20) DEFAULT NULL,
  `securityQuestion` varchar(50) NOT NULL,
  `securityResponse` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `name`, `typeOfUser`, `yearOfStudy`, `program`, `whyVolunteer`, `availabilityChoices`, `skills`, `other`, `username`, `password`, `profilePicture`, `email`, `phonenum`, `securityQuestion`, `securityResponse`) VALUES
(1, 'Misty', 'Admin', 3, 'Environmental Studies', 'I want to do my part in reducing food waste on campus, and I would like to help with initiatives tha', 'Any time', 'Public speaking, cooking', 'I have a ton of experience with public speaking both outdoors and indoors, and I have cat-like reflexes.', 'MistyTheGreat', '123456', 'MistyTheGreat-2020-04-06.jpg', 'misty_theGreatCat@email.com', '123-123-1234', 'Q1', 'Dipstick'),
(9, 'Ellie Bean', 'Volunteer', 1, 'Psychology', 'I want free food.', 'Any time', 'Good with people.', 'I take many naps during the day, but I always wake up to the sound of free food.', 'TheBean', '123456', 'TheBean-2020-04-05.jpg', 'ellie@email.ca', '123-123-1234', 'Q2', 'Joel'),
(10, 'Joel', 'Pending Applicant', 1, 'Environmental Sciences', 'I want to help reduce food waste on campus!', 'Any time', 'Public speaking, adaptable, marketing', NULL, 'joel-is-awesome', '123456', 'joel-is-awesome-2020-04-04.jpg', 'joel@email.ca', '123-456-1234', 'Q2', 'Ellie'),
(15, 'Apples', 'Volunteer', 1, '', 'I want to reduce food waste', 'Any time', '', NULL, 'saveFood', 'foodisYummy', 'saveFood-2020-04-08.jpg', 'helpSaveFoodAtUBCO@gmail.com', '', 'Q1', 'answer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`eventID`),
  ADD KEY `creatorUserID` (`creatorUsername`);

--
-- Indexes for table `fooddonation`
--
ALTER TABLE `fooddonation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `foodpost`
--
ALTER TABLE `foodpost`
  ADD PRIMARY KEY (`postID`),
  ADD UNIQUE KEY `postID` (`postID`),
  ADD KEY `postUserID` (`postUsername`),
  ADD KEY `postUserID_2` (`postUsername`),
  ADD KEY `postEditUsername` (`postEditUsername`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `id` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `eventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `fooddonation`
--
ALTER TABLE `fooddonation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `foodpost`
--
ALTER TABLE `foodpost`
  MODIFY `postID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`creatorUsername`) REFERENCES `users` (`username`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `foodpost`
--
ALTER TABLE `foodpost`
  ADD CONSTRAINT `foodpost_ibfk_1` FOREIGN KEY (`postUsername`) REFERENCES `users` (`username`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `foodpost_ibfk_2` FOREIGN KEY (`postEditUsername`) REFERENCES `users` (`username`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
