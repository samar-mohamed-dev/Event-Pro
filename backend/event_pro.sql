DROP DATABASE IF EXISTS `event_pro`;
CREATE DATABASE `event_pro` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `event_pro`;

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `specialty` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `address` varchar(255) NOT NULL,
  `national_id` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `birth_date` date DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_national_id_unique` (`national_id`),
  UNIQUE KEY `users_phone_unique` (`phone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `conferences` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `location` varchar(150) NOT NULL,
  `starts_at` datetime NOT NULL,
  `ends_at` datetime DEFAULT NULL,
  `status` enum('draft','published','archived') NOT NULL DEFAULT 'published',
  `created_by` bigint unsigned NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `conferences_created_by_index` (`created_by`),
  CONSTRAINT `conferences_created_by_fk`
    FOREIGN KEY (`created_by`) REFERENCES `users` (`id`)
    ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `tickets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `conference_id` bigint unsigned NOT NULL,
  `ticket_name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int NOT NULL,
  `remaining_quantity` int NOT NULL,
  `status` enum('active','inactive','archived') NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `conference_ticket_name_unique` (`conference_id`,`ticket_name`),
  CONSTRAINT `tickets_conference_fk`
    FOREIGN KEY (`conference_id`) REFERENCES `conferences` (`id`)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `registrations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `conference_id` bigint unsigned NOT NULL,
  `ticket_id` bigint unsigned NOT NULL,
  `attendee_name` varchar(150) NOT NULL,
  `attendee_email` varchar(200) NOT NULL,
  `attendee_phone` varchar(30) NOT NULL,
  `quantity` int NOT NULL DEFAULT 1,
  `total_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` enum('pending','confirmed','cancelled') NOT NULL DEFAULT 'pending',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `registrations_user_index` (`user_id`),
  KEY `registrations_conference_index` (`conference_id`),
  KEY `registrations_ticket_index` (`ticket_id`),
  CONSTRAINT `registrations_user_fk`
    FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
    ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `registrations_conference_fk`
    FOREIGN KEY (`conference_id`) REFERENCES `conferences` (`id`)
    ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `registrations_ticket_fk`
    FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`)
    ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` 
(`first_name`, `last_name`, `specialty`, `email`, `address`, `national_id`, `phone`, `birth_date`, `password_hash`, `status`, `created_at`, `updated_at`) 
VALUES 
('System', 'Admin', 'Administrator', 'admin@eventpro.local', 'Egypt / Cairo', '30001010101010', '01000000000', '2000-01-01', '$2y$10$h5jJxTbqHUXG2PYrKKUuJu3FdCsvAeCn.hNoHy8gGQzo4M5RIpHBi', 'active', NOW(), NOW());