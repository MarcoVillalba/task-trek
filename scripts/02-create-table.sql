-- tasktrek.tasks definition
CREATE TABLE `tasks` (
						 `id` bigint unsigned NOT NULL AUTO_INCREMENT,
						 `title` varchar(100) NOT NULL DEFAULT 'default task title',
						 `description` varchar(255) DEFAULT NULL,
						 `completed` varchar(1) NOT NULL DEFAULT 'N',
						 `deleted` varchar(1) NOT NULL DEFAULT 'N',
						 `duedate` date DEFAULT NULL,
						 `completed_at` date DEFAULT NULL,
						 `created_at` timestamp NULL DEFAULT NULL,
						 `updated_at` timestamp NULL DEFAULT NULL,
						 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3;
