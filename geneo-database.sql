
CREATE DATABASE geneo;

CREATE TABLE IF NOT EXISTS `geneo`.`messages` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `name` VARCHAR(100) NOT NULL , `email` VARCHAR(100) NOT NULL , `message` TEXT NOT NULL , `file` VARCHAR(100) NULL , `created` DATETIME NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

ALTER TABLE `geneo`.`messages` ADD `ip` VARCHAR(15) NOT NULL AFTER `file`;

CREATE DATABASE geneo_test;

CREATE TABLE IF NOT EXISTS `geneo_test`.`messages` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `name` VARCHAR(100) NOT NULL , `email` VARCHAR(100) NOT NULL , `message` TEXT NOT NULL , `file` VARCHAR(100) NULL , `created` DATETIME NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

ALTER TABLE `geneo_test`.`messages` ADD `ip` VARCHAR(15) NOT NULL AFTER `file`;