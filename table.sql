CREATE TABLE `db_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL DEFAULT 0 COMMENT '1=admin,2=agent,3=user',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=active，2=freezed',
  `is_otp` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'otp_bind_status',
  `email` varchar(50) DEFAULT '',
  `password` varchar(255) DEFAULT '',
  `name` varchar(30) NOT NULL DEFAULT '',
  `contact_prefix` varchar(30) DEFAULT '',
  `contact` varchar(30) DEFAULT '',
  `google_otp` varchar(255) DEFAULT NULL COMMENT 'otp_key',
  `activation_key` text NOT NULL DEFAULT '',
  `activation_expire` int(15) NOT NULL DEFAULT 0,
  `last_login` int(15) NOT NULL DEFAULT 0,
  `last_ip` varchar(50) NOT NULL DEFAULT '',
  `created_at` int(15) NOT NULL DEFAULT 0,
  `created_ip` varchar(50) NOT NULL DEFAULT '',
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`role_id`,`email`),
  KEY `index_role_id` (`role_id`) USING BTREE,
  KEY `index_email` (`email`) USING BTREE
  ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
  
 
 CREATE TABLE `db_phone` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `value` varchar(255) DEFAULT '',
  `image_url` text NOT NULL DEFAULT '',
  `created_at` int(15) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `index_user_id` (`user_id`) USING BTREE,
  KEY `index_name` (`name`) USING BTREE,
  KEY `is_value` (`value`) USING BTREE
  ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;