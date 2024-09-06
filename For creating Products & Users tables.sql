CREATE TABLE `products` (
  `ProdID` int NOT NULL AUTO_INCREMENT,
  `ProdName` varchar(60) NOT NULL,
  `ProdBrand` varchar(60) DEFAULT NULL,
  `Description` varchar(100) NOT NULL,
  `Category` enum('Food','Beverages','Household') NOT NULL,
  `Unit` enum('kg','ml','L','g') DEFAULT NULL,
  `Price` float NOT NULL,
  PRIMARY KEY (`ProdID`)
)



CREATE TABLE `users` (
  `UserID` int NOT NULL AUTO_INCREMENT,
  `FullName` varchar(40) NOT NULL,
  `UserName` varchar(20) NOT NULL,
  `PhoneNo` varchar(12) NOT NULL,
  `Password` varchar(20) NOT NULL,
  PRIMARY KEY (`UserID`)
) 