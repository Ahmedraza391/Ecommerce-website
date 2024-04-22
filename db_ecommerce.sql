-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2024 at 02:24 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_qty` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `product_qty`, `status`) VALUES
(1, 1, 2, 2, 0),
(2, 1, 1, 10, 0),
(5, 1, 3, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `categories` varchar(250) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `categories`, `status`) VALUES
(1, 'Mens Shirts', 1),
(2, 'Mens Shoes', 1),
(3, 'Bags', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `comment` text NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `mobile`, `comment`, `added_on`) VALUES
(2, 'Ahmed Raza', 'ahmed@gmail.com', '3334511446', 'Hello World!', '2024-01-24 11:36:35');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `mrp` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `image` varchar(500) NOT NULL,
  `short_desc` varchar(2000) NOT NULL,
  `description` text NOT NULL,
  `meta_title` varchar(1000) NOT NULL,
  `meta_desc` text NOT NULL,
  `meta_keyword` varchar(2000) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `categories_id`, `name`, `mrp`, `price`, `qty`, `image`, `short_desc`, `description`, `meta_title`, `meta_desc`, `meta_keyword`, `status`) VALUES
(1, 1, 'Polo Shirt', 1500, 1399, 10, 'img/web_image/1,Mens Shirts/Polo Shirt/product-5.jpg', 'Short Descripttion', 'Long Description', 'Meta Title', 'Meta Description', 'Meta Keyword', 1),
(2, 2, 'Nike Shoes', 4000, 2999, 2, 'img/web_image/2,Mens Shoes/Nike Shoes/product-1.jpg', 'Nike Shoes. It is very Soft and Comfortable Shoes. This Shoes is in Affordable Price.', 'Nike Shoes. It is very Soft and Comfortable Shoes. This Shoes is in Affordable Price.Nike Shoes. It is very Soft and Comfortable Shoes. This Shoes is in Affordable Price.Nike Shoes. It is very Soft and Comfortable Shoes. This Shoes is in Affordable Price.Nike Shoes. It is very Soft and Comfortable Shoes. This Shoes is in Affordable Price.Nike Shoes. It is very Soft and Comfortable Shoes. This Shoes is in Affordable Price.Nike Shoes. It is very Soft and Comfortable Shoes. This Shoes is in Affordable Price.Nike Shoes. It is very Soft and Comfortable Shoes. This Shoes is in Affordable Price.Nike Shoes. It is very Soft and Comfortable Shoes. This Shoes is in Affordable Price.', 'Meta Title', 'Meta Description', 'Meta Keyword', 1),
(3, 1, 'Nike Hoddie', 1500, 1300, 12, 'img/web_image/1,Mens Shirts/Nike Hoddie/product-12.jpg', 'High Quality Nike Hoddie.', 'High Quality Nike Hoddie.High Quality Nike Hoddie.High Quality Nike Hoddie.High Quality Nike Hoddie.High Quality Nike Hoddie.High Quality Nike Hoddie.High Quality Nike Hoddie.', 'Meta Title', 'Meta Description', 'Meta Keyword', 1),
(4, 2, 'Addidas Shoes', 3500, 3298, 0, 'img/web_image/2,Mens Shoes/Addidas Shoes/product-3.jpg', 'Beautiful Colored Addidas Shoes in Blue Color.', 'Beautiful Colored Addidas Shoes in Blue Color.Beautiful Colored Addidas Shoes in Blue Color.Beautiful Colored Addidas Shoes in Blue Color.Beautiful Colored Addidas Shoes in Blue Color.Beautiful Colored Addidas Shoes in Blue Color.Beautiful Colored Addidas Shoes in Blue Color.', 'Meta Title', 'Meta Description', 'Meta Keyword', 1),
(5, 1, 'Nike Polo Shirt', 1200, 900, 15, 'img/web_image/1,Mens Shirts/Nike Polo Shirt/product-8.jpg', 'Nice Looked Polo T-Shirt in Very Low Price.', 'Nice Looked Polo T-Shirt in Very Low Price.Nice Looked Polo T-Shirt in Very Low Price.Nice Looked Polo T-Shirt in Very Low Price.Nice Looked Polo T-Shirt in Very Low Price.Nice Looked Polo T-Shirt in Very Low Price.Nice Looked Polo T-Shirt in Very Low Price.Nice Looked Polo T-Shirt in Very Low Price.', 'Meta Title', 'Meta Description', 'Meta Keyword', 1),
(6, 3, 'Nike Bags', 1300, 1000, 10, 'img/web_image/3,Bags/Nike Bags/product-7.jpg', 'Leather Bag with Affordable Price.', 'Leather Bag with Affordable Price.Leather Bag with Affordable Price.Leather Bag with Affordable Price.Leather Bag with Affordable Price.Leather Bag with Affordable Price.Leather Bag with Affordable Price.Leather Bag with Affordable Price.Leather Bag with Affordable Price.Leather Bag with Affordable Price.', 'Meta Title', 'Meta Description', 'Meta Keyword', 1),
(7, 3, 'Addidas Bag', 1600, 1500, 5, 'img/web_image/3,Bags/Addidas Bag/product-11.jpg', 'Addidas Bag With Leather Comfort.', 'Addidas Bag With Leather Comfort.Addidas Bag With Leather Comfort.Addidas Bag With Leather Comfort.Addidas Bag With Leather Comfort.Addidas Bag With Leather Comfort.Addidas Bag With Leather Comfort.Addidas Bag With Leather Comfort.', 'Meta Title', 'Meta Description', 'Meta Keyword', 1),
(8, 3, 'Nike Women Bag', 2000, 1900, 3, 'img/web_image/3,Bags/Nike Women Bag/product-13.jpg', 'Nike Women Bag with Leather Finish.', 'Nike Women Bag with Leather Finish.Nike Women Bag with Leather Finish.Nike Women Bag with Leather Finish.Nike Women Bag with Leather Finish.Nike Women Bag with Leather Finish.Nike Women Bag with Leather Finish.', 'Meta Title', 'Meta Description', 'Meta Keyword', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_mobile` varchar(20) DEFAULT NULL,
  `added_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`, `user_mobile`, `added_on`) VALUES
(1, 'Ahmed Raza', 'ahmed@gmail.com', 'ahmed123', '03269243547', '2024-04-07 05:22:58'),
(2, 'Wahab', 'wahab@gmail.com', 'wahab123', NULL, '2024-04-16 19:52:51'),
(4, 'Nizam', 'nizam@gmail.com', 'nizam123', NULL, '2024-04-16 19:55:39'),
(5, 'Farooq', 'farooq@gmail.com', 'farooq123', NULL, '2024-04-16 19:57:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
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
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
