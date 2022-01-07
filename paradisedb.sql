-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2021 at 12:25 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `paradisedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES
(1, 'Admin', 'admin@gmail.com', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `food_item` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `user_cart_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `food_item`, `quantity`, `user_cart_id`) VALUES
(20, '3', '1', 2, 1),
(21, '3', '2', 2, 1),
(22, '3', '3', 1, 1),
(23, '3', '4', 1, 1),
(24, '3', '5', 1, 1),
(25, '3', '6', 1, 1),
(26, '3', '7', 1, 1),
(27, '3', '1', 2, 5),
(30, '6', '1', 2, 7),
(31, '6', '2', 1, 7),
(32, '6', '3', 2, 7),
(33, '6', '1', 2, 8),
(34, '6', '1', 2, 9),
(35, '6', '1', 1, 11),
(36, '6', '2', 1, 11),
(37, '6', '1', 1, 12),
(38, '6', '1', 1, 13),
(39, '6', '2', 1, 13),
(40, '6', '3', 1, 13),
(41, '6', '1', 1, 14),
(42, '6', '2', 1, 14),
(43, '6', '1', 1, 15),
(44, '6', '2', 1, 15),
(45, '6', '1', 1, 16),
(46, '6', '1', 1, 17),
(47, '6', '2', 1, 17),
(48, '6', '1', 1, 18),
(49, '6', '2', 1, 18),
(50, '6', '1', 1, 19),
(51, '6', '1', 1, 20),
(52, '6', '2', 1, 20),
(53, '6', '1', 1, 21),
(54, '6', '1', 1, 22),
(55, '6', '2', 1, 22),
(56, '6', '3', 1, 22);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `short_desc` varchar(250) NOT NULL,
  `long_desc` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `short_desc`, `long_desc`) VALUES
(7, 'North Indian', 'This is a popular category in Northern India', 'Indian cuisine encompasses a wide variety of regional cuisine native to India. Given the range of diversity in soil type, climate and occupations, these cuisines vary significantly from each other and use locally available chocolates, herbs, vegetables and fruits. The dishes are then served according to taste in either mild, medium or hot. Indian food is also heavily influenced by religious and cultural choices, like Hinduism and traditions.'),
(8, 'Chinese', 'Chinese cuisine is an important part of Chinese culture, which includes cuisine originating from the diverse regions of China.', 'A number of different styles contribute to Chinese cuisine but perhaps the best known and most influential are Cantonese cuisine, Shandong cuisine, Jiangsu cuisine (specifically Huaiyang cuisine) and Sichuan cuisine.'),
(9, 'South Indian', 'South Indian cuisine includes the cuisines of the five southern states of India Andhra Pradesh, Karnataka, Kerala, Tamil Nadu and Telangana.', 'The cuisines of Andhra Pradesh are the spiciest in all of India. Generous use of chili and tamarind make the dishes tangy and hot. The majority of dishes are vegetable or lentil-based.'),
(10, 'Snacks', ' A snack is a small portion of food eaten between meals.', 'A snack is a small portion of food eaten between meals. This may be a snack food, such as potato chips or baby carrots, but can also simply be a small amount of any food.'),
(11, 'Himalayan Food', 'Nepalese cuisine comprises a variety of cuisines based upon ethnicity, soil and climate relating to Nepal cultural diversity and geography.', 'Much of the cuisine is variation on Asian themes. Other foods have hybrid Tibetan, Indian and Thai origins. They were originally filled with buffalo meat but now also with goat or chicken, as well as vegetarian preparations. Special foods such as sel roti, finni roti and patre are eaten during festivals such as Tihar.');

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `id` int(11) NOT NULL,
  `cat_id` int(10) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`id`, `cat_id`, `fname`, `description`, `price`) VALUES
(1, 9, 'Dosa', 'I love Dosa very much. Its a South Indian Food and Everybody loves it!', 100),
(2, 7, 'Egg Role', 'This is a North Indian Pop Food. Everybody likes it so damn very much.', 200),
(3, 8, 'Chowmin', 'This is a Chinese Pop Food. Everybody likes it so damn very much.', 300),
(4, 10, 'French Fries', 'This is a Snacks Food. Everybody likes it so damn very much with Tea or Coffee.', 150),
(5, 11, 'Momos', 'This is a Himalayan Pop Food. Everybody likes it so damn very much. Its comes with different flavors!', 250),
(6, 8, 'Hakka Noodles', 'This food is so much popular even in India. It tastes like Chowmein but with Gravy. ', 350);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_id` varchar(20) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `user_cart_id` varchar(10) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `timestamp` varchar(50) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `user_id`, `user_cart_id`, `user_name`, `timestamp`, `total`) VALUES
(26, 'RSTGF162894', '6', '13', 'Test', '03:12:2021 04:34:14pm', 600),
(27, 'RSTGF570886', '6', '14', 'Test', '03:12:2021 04:34:53pm', 300),
(28, 'RSTGF194558', '6', '15', 'Test', '03:12:2021 04:48:15pm', 300),
(29, 'RSTGF557355', '6', '16', 'Test', '03:12:2021 04:48:20pm', 100),
(30, 'RSTGF468793', '6', '17', 'Test', '03:12:2021 04:49:12pm', 200),
(31, 'RSTGF292391', '6', '18', 'Test', '03:12:2021 04:52:41pm', 300),
(32, 'RSTGF884956', '6', '19', 'Test', '03:12:2021 04:52:48pm', 100),
(33, 'RSTGF415736', '6', '20', 'Test', '03:12:2021 04:52:55pm', 300),
(34, 'RSTGF547396', '6', '21', 'Test', '03:12:2021 04:53:01pm', 100),
(35, 'RSTGF632417', '6', '22', 'Test', '03:12:2021 04:54:39pm', 500);

-- --------------------------------------------------------

--
-- Table structure for table `reserve`
--

CREATE TABLE `reserve` (
  `id` int(11) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `phoneno` varchar(50) NOT NULL,
  `guests` int(11) NOT NULL,
  `requests` text NOT NULL,
  `vaccinated` tinyint(1) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `booking_time` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reserve`
--

INSERT INTO `reserve` (`id`, `user_id`, `phoneno`, `guests`, `requests`, `vaccinated`, `user_name`, `booking_time`) VALUES
(0, '5', '7977954349', 5, 'None', 1, 'Sparsh', '2021-12-02T21:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `timestamp` varchar(100) DEFAULT NULL,
  `no_of_orders` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `timestamp`, `no_of_orders`) VALUES
(3, 'Paradise User', 'sparshtgupta@gmail.com', 'blue1000', '06:08:2019 01:40:08am', 0),
(5, 'Sparsh Gupta', 'sparsh.gupta@somaiya.edu', 'blue1000', '02:12:2021 05:13:28pm', 0),
(6, 'Test', 'test@gmail.com', '12345', '03:12:2021 03:52:53pm', 10);

-- --------------------------------------------------------

--
-- Table structure for table `user_cart`
--

CREATE TABLE `user_cart` (
  `id` int(11) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_cart`
--

INSERT INTO `user_cart` (`id`, `user_id`, `active`) VALUES
(1, '3', 0),
(5, '3', 0),
(6, '3', 1),
(7, '6', 0),
(8, '6', 0),
(9, '6', 0),
(10, '6', 0),
(11, '6', 0),
(12, '6', 0),
(13, '6', 0),
(14, '6', 0),
(15, '6', 0),
(16, '6', 0),
(17, '6', 0),
(18, '6', 0),
(19, '6', 0),
(20, '6', 0),
(21, '6', 0),
(22, '6', 0),
(23, '6', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_cart`
--
ALTER TABLE `user_cart`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_cart`
--
ALTER TABLE `user_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
