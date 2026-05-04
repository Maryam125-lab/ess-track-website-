-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2026 at 10:52 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ess-track-backend-db`
--

-- --------------------------------------------------------

--
-- Table structure for table `inquiries`
--

CREATE TABLE `inquiries` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `vehicle_type` varchar(50) DEFAULT NULL,
  `message` text NOT NULL,
  `interested_package` varchar(50) DEFAULT 'Not Sure',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inquiries`
--

INSERT INTO `inquiries` (`id`, `first_name`, `last_name`, `email`, `phone_number`, `vehicle_type`, `message`, `interested_package`, `created_at`) VALUES
(1, 'vfgrdgrdfhb', 'yuukjgkjmgmn', 'bvdcdgdfh@gmail.com', '03422191468', 'Car / Sedan', 'fdhgfkjghkihilh', 'Basic Package', '2026-03-16 06:13:14'),
(2, 'zhgafssj', 'gvjghavjfd', 'tsahgsjh@gmail.com', '03422191468', 'Car / Sedan', 'fcdgncjhgkjhkllm', 'Silver Package', '2026-03-16 06:14:19'),
(3, 'ghjgkjg', 'ghjgkjhlkkhj', 'hjgkjhlk@gmail.com', '03422191468', 'Pickup / Truck', 'tgjugjkhgkjhgkuvhggfhg', 'Silver Package', '2026-03-16 06:14:54'),
(4, 'gfrgt', 'feferrgv', 'vrfrgrg@gmail.com', '03212472423', 'SUV / Jeep', 'gethbgththtrrhbgbt', 'Basic Package', '2026-03-16 06:48:27'),
(5, 'yiihkhhfht', 'ghthtfhtfh', 'htfghrr@gmail.com', '03212472423', 'Car / Sedan', 'bjbhhvhvgftf', 'Silver Package', '2026-03-16 06:49:34'),
(6, 'ghmgjgkj', 'gfjhgkjjh', 'gjgkihkjh@gmail.com', '03332306114', 'Bus / Coach', 'hhgjghlkjhkk,hbjb', 'Silver Package', '2026-03-16 07:22:45'),
(7, 'knjknon', 'hbhyugyu', 'bhbhbjn@gmail.com', '03456789152', 'Car / Sedan', 'nbnsjkwbdjw', 'Gold Package', '2026-04-03 08:57:01'),
(8, 'hhggkj', 'hihuhyu', 'shjwhsdu@gmail.com', '03212472423', 'Motorcycle / Bike', 'jkhukyiuyiuhy', 'Silver Package', '2026-04-03 09:06:19'),
(9, 'gkuhbj', 'ghjgjju', 'hhfhgmjb@gmail.com', '03256789077', 'Car / Sedan', 'hyeuqgdjhedklhe', 'Basic Package', '2026-04-06 05:49:35');

-- --------------------------------------------------------

--
-- Table structure for table `otp_verifications`
--

CREATE TABLE `otp_verifications` (
  `id` int(11) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `otp_code` varchar(6) NOT NULL,
  `purpose` varchar(50) NOT NULL DEFAULT 'inquiry',
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `expires_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sa_customer`
--

CREATE TABLE `sa_customer` (
  `id` int(11) NOT NULL,
  `form_number` varchar(20) NOT NULL COMMENT 'Form # e.g. 8106 — dono tables ka link',
  `cid_number` varchar(50) DEFAULT NULL,
  `inquiry_id` int(11) DEFAULT NULL COMMENT 'Inquiry table se link (agar aya ho)',
  `customer_name` varchar(150) NOT NULL,
  `vehicle_no` varchar(30) DEFAULT NULL,
  `residential_address` text DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `commercial_address` text DEFAULT NULL,
  `vehicle_type` enum('Private','Commercial','Other') DEFAULT 'Private',
  `vehicle_type_other` varchar(100) DEFAULT NULL,
  `phone_home` varchar(20) DEFAULT NULL,
  `phone_office` varchar(20) DEFAULT NULL,
  `phone_mobile` varchar(20) DEFAULT NULL,
  `fax` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `c1_name` varchar(150) DEFAULT NULL,
  `c1_relationship` varchar(100) DEFAULT NULL,
  `c1_has_key` enum('Yes','No') DEFAULT 'No',
  `c1_phone_residence` varchar(20) DEFAULT NULL,
  `c1_phone_office` varchar(20) DEFAULT NULL,
  `c1_phone_mobile` varchar(20) DEFAULT NULL,
  `c2_name` varchar(150) DEFAULT NULL,
  `c2_relationship` varchar(100) DEFAULT NULL,
  `c2_has_key` enum('Yes','No') DEFAULT 'No',
  `c2_phone_residence` varchar(20) DEFAULT NULL,
  `c2_phone_office` varchar(20) DEFAULT NULL,
  `c2_phone_mobile` varchar(20) DEFAULT NULL,
  `c3_name` varchar(150) DEFAULT NULL,
  `c3_relationship` varchar(100) DEFAULT NULL,
  `c3_has_key` enum('Yes','No') DEFAULT 'No',
  `c3_phone_residence` varchar(20) DEFAULT NULL,
  `c3_phone_office` varchar(20) DEFAULT NULL,
  `c3_phone_mobile` varchar(20) DEFAULT NULL,
  `c4_name` varchar(150) DEFAULT NULL,
  `c4_relationship` varchar(100) DEFAULT NULL,
  `c4_has_key` enum('Yes','No') DEFAULT 'No',
  `c4_phone_residence` varchar(20) DEFAULT NULL,
  `c4_phone_office` varchar(20) DEFAULT NULL,
  `c4_phone_mobile` varchar(20) DEFAULT NULL,
  `c5_name` varchar(150) DEFAULT NULL,
  `c5_relationship` varchar(100) DEFAULT NULL,
  `c5_has_key` enum('Yes','No') DEFAULT 'No',
  `c5_phone_residence` varchar(20) DEFAULT NULL,
  `c5_phone_office` varchar(20) DEFAULT NULL,
  `c5_phone_mobile` varchar(20) DEFAULT NULL,
  `c6_name` varchar(150) DEFAULT NULL,
  `c6_relationship` varchar(100) DEFAULT NULL,
  `c6_has_key` enum('Yes','No') DEFAULT 'No',
  `c6_phone_residence` varchar(20) DEFAULT NULL,
  `c6_phone_office` varchar(20) DEFAULT NULL,
  `c6_phone_mobile` varchar(20) DEFAULT NULL,
  `c7_name` varchar(150) DEFAULT NULL,
  `c7_relationship` varchar(100) DEFAULT NULL,
  `c7_has_key` enum('Yes','No') DEFAULT 'No',
  `c7_phone_residence` varchar(20) DEFAULT NULL,
  `c7_phone_office` varchar(20) DEFAULT NULL,
  `c7_phone_mobile` varchar(20) DEFAULT NULL,
  `item1_description` varchar(255) DEFAULT NULL,
  `item1_qty` decimal(8,2) DEFAULT NULL,
  `item1_rate_pkr` decimal(12,2) DEFAULT NULL,
  `item1_price_pkr` decimal(12,2) DEFAULT NULL,
  `item2_description` varchar(255) DEFAULT NULL,
  `item2_qty` decimal(8,2) DEFAULT NULL,
  `item2_rate_pkr` decimal(12,2) DEFAULT NULL,
  `item2_price_pkr` decimal(12,2) DEFAULT NULL,
  `item3_description` varchar(255) DEFAULT NULL,
  `item3_qty` decimal(8,2) DEFAULT NULL,
  `item3_rate_pkr` decimal(12,2) DEFAULT NULL,
  `item3_price_pkr` decimal(12,2) DEFAULT NULL,
  `item4_description` varchar(255) DEFAULT NULL,
  `item4_qty` decimal(8,2) DEFAULT NULL,
  `item4_rate_pkr` decimal(12,2) DEFAULT NULL,
  `item4_price_pkr` decimal(12,2) DEFAULT NULL,
  `item5_description` varchar(255) DEFAULT NULL,
  `item5_qty` decimal(8,2) DEFAULT NULL,
  `item5_rate_pkr` decimal(12,2) DEFAULT NULL,
  `item5_price_pkr` decimal(12,2) DEFAULT NULL,
  `item6_description` varchar(255) DEFAULT NULL,
  `item6_qty` decimal(8,2) DEFAULT NULL,
  `item6_rate_pkr` decimal(12,2) DEFAULT NULL,
  `item6_price_pkr` decimal(12,2) DEFAULT NULL,
  `item7_description` varchar(255) DEFAULT NULL,
  `item7_qty` decimal(8,2) DEFAULT NULL,
  `item7_rate_pkr` decimal(12,2) DEFAULT NULL,
  `item7_price_pkr` decimal(12,2) DEFAULT NULL,
  `item8_description` varchar(255) DEFAULT NULL,
  `item8_qty` decimal(8,2) DEFAULT NULL,
  `item8_rate_pkr` decimal(12,2) DEFAULT NULL,
  `item8_price_pkr` decimal(12,2) DEFAULT NULL,
  `payment_mode` enum('Yearly','Other') DEFAULT 'Yearly',
  `cash_cheque_no` varchar(100) DEFAULT NULL,
  `yearly_monitoring_fee` decimal(10,2) DEFAULT NULL,
  `dealer_sm_name` varchar(150) DEFAULT NULL,
  `sales_executive` varchar(150) DEFAULT NULL,
  `agreement_date` date DEFAULT NULL,
  `customer_name_sign` varchar(150) DEFAULT NULL,
  `customer_sign_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Service Agreement — Customer Section (user fills this)';

-- --------------------------------------------------------

--
-- Table structure for table `sa_office`
--

CREATE TABLE `sa_office` (
  `id` int(11) NOT NULL,
  `form_number` varchar(20) NOT NULL COMMENT 'sa_customer.form_number se link',
  `delivery_challan_no` varchar(100) DEFAULT NULL,
  `device_imei` varchar(50) DEFAULT NULL,
  `sim_number` varchar(30) DEFAULT NULL,
  `date_of_kit_issue` date DEFAULT NULL,
  `uplink_date` date DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `monitoring_charges` decimal(12,2) DEFAULT NULL,
  `fed_charges` decimal(12,2) DEFAULT NULL,
  `total_amount` decimal(12,2) DEFAULT NULL,
  `filled_by` varchar(150) DEFAULT NULL COMMENT 'Office staff ka naam',
  `filled_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Service Agreement — Office Only Section (office staff fills this)';

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_agreement_complete`
-- (See below for the actual view)
--
CREATE TABLE `v_agreement_complete` (
`form_number` varchar(20)
,`cid_number` varchar(50)
,`inquiry_id` int(11)
,`customer_name` varchar(150)
,`vehicle_no` varchar(30)
,`vehicle_type` enum('Private','Commercial','Other')
,`phone_mobile` varchar(20)
,`email` varchar(100)
,`payment_mode` enum('Yearly','Other')
,`cash_cheque_no` varchar(100)
,`yearly_monitoring_fee` decimal(10,2)
,`dealer_sm_name` varchar(150)
,`sales_executive` varchar(150)
,`agreement_date` date
,`delivery_challan_no` varchar(100)
,`device_imei` varchar(50)
,`sim_number` varchar(30)
,`date_of_kit_issue` date
,`uplink_date` date
,`monitoring_charges` decimal(12,2)
,`fed_charges` decimal(12,2)
,`total_amount` decimal(12,2)
,`filled_by` varchar(150)
,`filled_at` timestamp
,`agreement_status` varchar(16)
,`form_submitted_at` timestamp
);

-- --------------------------------------------------------

--
-- Structure for view `v_agreement_complete`
--
DROP TABLE IF EXISTS `v_agreement_complete`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_agreement_complete`  AS SELECT `c`.`form_number` AS `form_number`, `c`.`cid_number` AS `cid_number`, `c`.`inquiry_id` AS `inquiry_id`, `c`.`customer_name` AS `customer_name`, `c`.`vehicle_no` AS `vehicle_no`, `c`.`vehicle_type` AS `vehicle_type`, `c`.`phone_mobile` AS `phone_mobile`, `c`.`email` AS `email`, `c`.`payment_mode` AS `payment_mode`, `c`.`cash_cheque_no` AS `cash_cheque_no`, `c`.`yearly_monitoring_fee` AS `yearly_monitoring_fee`, `c`.`dealer_sm_name` AS `dealer_sm_name`, `c`.`sales_executive` AS `sales_executive`, `c`.`agreement_date` AS `agreement_date`, `o`.`delivery_challan_no` AS `delivery_challan_no`, `o`.`device_imei` AS `device_imei`, `o`.`sim_number` AS `sim_number`, `o`.`date_of_kit_issue` AS `date_of_kit_issue`, `o`.`uplink_date` AS `uplink_date`, `o`.`monitoring_charges` AS `monitoring_charges`, `o`.`fed_charges` AS `fed_charges`, `o`.`total_amount` AS `total_amount`, `o`.`filled_by` AS `filled_by`, `o`.`filled_at` AS `filled_at`, CASE WHEN `o`.`form_number` is null THEN 'Pending — Office' ELSE 'Complete' END AS `agreement_status`, `c`.`created_at` AS `form_submitted_at` FROM (`sa_customer` `c` left join `sa_office` `o` on(`o`.`form_number` = `c`.`form_number`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inquiries`
--
ALTER TABLE `inquiries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_inquiries_email` (`email`),
  ADD KEY `idx_inquiries_created_at` (`created_at`);

--
-- Indexes for table `otp_verifications`
--
ALTER TABLE `otp_verifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `phone_number` (`phone_number`),
  ADD KEY `otp_code` (`otp_code`),
  ADD KEY `expires_at` (`expires_at`);

--
-- Indexes for table `sa_customer`
--
ALTER TABLE `sa_customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `form_number` (`form_number`),
  ADD KEY `idx_form_number` (`form_number`),
  ADD KEY `idx_customer_name` (`customer_name`),
  ADD KEY `idx_inquiry_id` (`inquiry_id`);

--
-- Indexes for table `sa_office`
--
ALTER TABLE `sa_office`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `form_number` (`form_number`),
  ADD KEY `idx_form_number` (`form_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inquiries`
--
ALTER TABLE `inquiries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `otp_verifications`
--
ALTER TABLE `otp_verifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sa_customer`
--
ALTER TABLE `sa_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sa_office`
--
ALTER TABLE `sa_office`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sa_office`
--
ALTER TABLE `sa_office`
  ADD CONSTRAINT `fk_office_to_customer` FOREIGN KEY (`form_number`) REFERENCES `sa_customer` (`form_number`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
