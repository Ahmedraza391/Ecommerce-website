-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2024 at 09:11 PM
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
(11, 13, 9, 1, 1),
(12, 4, 8, 1, 1);

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
-- Table structure for table `contact_notification`
--

CREATE TABLE `contact_notification` (
  `id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'unseen'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_notification`
--

INSERT INTO `contact_notification` (`id`, `contact_id`, `status`) VALUES
(1, 4, 'seen'),
(2, 13, 'seen');

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
  `added_on` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `mobile`, `comment`, `added_on`) VALUES
(2, 'Ahmed Raza', 'ahmed@gmail.com', '3334511446', 'Hello World!', '2024-01-24 11:36:35'),
(3, 'Coderz', 'uzairkhan@gmail.com', '03269243547', 'This is message is for testing.', '0000-00-00 00:00:00'),
(4, 'Coderz', 'uzairkhan@gmail.com', '03269243547', 'This is message is for testing.', '31-05-2024 01:26:24'),
(5, 'Shahbaz Khan', 'shahbaz@gmail.com', '5692635659', 'Your Website is Amazing!', '31-05-2024 01:27:53'),
(6, 'Raza Khan', '0326ahmedaptech@gmail.com', '12352361', 'Hello From Raza!', '12-06-2024 03:01:56'),
(7, 'Raza Khan', '0326ahmedaptech@gmail.com', '12352361', 'Hello From Raza!', '12-06-2024 03:04:24'),
(8, 'Rahul', 'rahtw@navalcadets.com', '5653455645', 'Heelo from rahulQ', '14-06-2024 01:13:19');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_qty` int(11) NOT NULL,
  `product_price` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `user_id`, `product_id`, `product_qty`, `product_price`) VALUES
(1, 1, 3, 7, 1, 1500),
(2, 2, 4, 6, 2, 1000),
(3, 3, 13, 8, 1, 1900);

-- --------------------------------------------------------

--
-- Table structure for table `order_notification`
--

CREATE TABLE `order_notification` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'unseen'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_notification`
--

INSERT INTO `order_notification` (`id`, `order_id`, `status`) VALUES
(1, 2, 'seen'),
(2, 3, 'seen');

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
(1, 1, 'Polo Shirt', 1500, 1399, 20, 'img/web_image/1,Mens Shirts/Polo Shirt/product-5.jpg', 'Short Descripttion', 'Long Description', 'Meta Title', 'Meta Description', 'Meta Keyword', 1),
(2, 2, 'Nike Shoes', 4000, 2999, 27, 'img/web_image/2,Mens Shoes/Nike Shoes/product-1.jpg', 'Nike Shoes. It is very Soft and Comfortable Shoes. This Shoes is in Affordable Price.', 'Nike Shoes. It is very Soft and Comfortable Shoes. This Shoes is in Affordable Price.Nike Shoes. It is very Soft and Comfortable Shoes. This Shoes is in Affordable Price.Nike Shoes. It is very Soft and Comfortable Shoes. This Shoes is in Affordable Price.Nike Shoes. It is very Soft and Comfortable Shoes. This Shoes is in Affordable Price.Nike Shoes. It is very Soft and Comfortable Shoes. This Shoes is in Affordable Price.Nike Shoes. It is very Soft and Comfortable Shoes. This Shoes is in Affordable Price.Nike Shoes. It is very Soft and Comfortable Shoes. This Shoes is in Affordable Price.Nike Shoes. It is very Soft and Comfortable Shoes. This Shoes is in Affordable Price.', 'Meta Title', 'Meta Description', 'Meta Keyword', 1),
(3, 1, 'Nike Hoddie', 1500, 1300, 9, 'img/web_image/1,Mens Shirts/Nike Hoddie/product-12.jpg', 'High Quality Nike Hoddie.', 'High Quality Nike Hoddie.High Quality Nike Hoddie.High Quality Nike Hoddie.High Quality Nike Hoddie.High Quality Nike Hoddie.High Quality Nike Hoddie.High Quality Nike Hoddie.', 'Meta Title', 'Meta Description', 'Meta Keyword', 1),
(4, 2, 'Addidas Shoes', 3500, 3298, 0, 'img/web_image/2,Mens Shoes/Addidas Shoes/product-3.jpg', 'Beautiful Colored Addidas Shoes in Blue Color.', 'Beautiful Colored Addidas Shoes in Blue Color.Beautiful Colored Addidas Shoes in Blue Color.Beautiful Colored Addidas Shoes in Blue Color.Beautiful Colored Addidas Shoes in Blue Color.Beautiful Colored Addidas Shoes in Blue Color.Beautiful Colored Addidas Shoes in Blue Color.', 'Meta Title', 'Meta Description', 'Meta Keyword', 1),
(5, 1, 'Nike Polo Shirt', 1200, 900, 11, 'img/web_image/1,Mens Shirts/Nike Polo Shirt/product-8.jpg', 'Nice Looked Polo T-Shirt in Very Low Price.', 'Nice Looked Polo T-Shirt in Very Low Price.Nice Looked Polo T-Shirt in Very Low Price.Nice Looked Polo T-Shirt in Very Low Price.Nice Looked Polo T-Shirt in Very Low Price.Nice Looked Polo T-Shirt in Very Low Price.Nice Looked Polo T-Shirt in Very Low Price.Nice Looked Polo T-Shirt in Very Low Price.', 'Meta Title', 'Meta Description', 'Meta Keyword', 1),
(6, 3, 'Nike Bags', 1300, 1000, 4, 'img/web_image/3,Bags/Nike Bags/product-7.jpg', 'Leather Bag with Affordable Price.', 'Leather Bag with Affordable Price.Leather Bag with Affordable Price.Leather Bag with Affordable Price.Leather Bag with Affordable Price.Leather Bag with Affordable Price.Leather Bag with Affordable Price.Leather Bag with Affordable Price.Leather Bag with Affordable Price.Leather Bag with Affordable Price.', 'Meta Title', 'Meta Description', 'Meta Keyword', 1),
(7, 3, 'Addidas Bag', 1600, 1500, 0, 'img/web_image/3,Bags/Addidas Bag/product-11.jpg', 'Addidas Bag With Leather Comfort.', 'Addidas Bag With Leather Comfort.Addidas Bag With Leather Comfort.Addidas Bag With Leather Comfort.Addidas Bag With Leather Comfort.Addidas Bag With Leather Comfort.Addidas Bag With Leather Comfort.Addidas Bag With Leather Comfort.', 'Meta Title', 'Meta Description', 'Meta Keyword', 1),
(8, 3, 'Nike Women Bag', 2000, 1900, 1, 'img/web_image/3,Bags/Nike Women Bag/product-13.jpg', 'Nike Women Bag with Leather Finish.', 'Nike Women Bag with Leather Finish.Nike Women Bag with Leather Finish.Nike Women Bag with Leather Finish.Nike Women Bag with Leather Finish.Nike Women Bag with Leather Finish.Nike Women Bag with Leather Finish.', 'Meta Title', 'Meta Description', 'Meta Keyword', 1),
(9, 2, 'K-Swiss Shoes', 10000, 8000, 12, 'img/web_image/2,Mens Shoes/K-Swiss Shoes/product-15.jpg', 'This is Very Fabulas Shoes & its Design is Amazing.', 'This is Very Fabulas Shoes & its Design is Amazing.This is Very Fabulas Shoes & its Design is Amazing.This is Very Fabulas Shoes & its Design is Amazing.This is Very Fabulas Shoes & its Design is Amazing.This is Very Fabulas Shoes & its Design is Amazing.This is Very Fabulas Shoes & its Design is Amazing.This is Very Fabulas Shoes & its Design is Amazing.This is Very Fabulas Shoes & its Design is Amazing.This is Very Fabulas Shoes & its Design is Amazing.This is Very Fabulas Shoes & its Design is Amazing.This is Very Fabulas Shoes & its Design is Amazing.', 'Meta Title', 'Meta Description', 'Meta Keyword', 1),
(10, 2, 'Nike Air Max', 15000, 10000, 30, 'img/web_image/2,Mens Shoes/Nike Air Max/product-16.jpg', 'Nike Air Max shoes are a line of sneakers known for their innovative air cushioning technology, which provides exceptional comfort and impact protection. Introduced in 1987, these shoes feature a visible air unit in the sole, combining performance with a distinctive, stylish design. The Air Max series has become iconic in both sports and streetwear, celebrated for its versatility, durability, and continuous evolution in design and technology.', 'Nike Air Max shoes are a prominent line of athletic footwear produced by Nike, first introduced in 1987. They are celebrated for their innovative design, exceptional comfort, and distinctive aesthetic. Here are the detailed features and design elements that define Nike Air Max shoes:\r\nKey Features:\r\nVisible Air Cushioning:\r\n\r\nAir-Sole Unit:The hallmark of Nike Air Max is the visible Air-Sole unit in the midsole, providing cushioning and impact absorption. This technology offers lightweight cushioning and a distinctive look.\r\nMax Air:Enhanced version of the Air-Sole unit for greater impact protection and comfort, typically more prominent and visible in newer models.\r\nUpper Construction:\r\nMaterials:Made from a combination of materials including mesh, leather, synthetic fabrics, and Flyknit for varying degrees of breathability, flexibility, and support.\r\nDesign: Often features bold, vibrant colorways and patterns, with some models designed by renowned artists or featuring limited edition collaborations.\r\n\r\nOutsole Design:\r\nRubber Outsole:Durable rubber outsoles with patterned treads for excellent traction and stability.\r\nFlex Grooves:Incorporated in many models for enhanced flexibility and a more natural range of motion.\r\nMidsole:\r\n\r\nFoam Midsole: Typically includes a lightweight foam midsole for additional cushioning and support.\r\nDual-Density Foam: Some models feature dual-density foam for a softer ride and more stability.\r\nPerformance and Comfort:\r\n\r\nLightweight: Designed to be lightweight, reducing foot fatigue during extended wear.\r\nBreathability: Ventilation features like mesh panels or engineered perforations to keep feet cool and dry.\r\nPopular Models:\r\nAir Max 1:\r\n\r\nThe original Air Max model, featuring a smaller visible Air unit and a classic silhouette.\r\nAir Max 90:\r\n\r\nKnown for its larger Air unit and iconic design, celebrated for its versatility and comfort.\r\nAir Max 95:\r\n\r\nFeatures multiple visible Air units in the forefoot and heel, inspired by the human anatomy.\r\nAir Max 97:\r\n\r\nRecognizable by its sleek, bullet-train-inspired design and full-length visible Air unit.\r\nAir Max 270:\r\n\r\nCombines lifestyle and performance elements with the largest Air unit in the heel for superior cushioning.\r\nAir Max 720:\r\n\r\nOffers a full-length Air unit that wraps around the entire sole, providing unprecedented cushioning.\r\nStyle and Versatility:\r\nCasual Wear: Air Max shoes are popular for everyday wear due to their comfort and stylish designs.\r\nAthletic Use: While some models are optimized for running and training, most are designed for casual or lifestyle purposes.\r\nCollaborations and Limited Editions: Nike frequently collaborates with designers, artists, and other brands, resulting in unique and highly sought-after limited editions.\r\nInnovation and Evolution:\r\nSustainability: Recent models incorporate sustainable materials as part of Nike’s Move to Zero initiative.\r\nTechnological Advances: Continual enhancements in Air cushioning technology and materials ensure improved performance and comfort in new models.\r\nNike Air Max shoes combine cutting-edge technology with bold designs, making them a staple in both athletic and fashion circles.', 'Meta Title', 'Meta Description', 'Meta Keyword', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slider`
--

CREATE TABLE `tbl_slider` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_image` text NOT NULL,
  `product_desc` text NOT NULL,
  `anchor_page` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'show'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_slider`
--

INSERT INTO `tbl_slider` (`id`, `product_id`, `product_image`, `product_desc`, `anchor_page`, `status`) VALUES
(1, 9, 'img/web_image/slider_image/2/shoes_image_1.jpg', 'K-Swiss Shoes in Sale 30% Off', 'product_details.php?id=9', 'show'),
(2, 10, 'img/web_image/slider_image/4/shoes_image_2.jpg', '\"Experience Unmatched Comfort and Style with Nike Air Max Shoes – Elevate Your Game Today!\"', 'product_details.php?id=10', 'show');

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
  `user_address_1` text NOT NULL,
  `user_postcode` int(11) NOT NULL,
  `user_city` varchar(100) NOT NULL DEFAULT 'Karachi',
  `user_country` varchar(100) NOT NULL DEFAULT 'Pakistan',
  `verification_code` varchar(255) NOT NULL,
  `is_verified` int(11) NOT NULL DEFAULT 0,
  `added_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`, `user_mobile`, `user_address_1`, `user_postcode`, `user_city`, `user_country`, `verification_code`, `is_verified`, `added_on`) VALUES
(3, 'Coderz', 'ar03126655@gmail.com', 'ahmed123', '03269243547', '437 new iqbalabad drigh road karachi', 0, 'Karachi', 'Pakistan', '865a40df8b256115a9f97f976b45b413', 1, '2024-05-04 15:16:15'),
(4, 'Raza Jutt', '0326ahmedaptech@gmail.com', 'raza123', '03269243547', '437 new iqbalabad drigh road karachi', 0, 'Karachi', 'Pakistan', '027814d2b4ac312ffe69b61ee242ff78', 1, '2024-05-04 15:17:41'),
(5, 'Fahad Khan ', '03120ahmedjutt@gmail.com', 'fahad123', '03269243547', '437 new iqbalabad drigh road karachi', 0, 'Karachi', 'Pakistan', 'b7efc83ee2646890c2248380c671575f', 0, '2024-05-05 13:47:21'),
(10, 'Naseem Shah', '0312ahmedjutt@gmail.com', 'naseem123', '03269243547', '437 new iqbalabad drigh road karachi', 0, 'Karachi', 'Pakistan', '5a5fb02ec89321c292e7e99225584876', 1, '2024-06-10 19:30:33'),
(11, 'Sogea', 'sogege2917@fna6.com', 'sogea123', '216544655', 'ABC XYZ 123', 0, 'Karachi', 'Pakistan', '8539f0c4c3d5a176dd2f7b4cb00155a0', 0, '2024-06-13 21:25:12'),
(12, 'Sogea', 'yv1sv@navalcadets.com', 'sogea123', '234654564', 'ABC XYZ 123', 0, 'Karachi', 'Pakistan', '9ca8c997d431a5379ea0639e839461f4', 1, '2024-06-13 21:27:24'),
(13, 'rahul', 'rahtw@navalcadets.com', 'rahul123', '5474546', 'XYZ 321 ABV', 0, 'Karachi', 'Pakistan', 'e3f17084779e732ae8002b7fe7b316c0', 1, '2024-06-13 22:09:36'),
(14, 'rashmika', 'xanipa8386@cnurbano.com', 'rashmika123', '6546532465', 'ajksflaksdfljslfjsajdfsjafj ', 0, 'Karachi', 'Pakistan', 'bc1964e57c13dd20811ad370ff063b7d', 1, '2024-06-13 22:27:30');

-- --------------------------------------------------------

--
-- Table structure for table `users_notification`
--

CREATE TABLE `users_notification` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'unseen'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_notification`
--

INSERT INTO `users_notification` (`id`, `users_id`, `status`) VALUES
(1, 10, 'seen'),
(2, 12, 'seen'),
(3, 13, 'seen'),
(4, 14, 'seen');

-- --------------------------------------------------------

--
-- Table structure for table `user_order`
--

CREATE TABLE `user_order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_mobile` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(250) NOT NULL DEFAULT 'Karachi',
  `country` varchar(250) NOT NULL DEFAULT 'Pakistan',
  `payment_type` varchar(20) NOT NULL,
  `payment_status` varchar(20) NOT NULL,
  `total_price` bigint(20) NOT NULL,
  `order_status` varchar(20) NOT NULL DEFAULT 'pending',
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_order`
--

INSERT INTO `user_order` (`id`, `user_id`, `user_mobile`, `address`, `city`, `country`, `payment_type`, `payment_status`, `total_price`, `order_status`, `added_on`) VALUES
(1, 3, '03269243547', '437 new iqbalabad drigh road karachi', 'Karachi', 'Pakistan', 'cod', 'success', 1500, 'pending', '2024-05-24 18:40:50'),
(2, 4, '03269243547', '437 new iqbalabad drigh road karachi', 'Karachi', 'Pakistan', 'cod', 'success', 2000, 'delivered', '2024-06-12 20:27:07'),
(3, 13, '5474546', 'XYZ 321 ABV', 'Karachi', 'Pakistan', 'cod', 'success', 1900, 'delivered', '2024-06-13 22:28:29');

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
-- Indexes for table `contact_notification`
--
ALTER TABLE `contact_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_notification`
--
ALTER TABLE `order_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_slider`
--
ALTER TABLE `tbl_slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_notification`
--
ALTER TABLE `users_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_order`
--
ALTER TABLE `user_order`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact_notification`
--
ALTER TABLE `contact_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_notification`
--
ALTER TABLE `order_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_slider`
--
ALTER TABLE `tbl_slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users_notification`
--
ALTER TABLE `users_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_order`
--
ALTER TABLE `user_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
