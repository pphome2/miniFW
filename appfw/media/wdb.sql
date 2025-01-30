DROP TABLE IF EXISTS afw_param;

CREATE TABLE `afw_param` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `name` tinytext NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

INSERT INTO afw_param VALUES('1','SQL_VERSION','0');
INSERT INTO afw_param VALUES('2','FW_VERSION','0');
INSERT INTO afw_param VALUES('3','DEV_MODE','1');
INSERT INTO afw_param VALUES('4','APP_VERSION','0');



DROP TABLE IF EXISTS afw_users;

CREATE TABLE `afw_users` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `uname` tinytext NOT NULL,
  `upass` tinytext NOT NULL,
  `urole` int(11) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;




