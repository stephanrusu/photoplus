CREATE DATABASE IF NOT EXISTS `photoplus`;
CREATE TABLE  `users` (
 `user_id` int(11) NOT NULL AUTO_INCREMENT ,
 `user_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL ,
 `user_password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL ,
 `user_email` varchar(64) COLLATE utf8_unicode_ci NOT NULL ,
 `user_active` tinyint(1) NOT NULL DEFAULT `0` ,
 `user_activation_hash` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL ,
 `user_password_reset_hash` char(40) COLLATE utf8_unicode_ci DEFAULT NULL,
 `user_password_reset_timestamp` bigint(20) DEFAULT NULL,
 `user_rememberme_token` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL , 
 `user_registration_datetime` datetime NOT NULL DEFAULT `0000-00-00 00:00:00`,
 `user_registration_ip` varchar(39) COLLATE utf8_unicode_ci NOT NULL DEFAULT `0.0.0.0`,
 `user_twitter` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
 `user_facebook` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
 `user_googleplus` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
 PRIMARY KEY (`user_id`),
 UNIQUE KEY `user_name` (`user_name`),
 UNIQUE KEY `user_email` (`user_email`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

