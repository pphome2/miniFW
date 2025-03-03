DROP TABLE IF EXISTS afw_param;

CREATE TABLE `afw_param` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `name` tinytext NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

INSERT INTO afw_param VALUES('1','SQL_VERSION','0');
INSERT INTO afw_param VALUES('2','FW_VERSION','0');
INSERT INTO afw_param VALUES('3','DEV_MODE','1');
INSERT INTO afw_param VALUES('4','APP_VERSION','0');
INSERT INTO afw_param VALUES('6','TEMP_VERSION','0');
INSERT INTO afw_param VALUES('15','','');



DROP TABLE IF EXISTS afw_users;

CREATE TABLE `afw_users` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `uname` tinytext NOT NULL,
  `upass` tinytext NOT NULL,
  `urole` int(11) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

INSERT INTO afw_users VALUES('1','admin','$2y$12$sLaWRycTOLPCW1wCoSGskO5iZkGj3Q7S37UtuH7q63nw3AOzbdusK','0','qqtext');
INSERT INTO afw_users VALUES('3','appfwadmin','$2y$12$/9upKpDDjdESts5BfEiNqeJP1ExGGKFYnFNw1gMbhOZ8F1FvpXV7O','0','Admin felhasználó 1');
INSERT INTO afw_users VALUES('4','test','$2y$12$wPhGLPpqi4sT0ot1lQLYBufkipN/DiYGR6n5JU4aniS3Ga3BX29tO','0','Admin felhasználó');
INSERT INTO afw_users VALUES('5','teszt','$2y$12$wPhGLPpqi4sT0ot1lQLYBufkipN/DiYGR6n5JU4aniS3Ga3BX29tO','0','Admin felhasználó');
INSERT INTO afw_users VALUES('6','test22','$2y$12$wPhGLPpqi4sT0ot1lQLYBufkipN/DiYGR6n5JU4aniS3Ga3BX29tO','0','Admin felhasználó');



DROP TABLE IF EXISTS afw_param;

CREATE TABLE `afw_param` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `name` tinytext NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

INSERT INTO afw_param VALUES('1','SQL_VERSION','0');
INSERT INTO afw_param VALUES('2','FW_VERSION','0');
INSERT INTO afw_param VALUES('3','DEV_MODE','1');
INSERT INTO afw_param VALUES('4','APP_VERSION','0');
INSERT INTO afw_param VALUES('6','TEMP_VERSION','0');
INSERT INTO afw_param VALUES('15','','');



