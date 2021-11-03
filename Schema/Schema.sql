create database TPFinalLabV2021;
use TPFinalLabV2021;
#drop database TPFinalLabV2021;

CREATE TABLE `student` (
  `studentId` int(11) NOT NULL,
  `careerId` int(11) NOT NULL,
  `firstName` varchar(35) NOT NULL,
  `lastName` varchar(35) NOT NULL,
  `dni` varchar(45) NOT NULL,
  `fileNumber` varchar(45) NOT NULL,
  `gender` varchar(45) NOT NULL,
  `birthDate` date NOT NULL,
  `email` varchar(45) NOT NULL,
  `phoneNumber` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`studentId`)
);

CREATE TABLE `company` (
  `companyId` INT NOT NULL,
  `fantasyName` VARCHAR(45) NOT NULL,
  `cuil` VARCHAR(45) NOT NULL,
  `phoneNumber` VARCHAR(45) NOT NULL,
  `country` VARCHAR(45) NOT NULL,
  `province` VARCHAR(45) NOT NULL,
  `city` VARCHAR(45) NOT NULL,
  `direction` VARCHAR(45) NOT NULL,
  `active` TINYINT NOT NULL,
  PRIMARY KEY (`companyId`)
  );