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

