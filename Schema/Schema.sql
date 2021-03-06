create database TPFinalLabV2021;
use TPFinalLabV2021;
#drop database TPFinalLabV2021;

CREATE TABLE student (
  studentId int(11) NOT NULL,
  careerId int(11) NOT NULL,
  firstName varchar(35) NOT NULL,
  lastName varchar(35) NOT NULL,
  dni varchar(45) NOT NULL,
  fileNumber varchar(45) NOT NULL,
  gender varchar(45) NOT NULL,
  birthDate date NOT NULL,
  email varchar(45) NOT NULL,
  phoneNumber int(11) NOT NULL,
  active tinyint(4) NOT NULL,
  PRIMARY KEY (studentId)
);

CREATE TABLE company (
  companyId INT NOT NULL,
  fantasyName VARCHAR(45) NOT NULL,
  cuil VARCHAR(45) NOT NULL,
  phoneNumber VARCHAR(45) NOT NULL,
  country VARCHAR(45) NOT NULL,
  province VARCHAR(45) NOT NULL,
  city VARCHAR(45) NOT NULL,
  direction VARCHAR(45) NOT NULL,
  active TINYINT NOT NULL,
  PRIMARY KEY (companyId)
  );

CREATE TABLE joboffer (
  jobOfferId int(11) NOT NULL,
  description varchar(45) NOT NULL,
  publicationDate date NOT NULL,
  expirationDate date NOT NULL,
  requirements varchar(70) NOT NULL,
  workload varchar(45) NOT NULL,
  jobPositionId int(11) NOT NULL,
  companyId int(11) NOT NULL,
  active tinyint(4) NOT NULL,
  PRIMARY KEY (jobOfferId)
);

CREATE TABLE postulation (
  postulationId INT NOT NULL,
  jobOfferId INT NOT NULL,
  studentId INT NOT NULL,
  studentFullName varchar(25) NOT NULL,
  postulationDate DATE NOT NULL,
  active TINYINT NOT NULL,
  PRIMARY KEY (postulationId)
);

CREATE TABLE jobposition (
  jobPositionId INT NOT NULL,
  careerId INT NOT NULL,
  description VARCHAR(45) NOT NULL,
  PRIMARY KEY (jobPositionId)
);

CREATE TABLE career (
  careerId INT NOT NULL,
  description VARCHAR(45) NOT NULL,
  active TINYINT NOT NULL,
  PRIMARY KEY (careerId)
);
  
CREATE TABLE access (
  accessId INT NOT NULL,
  studentId INT NOT NULL,
  password VARCHAR(45) NOT NULL,
  PRIMARY KEY (accessId)
);

CREATE TABLE employer (
  employerId INT NOT NULL,
  companyId INT NOT NULL,
  firstName VARCHAR(45) NOT NULL,
  lastName VARCHAR(45) NOT NULL,
  dni VARCHAR(45) NOT NULL,
  email VARCHAR(45) NOT NULL,
  active TINYINT NOT NULL,
  PRIMARY KEY (employerId)
);
  
SELECT * FROM company;
SELECT * FROM student;
SELECT * FROM jobposition;
SELECT * FROM joboffer;
SELECT * FROM career;
SELECT * FROM access;
SELECT * FROM employer;
SELECT * FROM postulation;