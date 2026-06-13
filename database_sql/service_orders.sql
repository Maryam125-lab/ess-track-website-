-- Service agreement orders (booking modal) — run on ess-track-backend-db

CREATE TABLE IF NOT EXISTS `service_orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(200) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `vehicle_no` varchar(50) DEFAULT NULL,
  `vehicle_type` varchar(50) DEFAULT NULL,
  `interested_package` varchar(100) DEFAULT 'Not Sure',
  `package_rate` varchar(50) DEFAULT NULL,
  `package_price` varchar(50) DEFAULT NULL,
  `residential_address` text DEFAULT NULL,
  `commercial_address` text DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `home_phone` varchar(30) DEFAULT NULL,
  `office_phone` varchar(30) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `raw_payload` longtext DEFAULT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'new',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
