-- CREATE DATABSE
DROP DATABASE IF EXISTS iepsa_arlon;
CREATE DATABASE iepsa_arlon CHARACTER SET UTF8 COLLATE utf8_bin;

USE iepsa_arlon;

-- CREATE USER AND GRANT ACCESS TO DATABASE
CREATE USER 'iepsa_user'@'localhost' IDENTIFIED BY 'ZHeg5X0Ti12244Fk';
GRANT SELECT, INSERT, DELETE, UPDATE ON iepsa_arlon.* TO 'iepsa_user'@'localhost';
FLUSH PRIVILEGES;


-- CREATE TABLE
CREATE TABLE articles(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    content VARCHAR(2000),
    author VARCHAR(100),
    category VARCHAR(255),
    creationDate DATETIME DEFAULT CURRENT_TIMESTAMP,
    updateDate DATETIME ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(256) NOT NULL,
    isEnabled BOOLEAN DEFAULT TRUE,
    creationDate DATETIME DEFAULT CURRENT_TIMESTAMP,
    updateDate DATETIME ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE files (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    content LONGBLOB NOT NULL,
    type VARCHAR(50)
);

CREATE TABLE restaurants (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(250) NOT NULL,
    country VARCHAR(50) NOT NULL,
    city VARCHAR(50) NOT NULL,
    number VARCHAR(10),
    line VARCHAR(100) NOT NULL,
    location VARCHAR(1000) NOT NULL,
    lat FLOAT,
    lon FLOAT,
    createdById INT NOT NULL,
    imageId INT,
    creationDate DATETIME DEFAULT CURRENT_TIMESTAMP,
    updateDate DATETIME ON UPDATE CURRENT_TIMESTAMP
    FOREIGN KEY (createdById) REFERENCES users(id),
    FOREIGN KEY (imageId) REFERENCES files(id)
);

-------------------------------------------------------
-- PROCEDURE TO RETRIEVE RESTAURANT NEARBY
-- fLat AND fLon = coordonnees
-- iNbr = number of returned restaurant
DROP PROCEDURE IF EXISTS getRestaurantNearby;

DELIMITER $$
CREATE PROCEDURE getRestaurantNearby(IN fLat float, IN fLon float, IN iNbr int)
BEGIN 
SELECT id, name, location, lat, lon, imageId, getDistance(lat,lon,fLat, fLon) distance FROM restaurants ORDER BY distance LIMIT iNbr;
END $$

-- FUNCTION TO GET THE DISTANCE BETWEEN TWO COORDONNEES
-- Lat1 AND Lon1 = first coordonnee
-- Lat2 AND Lon2 = second coordonnee
DROP FUNCTION IF EXISTS getDistance

DELIMITER $$
CREATE FUNCTION getDistance (Lat1 FLOAT, Lon1 FLOAT, Lat2 FLOAT, Lon2 FLOAT) RETURNS FLOAT 
AS
BEGIN
    DECLARE @EarthRadius int,
    DECLARE @dLat float;    
    DECLARE @dLon float;
    DECLARE @a float;
    DECLARE @b float;

    SET @EarthRadius = 6371;
    SET @dLat = (Lat1 - Lat2) * PI()/180;
    SET @dLon = (Lon1 - Lon2) * PI()/180;

    SET @a = POW(SIN(@dLat/2),2) + COS(Lat1 * PI()/180) * COS(Lat2*PI() / 180) * POW(SIN(@dLon/2),2);
    SET @b = 2* ATAN2(SQRT(@a), SQRT(1-@a));
    RETURN @EarthRadius * @b;
END $$

GRANT EXECUTE ON PROCEDURE iepsa_arlon.getRestaurantNearby TO 'iepsa_user'@'localhost';
GRANT EXECUTE ON FUNCTION iepsa_arlon.getDistance TO 'iepsa_user'@'localhost';

-----------------------------------------------------------
-- SAMPLE CALL TO STORED PROC
-- CALL getRestaurantNearby(49.83333, 5.7333, 3)