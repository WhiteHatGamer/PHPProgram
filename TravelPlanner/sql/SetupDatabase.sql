-- ----------------------
-- SQL Commands To setup the Database Required To run the Web Application

-- Create Database
CREATE DATABASE IF NOT EXISTS `form`;
USE `form`;

-- Create User Table
CREATE TABLE user(
    `email` VARCHAR(255) NOT NULL,
    `password` VARCHAR(260) NOT NULL,
    `name` VARCHAR(100),
    `number` INT,
    `dob` DATE,
    `image` BLOB,
    `gender` enum('m','f','o'),
    `prefix` enum('Mr.','Ms.','Mrs.','Dr.','Adv.'),
    PRIMARY KEY(`email`)
)

-- Create Table Journey
CREATE TABLE journey(
    `id` INT NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(255) NOT NULL,
    `source` VARCHAR(60) NOT NULL,
    `destination` VARCHAR(60) NOT NULL,
    `way` enum('airplane','train','bus','cycling.','walking'),
    `journey` DATETIME,
    `round` DATETIME,
    PRIMARY KEY(`id`),
    UNIQUE KEY(`journey`),
    FOREIGN KEY(`email`) REFERENCES form(email)
)

-- Create Table stay
CREATE TABLE stay(
    `id` INT NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(255) NOT NULL,
    `city` VARCHAR(60) NOT NULL,
    `hotel` VARCHAR(60) NOT NULL,
    `checkIn` DATE,
    `checkOut` DATE,
    PRIMARY KEY(`id`),
    FOREIGN KEY(`email`) REFERENCES form(email)
)

-- Create Table notes
CREATE TABLE notes(
    `id` INT NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(255) NOT NULL,
    `note` VARCHAR(128),
    `create_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY(`id`),
    FOREIGN KEY(`email`) REFERENCES form(email)
)