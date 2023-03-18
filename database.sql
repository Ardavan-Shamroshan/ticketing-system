CREATE TABLE IF NOT EXISTS `users` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(255) NOT NULL,
	`type` varchar(255) NOT NULL,
	`created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 2 DEFAULT CHARSET = utf8;
INSERT INTO `users` (`id`, `name`, `type`, `created`)
VALUES (1, 'مهران', 'user', '2020-06-10 13:06:17'),
	(2, 'مدیر', 'admin', '2020-06-10 13:06:17');
CREATE TABLE IF NOT EXISTS `tickets` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`user_id` int(11) NOT NULL,
	`title` varchar(255) NOT NULL,
	`msg` text NOT NULL,
	`created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`status` enum('open', 'closed', 'resolved') NOT NULL DEFAULT 'open',
	PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 2 DEFAULT CHARSET = utf8;
INSERT INTO `tickets` (
		`id`,
		`user_id`,
		`title`,
		`msg`,
		`created`,
		`status`
	)
VALUES (
		1,
		1,
		'Test Ticket',
		'This is your first ticket.',
		'2020-06-10 13:06:17',
		'open'
	);
CREATE TABLE IF NOT EXISTS `tickets_comments` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`ticket_id` int(11) NOT NULL,
	`user_id` int(11) NOT NULL,
	`msg` text NOT NULL,
	`created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 2 DEFAULT CHARSET = utf8;
INSERT INTO `tickets_comments` (`id`, `ticket_id`, `user_id`, `msg`, `created`)
VALUES (
		1,
		2,
		1,
		'This is a test comment.',
		'2020-06-10 16:23:39'
	);