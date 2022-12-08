DROP DATABASE IF EXISTS `authentification`;

CREATE DATABASE `authentification`;

USE `authentification`;

CREATE TABLE `user`(
        user_id         INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        email			   VARCHAR(100) NOT NULL,
        nom             VARCHAR(50) NOT NULL,
        prenom          VARCHAR(50) NOT NULL,
        mdp             VARCHAR(60) NOT NULL
);