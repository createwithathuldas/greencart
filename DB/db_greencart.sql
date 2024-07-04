-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2024 at 10:59 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_greencart`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'Admin', 'admin@gmail.com', '123'),
(2, 'Administrator', 'a@gmail.com', 'a123');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin_complaint`
--

CREATE TABLE `tbl_admin_complaint` (
  `admin_complaint_id` int(11) NOT NULL,
  `admin_complaint_content` varchar(500) NOT NULL,
  `admin_complaint_reply` varchar(500) NOT NULL,
  `admin_complaint_time` varchar(100) NOT NULL,
  `admin_complaint_del_status` tinyint(4) NOT NULL,
  `complaint_type_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin_complaint`
--

INSERT INTO `tbl_admin_complaint` (`admin_complaint_id`, `admin_complaint_content`, `admin_complaint_reply`, `admin_complaint_time`, `admin_complaint_del_status`, `complaint_type_id`, `user_id`, `shop_id`) VALUES
(9, 'loading error', '', '2023-12-30 13:25:59', 0, 8, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cart_id` int(11) NOT NULL,
  `cart_quantity` int(11) NOT NULL,
  `cart_del_status` tinyint(1) NOT NULL,
  `plant_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`cart_id`, `cart_quantity`, `cart_del_status`, `plant_id`, `user_id`) VALUES
(123, 6, 1, 22, 3),
(124, 6, 1, 20, 3),
(125, 5, 0, 23, 3),
(126, 1, 0, 22, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_city`
--

CREATE TABLE `tbl_city` (
  `city_id` int(11) NOT NULL,
  `city_name` varchar(100) NOT NULL,
  `city_del_status` tinyint(1) NOT NULL,
  `district_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_city`
--

INSERT INTO `tbl_city` (`city_id`, `city_name`, `city_del_status`, `district_id`) VALUES
(28, 'Pappanamcode', 0, 36),
(29, 'Kaithamukku', 0, 36),
(30, 'Kazhakkoottam', 0, 36),
(31, 'Vattiyoorkavu', 0, 36),
(32, 'Karamana', 0, 36),
(33, 'Kovalam', 0, 36),
(34, 'Ambalamukku', 0, 36),
(35, 'Karimankulam', 0, 36),
(36, 'Kumarapuram', 0, 36),
(37, 'Anayara', 0, 36),
(38, 'Karyavattom', 0, 36),
(39, 'Kuravankonam', 0, 36),
(40, 'Mannanthala', 0, 36),
(41, 'Peroorkada', 0, 36),
(42, 'Sasthamangalam', 0, 36),
(43, 'Pallithuravvvvvv', 1, 36),
(44, 'Pothencode', 0, 36),
(45, 'Sreekariyam', 0, 36),
(46, 'Pangappara', 0, 36),
(47, 'PTP Nagar', 0, 36),
(48, 'Uliyazhathura', 0, 36),
(49, 'Paruthippara', 0, 36),
(50, 'Pulimoodu', 0, 36),
(51, 'Ulloor', 0, 36),
(52, 'Vazhuthacaud', 0, 36),
(53, 'Chacka', 0, 36),
(54, 'Kesavadasapuram', 0, 36),
(55, 'Vellayambalam', 0, 36),
(56, 'Chenkottukonam', 0, 36),
(57, 'Kowdiar', 0, 36),
(58, 'Aakkulam', 0, 36),
(59, 'Karakulam', 0, 36),
(60, 'Kulathoor', 0, 36),
(61, 'Ambalathara', 0, 36),
(62, 'Karinkadamugal', 0, 36),
(63, 'Mangalapuram', 0, 36),
(64, 'Mukkolakkal', 0, 36),
(65, 'Palayam', 0, 36),
(66, 'Pattom', 0, 36),
(67, 'Muttada', 0, 36),
(68, 'Pallippuram', 0, 36),
(69, 'Perukavu', 0, 36),
(70, 'Nanthancodu', 0, 36),
(71, 'Pangodu', 0, 36),
(72, 'Pettah', 0, 36),
(73, 'Nemom', 0, 36),
(74, 'Parottukonam', 0, 36),
(75, 'Pongumoodu', 0, 36),
(76, 'Poojapura', 0, 36),
(77, 'Punnakkamugal', 0, 36),
(78, 'Thycaud', 0, 36),
(79, 'Alangad', 0, 42),
(80, 'Aluva', 0, 36),
(81, 'Amballur', 0, 42),
(82, 'Angamaly', 0, 42),
(83, 'Chelamattom', 0, 42),
(84, 'Chendamangalam', 0, 42),
(85, 'Chengamanad', 0, 42),
(86, 'Cheranallur', 0, 42),
(87, 'Choornikkara', 0, 42),
(88, 'Chowwara', 0, 42),
(89, 'Edathala', 0, 42),
(90, 'Elamkunnapuzha', 0, 42),
(91, 'Eloor', 0, 42),
(92, 'Eramalloor', 0, 42),
(93, 'Kadamakkudy', 0, 42),
(94, 'Kadungalloor', 0, 42),
(95, 'Kakkanad', 0, 42),
(96, 'Kalady', 0, 42),
(97, 'Kalamassery', 0, 42),
(98, 'Kanayannur', 0, 42),
(99, 'Karumalloor', 0, 42),
(100, 'Kizhakkumbhagom', 0, 42),
(101, 'Kochi [Cochin]', 0, 42),
(102, 'Koovappady', 0, 42),
(103, 'Kothamangalam', 0, 42),
(104, 'Kottuvally', 0, 42),
(105, 'Vengola', 0, 42),
(106, 'Velloorkunnam', 0, 42),
(107, 'Vazhakulam', 0, 42),
(108, 'Vazhakkala', 0, 42),
(109, 'Varappuzha', 0, 42),
(110, 'Vadakkumbhagom', 0, 42),
(111, 'Vadakkekara', 0, 42),
(112, 'Thrippunithura', 0, 42),
(113, 'Thiruvankulam', 0, 42),
(114, 'Thekkumbhagom', 0, 42),
(115, 'Puthuvype', 0, 42),
(116, 'Puthenvelikkara', 0, 42),
(117, 'Puthencruz', 0, 42),
(118, 'Perumbavoor', 0, 42),
(119, 'Paravur', 0, 42),
(120, 'Njarackal', 0, 42),
(121, 'Nedumbassery', 0, 42),
(122, 'Muvattupuzha', 0, 42),
(123, 'Mulavukad', 0, 42),
(124, 'Mulamthuruthy', 0, 42),
(125, 'Moothakunnam', 0, 42),
(126, 'Mattoor', 0, 42),
(127, 'Marampilly', 0, 41),
(128, 'Maradu', 0, 42),
(129, 'Manakunnam', 0, 42),
(130, 'Kureekkad', 0, 42),
(131, 'Kunnathunad', 0, 42),
(132, 'Kumbalangy', 0, 42),
(133, 'Kumbalam', 0, 42),
(134, 'Changanacherry', 0, 40),
(135, 'Chethipuzha', 0, 40),
(136, 'Kangazha', 0, 40),
(137, 'Karukachal', 0, 40),
(138, 'Kurichy', 0, 40),
(139, 'Madappally', 0, 40),
(140, 'Nedumkunnam', 0, 40),
(141, 'Paippadu', 0, 40),
(142, 'Thottakkadu', 0, 40),
(143, ' Thrikkodithanam', 0, 40),
(144, 'Vakathanam', 0, 40),
(145, 'Vazhappally (E)', 0, 40),
(146, 'Vazhappally (W)', 0, 40),
(147, 'Vazhoor', 0, 40),
(148, 'Vellavoor', 0, 40),
(149, 'Cheruvalley', 0, 40),
(150, 'Chirakadavu', 0, 40),
(151, 'Edakkunnam', 0, 40),
(152, 'Elamkulam', 0, 40),
(153, 'Elikulam', 0, 40),
(154, 'Erumely (N)', 0, 40),
(155, 'Erumely (S)', 0, 40),
(156, 'Kanjirappally', 0, 40),
(157, 'Koottickal', 0, 40),
(158, 'Koovappally', 0, 40),
(159, 'Mundakayam', 0, 40),
(160, ' Anicadu', 0, 40),
(161, 'Arpookara', 0, 40),
(162, 'Athirampuzha', 0, 40),
(163, 'Ettumanoor', 0, 40),
(164, 'Kottayam', 0, 40),
(165, 'Kumarakom', 0, 40),
(166, 'Manarcadu', 0, 40),
(167, 'Nattakom', 0, 40),
(168, 'Pampady', 0, 40),
(169, 'Peroor', 0, 40),
(170, 'Puthuppally', 0, 40),
(171, ' Veloor', 0, 40),
(172, 'Bharananganam', 0, 40),
(173, 'Erattupetta', 0, 40),
(174, 'Kidangoor', 0, 40),
(175, 'Kuravilangadu', 0, 40),
(176, 'Kurichithanam', 0, 40),
(177, 'Meenachil', 0, 40),
(178, 'Poonjar', 0, 40),
(179, 'Ramapuram', 0, 40),
(180, 'Theekoy', 0, 40),
(181, 'Uzhavoor', 0, 40),
(182, ' Kaduthuruthy', 0, 40),
(183, 'Muttuchira', 0, 40),
(184, 'Vaikom', 0, 40),
(185, 'Velloor', 0, 40),
(186, 'Munnar', 0, 41),
(187, 'Thodupuzha', 0, 41),
(188, 'Kumali', 0, 41),
(189, 'Thekkadi', 0, 41),
(190, 'Vagaman', 0, 41),
(191, 'Moolamattom', 0, 41),
(192, 'Anachal', 0, 41),
(193, 'Irinjalakuda', 0, 43),
(194, 'Chalakudy', 0, 43),
(195, 'Mullassery', 0, 43),
(196, 'Chavakkad', 0, 43),
(197, 'Cherppu', 0, 43),
(198, 'Ollur', 0, 43),
(199, 'Neendakara', 0, 37),
(200, 'Kollam', 0, 37),
(201, 'Perinad', 0, 37),
(202, 'Mangad', 0, 37),
(203, 'Meenad', 0, 37),
(204, 'Paravoor', 0, 37),
(205, 'Parippally', 0, 37),
(206, 'Pathanamthitta', 0, 38),
(207, 'Gavi', 0, 38),
(208, 'Sabarimala', 0, 38),
(209, 'Aranmula', 0, 38),
(210, 'Konni', 0, 38),
(211, 'Kadammanitta', 0, 38),
(212, 'Cherukolppuzha', 0, 38),
(213, 'Alappuzha', 0, 39),
(214, 'Aroor', 0, 39),
(215, 'Panavally', 0, 39),
(216, 'Mullakkal', 0, 39),
(217, 'Kavalam', 0, 39),
(218, 'Cheppad', 0, 39),
(219, 'Mannar', 0, 39),
(220, 'Venmani', 0, 39),
(221, 'Kottathara', 0, 44),
(222, 'Attasseri', 0, 44),
(223, 'Palakkad', 0, 44),
(224, 'Paloor', 0, 44),
(225, 'Pattambi', 0, 44),
(226, 'Pulpatta', 0, 45),
(227, 'Chirayil', 0, 45),
(228, 'Pullancheri', 0, 45),
(229, 'Vellur', 0, 45),
(230, 'Pathaikara', 0, 44),
(231, 'Kozhikode ', 0, 46),
(232, 'Kakkodi', 0, 46),
(233, 'Mavoor', 0, 45),
(234, 'Villiappally', 0, 46),
(235, 'Chorode', 0, 46),
(236, 'Cheeral', 0, 47),
(237, ' Kottathara', 0, 47),
(238, 'Kalpetta', 0, 47),
(239, 'Thirunelly', 0, 47),
(240, 'Thavinjal', 0, 47),
(241, 'Kannur', 0, 48),
(242, 'Iritty', 0, 48),
(243, 'Thalassery', 0, 48),
(244, 'Thaliparambu', 0, 48),
(245, 'Chirakkal', 0, 48),
(246, 'Kappad', 0, 48),
(247, '	Kasaragod', 0, 50),
(248, '	Adoor', 0, 50),
(249, 'Bekoor', 0, 50),
(250, '	Pathur', 0, 50);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_complaint_type`
--

CREATE TABLE `tbl_complaint_type` (
  `complaint_type_id` int(11) NOT NULL,
  `complaint_type_name` varchar(100) NOT NULL,
  `complaint_type_status` tinyint(4) NOT NULL,
  `complaint_type_del_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_complaint_type`
--

INSERT INTO `tbl_complaint_type` (`complaint_type_id`, `complaint_type_name`, `complaint_type_status`, `complaint_type_del_status`) VALUES
(7, 'Worst product', 2, 0),
(8, 'Server error', 1, 0),
(9, 'Payment failure', 1, 0),
(10, 'Poor Delivery Service', 2, 0),
(11, 'Lack of Security', 1, 0),
(12, 'Unsatisfactory Customer Service', 2, 0),
(13, 'Unexpected price', 2, 0),
(14, 'A Convoluted Checkout Experience', 1, 0),
(16, '', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_district`
--

CREATE TABLE `tbl_district` (
  `district_id` int(11) NOT NULL,
  `district_name` varchar(100) NOT NULL,
  `district_del_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_district`
--

INSERT INTO `tbl_district` (`district_id`, `district_name`, `district_del_status`) VALUES
(36, 'Thiruvananthapuram', 0),
(37, 'Kollam', 0),
(38, 'Pathanamthitta', 0),
(39, 'Alappuzha', 0),
(40, 'Kottayam', 0),
(41, 'Idukki', 0),
(42, 'Ernakulam', 0),
(43, 'Thrissur', 0),
(44, 'Palakkad', 0),
(45, 'Malappuram', 0),
(46, 'Kozhikode', 0),
(47, 'Wayanad', 0),
(48, 'Kannur', 0),
(50, 'Kasaragod', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedback`
--

CREATE TABLE `tbl_feedback` (
  `feedback_id` int(11) NOT NULL,
  `feedback_content` varchar(100) NOT NULL,
  `feedback_rating` int(11) NOT NULL,
  `feedback_time` varchar(100) NOT NULL,
  `feedback_status` tinyint(4) NOT NULL,
  `user_id` int(11) NOT NULL,
  `shop_id` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_feedback`
--

INSERT INTO `tbl_feedback` (`feedback_id`, `feedback_content`, `feedback_rating`, `feedback_time`, `feedback_status`, `user_id`, `shop_id`) VALUES
(117, 'good', 1, '2023-12-28 09:42:21', 0, 4, 0),
(118, 'so good', 2, '2023-12-28 09:42:46', 0, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `order_id` int(11) NOT NULL,
  `order_number` int(11) NOT NULL,
  `order_place` varchar(100) NOT NULL,
  `order_status` tinyint(4) NOT NULL,
  `order_date` varchar(100) NOT NULL,
  `cart_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`order_id`, `order_number`, `order_place`, `order_status`, `order_date`, `cart_id`) VALUES
(66, 943418285, 'Eloor po', 2, '2023-12-30 06:34:10', 123),
(67, 321457708, 'Eloor po', 2, '2023-12-30 06:35:06', 124);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_plant`
--

CREATE TABLE `tbl_plant` (
  `plant_id` int(11) NOT NULL,
  `plant_name` varchar(100) NOT NULL,
  `plant_description` longtext NOT NULL,
  `plant_photo` varchar(100) NOT NULL,
  `plant_price` double NOT NULL,
  `plant_stock` int(11) NOT NULL,
  `plant_rating` double NOT NULL,
  `plant_del_status` tinyint(1) NOT NULL,
  `plant_category_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_plant`
--

INSERT INTO `tbl_plant` (`plant_id`, `plant_name`, `plant_description`, `plant_photo`, `plant_price`, `plant_stock`, `plant_rating`, `plant_del_status`, `plant_category_id`, `shop_id`) VALUES
(20, 'Tulips white', 'Tulips are spring-blooming bulbs that are well-known for their colorful and distinct cup-shaped flowers. They come in various colors, including red, yellow, pink, and white. Tulips thrive in well-drained soil and prefer full sun to partial shade. These flowers are commonly associated with the arrival of spring and are often planted in gardens or used for ornamental displays. Tulips are available in different varieties, including early, mid, and late-season bloomers, providing a range of options for creating beautiful spring landscapes.', '170390741512-30-2023tulips_flowers_white_spring_beauty_herbs_24623_640x1136.jpeg', 850, 136, 4, 0, 30, 16),
(22, 'Lily white', 'Lilies are elegant flowering plants known for their striking, often fragrant blooms. They belong to the genus Lilium and come in various types, including Asiatic, Oriental, and Trumpet lilies. Lilies typically prefer well-drained soil and partial to full sun. They are popular in gardens and bouquets, adding beauty with their wide range of colors and graceful shapes. It is important to note that while many lilies are admired for their aesthetics, certain varieties can be toxic to pets if ingested.', '170391168512-30-2023e8aa835675f89b684d339d6d5913b6dc.jpg', 180, 742, 4, 0, 30, 16),
(23, 'Dahlia Orange', 'Dahlias are vibrant flowering plants known for their diverse and colorful blooms. They come in various shapes and sizes, from small, pom-pom-like flowers to large, showy blooms. Dahlias are perennials that thrive in well-drained soil and prefer full sun. They are commonly grown from tubers and require regular watering. With their stunning array of colors and forms, dahlias are popular choices for gardens and floral arrangements.', '170391384912-30-2023WhatsApp Image 2023-12-20 at 10.19.04_c88c06f4.jpg', 130, 456, 0, 0, 30, 16);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_plant_category`
--

CREATE TABLE `tbl_plant_category` (
  `plant_category_id` int(11) NOT NULL,
  `plant_category_name` varchar(100) NOT NULL,
  `plant_category_del_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_plant_category`
--

INSERT INTO `tbl_plant_category` (`plant_category_id`, `plant_category_name`, `plant_category_del_status`) VALUES
(22, 'Cactus Plants', 0),
(23, 'Succulent Plants', 0),
(24, 'Herbal Plants', 0),
(25, 'Fruit Plants', 0),
(26, 'Climber Plants', 0),
(27, 'Hanging Plants', 0),
(28, 'Shrub Plants', 0),
(29, 'Indoor plants', 0),
(30, 'Flowering plants', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_plant_gallery`
--

CREATE TABLE `tbl_plant_gallery` (
  `plant_gallery_id` int(11) NOT NULL,
  `plant_gallery_photo` varchar(100) NOT NULL,
  `plant_gallery_del_status` tinyint(4) NOT NULL,
  `plant_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_plant_rating`
--

CREATE TABLE `tbl_plant_rating` (
  `plant_rating_id` int(11) NOT NULL,
  `plant_rating_user_review` varchar(500) NOT NULL,
  `user_id` int(11) NOT NULL,
  `plant_id` int(11) NOT NULL,
  `plant_rating_star` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_plant_rating`
--

INSERT INTO `tbl_plant_rating` (`plant_rating_id`, `plant_rating_user_review`, `user_id`, `plant_id`, `plant_rating_star`) VALUES
(28, 'good plant\r\n', 3, 22, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shop`
--

CREATE TABLE `tbl_shop` (
  `shop_id` int(11) NOT NULL,
  `shop_name` varchar(100) NOT NULL,
  `shop_address` varchar(100) NOT NULL,
  `shop_pincode` varchar(100) NOT NULL,
  `city_id` int(11) NOT NULL,
  `shop_photo` varchar(100) NOT NULL,
  `shop_proof` varchar(100) NOT NULL,
  `shop_email` varchar(100) NOT NULL,
  `shop_contactno` varchar(100) NOT NULL,
  `shop_password` varchar(100) NOT NULL,
  `shop_status` tinyint(4) NOT NULL,
  `shop_doj` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_shop`
--

INSERT INTO `tbl_shop` (`shop_id`, `shop_name`, `shop_address`, `shop_pincode`, `city_id`, `shop_photo`, `shop_proof`, `shop_email`, `shop_contactno`, `shop_password`, `shop_status`, `shop_doj`) VALUES
(16, 'Cochin Bonsai Garden', 'Pallathussery, \r\n4th Cross Road, \r\nMuttathil Ln', '682020', 101, '170263390412-15-2023cochinbonsaigarden.jpg', '170262917912-15-2023cochinbonasi.pdf', 'mail@cochinbonsaigarden.com', '9874514785', 'c123', 1, '2015-12-23'),
(17, 'Dev Garden Nursery', 'Subhash Chandra Bose Road, \r\nLandmark senora designs, \r\n20, \r\nJawahar Nagar,', '682020', 101, '170265187012-15-2023Dev Garden Nursery.jpg', '170264779612-15-2023Dev Garden Nursery.pdf', 'dg@gmail.com', '9746350187', '123', 1, '2015-12-23');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shop_complaint`
--

CREATE TABLE `tbl_shop_complaint` (
  `shop_complaint_id` int(11) NOT NULL,
  `shop_complaint_content` varchar(500) NOT NULL,
  `shop_complaint_reply` varchar(500) NOT NULL,
  `shop_complaint_time` varchar(100) NOT NULL,
  `shop_complaint_del_status` tinyint(4) NOT NULL,
  `complaint_type_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_shop_complaint`
--

INSERT INTO `tbl_shop_complaint` (`shop_complaint_id`, `shop_complaint_content`, `shop_complaint_reply`, `shop_complaint_time`, `shop_complaint_del_status`, `complaint_type_id`, `user_id`, `shop_id`) VALUES
(4, 'product damage', '', '2023-12-30 17:51:00', 0, 7, 3, 16);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_gender` varchar(10) NOT NULL,
  `user_dob` date NOT NULL,
  `user_address` varchar(500) NOT NULL,
  `user_pincode` int(11) NOT NULL,
  `user_photo` varchar(500) NOT NULL,
  `user_contactno` varchar(30) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `city_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_name`, `user_gender`, `user_dob`, `user_address`, `user_pincode`, `user_photo`, `user_contactno`, `user_email`, `user_password`, `city_id`) VALUES
(3, 'Samuel TR', 'Male', '2023-12-07', '123 street puthencruz', 682308, '170349483612-25-2023samuel.png', '9874563210', 's@gmail.com', '123', 91),
(4, 'Kiran', 'Male', '2023-11-30', '123 street', 582308, '170375422812-28-2023samuel.png', '8974560123', 'k@gmail.com', '123', 33),
(5, 'Christan', 'Male', '2023-11-07', '123 street', 75621, '170358177912-26-2023cactus-pink-moon-gymnocalycium-mihanovichii-1-merrow-original-imafkk5zv5d5nbxd.jpg', '8974561230', 'c@gmail.com', '123', 60),
(6, 'John', 'Male', '2023-12-13', '123 street', 756234, '170376993112-28-2023samuel.png', '9845621370', 'j@gmail.com', '123', 97),
(7, 'hello', 'Male', '2023-12-12', '123 street', 456123, '170382762912-29-2023samuel.png', '9874562130', 'h@gmail.com', '123', 107);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_admin_complaint`
--
ALTER TABLE `tbl_admin_complaint`
  ADD PRIMARY KEY (`admin_complaint_id`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `tbl_city`
--
ALTER TABLE `tbl_city`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `tbl_complaint_type`
--
ALTER TABLE `tbl_complaint_type`
  ADD PRIMARY KEY (`complaint_type_id`);

--
-- Indexes for table `tbl_district`
--
ALTER TABLE `tbl_district`
  ADD PRIMARY KEY (`district_id`);

--
-- Indexes for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tbl_plant`
--
ALTER TABLE `tbl_plant`
  ADD PRIMARY KEY (`plant_id`);

--
-- Indexes for table `tbl_plant_category`
--
ALTER TABLE `tbl_plant_category`
  ADD PRIMARY KEY (`plant_category_id`);

--
-- Indexes for table `tbl_plant_gallery`
--
ALTER TABLE `tbl_plant_gallery`
  ADD PRIMARY KEY (`plant_gallery_id`);

--
-- Indexes for table `tbl_plant_rating`
--
ALTER TABLE `tbl_plant_rating`
  ADD PRIMARY KEY (`plant_rating_id`);

--
-- Indexes for table `tbl_shop`
--
ALTER TABLE `tbl_shop`
  ADD PRIMARY KEY (`shop_id`);

--
-- Indexes for table `tbl_shop_complaint`
--
ALTER TABLE `tbl_shop_complaint`
  ADD PRIMARY KEY (`shop_complaint_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_admin_complaint`
--
ALTER TABLE `tbl_admin_complaint`
  MODIFY `admin_complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `tbl_city`
--
ALTER TABLE `tbl_city`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251;

--
-- AUTO_INCREMENT for table `tbl_complaint_type`
--
ALTER TABLE `tbl_complaint_type`
  MODIFY `complaint_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_district`
--
ALTER TABLE `tbl_district`
  MODIFY `district_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `tbl_plant`
--
ALTER TABLE `tbl_plant`
  MODIFY `plant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_plant_category`
--
ALTER TABLE `tbl_plant_category`
  MODIFY `plant_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_plant_gallery`
--
ALTER TABLE `tbl_plant_gallery`
  MODIFY `plant_gallery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `tbl_plant_rating`
--
ALTER TABLE `tbl_plant_rating`
  MODIFY `plant_rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_shop`
--
ALTER TABLE `tbl_shop`
  MODIFY `shop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_shop_complaint`
--
ALTER TABLE `tbl_shop_complaint`
  MODIFY `shop_complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
