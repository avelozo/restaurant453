SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema roussef
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `roussef` ;
CREATE SCHEMA IF NOT EXISTS `roussef` DEFAULT CHARACTER SET latin1 ;
USE `roussef` ;

-- -----------------------------------------------------
-- Table `customer`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `customer` ;

CREATE TABLE IF NOT EXISTS `customer` (
  `customerId` INT(11) NOT NULL AUTO_INCREMENT,
  `customerName` VARCHAR(50) NOT NULL,
  `customerPhone` VARCHAR(50) NOT NULL,
  `customerAddressLine1` VARCHAR(50) NOT NULL,
  `customerAddressLine2` VARCHAR(50) NULL DEFAULT NULL,
  `customerCity` VARCHAR(50) NOT NULL,
  `customerState` VARCHAR(50) NULL DEFAULT NULL,
  `customerCountry` VARCHAR(50) NOT NULL,
  `customerPostalCode` VARCHAR(15) NULL DEFAULT NULL,
  `customerDeleted` BINARY NOT NULL DEFAULT 0,
  PRIMARY KEY (`customerId`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `restaurant`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `restaurant` ;

CREATE TABLE IF NOT EXISTS `restaurant` (
  `restaurantId` INT(11) NOT NULL AUTO_INCREMENT,
  `restaurantName` VARCHAR(45) NOT NULL,
  `restaurantPhone` VARCHAR(50) NOT NULL,
  `restaurantAddressLine1` VARCHAR(50) NULL DEFAULT NULL,
  `restaurantAddressLine2` VARCHAR(50) NULL DEFAULT NULL,
  `restaurantCity` VARCHAR(50) NOT NULL,
  `restaurantState` VARCHAR(50) NULL DEFAULT NULL,
  `restaurantCountry` VARCHAR(50) NOT NULL,
  `restaurantPostalCode` VARCHAR(15) NOT NULL,
  `restaurantDeleted` BINARY NOT NULL DEFAULT 0,
  PRIMARY KEY (`restaurantId`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `role`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `role` ;

CREATE TABLE IF NOT EXISTS `role` (
  `roleId` INT(11) NOT NULL AUTO_INCREMENT,
  `roleName` VARCHAR(45) NULL DEFAULT NULL,
  `roleDeleted` BINARY NOT NULL DEFAULT 0,
  `roleDescription` VARCHAR(100) NULL,
  PRIMARY KEY (`roleId`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `employee`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `employee` ;

CREATE TABLE IF NOT EXISTS `employee` (
  `employeeId` INT(11) NOT NULL AUTO_INCREMENT,
  `employeeSSN` VARCHAR(45) NOT NULL,
  `employeeLastName` VARCHAR(50) NOT NULL,
  `employeeFirstName` VARCHAR(50) NOT NULL,
  `employeeEmail` VARCHAR(100) NOT NULL,
  `restaurantId` INT(11) NOT NULL,
  `employeeReportsTo` INT(11) NULL DEFAULT NULL,
  `employeeJobTitle` VARCHAR(50) NOT NULL,
  `employeeUserName` VARCHAR(45) NOT NULL,
  `employeePassword` VARCHAR(100) NULL DEFAULT NULL,
  `roleId` INT(11) NOT NULL,
  `employeeDeleted` BINARY NOT NULL DEFAULT 0,
  PRIMARY KEY (`employeeId`),
  CONSTRAINT `employees_ibfk_1`
    FOREIGN KEY (`employeeReportsTo`)
    REFERENCES `employee` (`employeeId`),
  CONSTRAINT `restaurantId`
    FOREIGN KEY (`restaurantId`)
    REFERENCES `restaurant` (`restaurantId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `roleId`
    FOREIGN KEY (`roleId`)
    REFERENCES `role` (`roleId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

CREATE UNIQUE INDEX `employeeSSN_UNIQUE` ON `employee` (`employeeSSN` ASC);

CREATE INDEX `reportsTo` ON `employee` (`employeeReportsTo` ASC);

CREATE INDEX `restaurantId_idx` ON `employee` (`restaurantId` ASC);

CREATE INDEX `roleId_idx` ON `employee` (`roleId` ASC);


-- -----------------------------------------------------
-- Table `order`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `order` ;

CREATE TABLE IF NOT EXISTS `order` (
  `orderId` INT(11) NOT NULL AUTO_INCREMENT,
  `orderDate` DATETIME NOT NULL,
  `customerId` INT(11) NULL DEFAULT NULL,
  `orderTableNumber` INT(11) NOT NULL,
  `employeeId` INT(11) NULL DEFAULT NULL,
  `restaurantId` INT(11) NULL DEFAULT NULL,
  `orderDeleted` BINARY NOT NULL DEFAULT 0,
  `orderEndDate` DATETIME NULL,
  PRIMARY KEY (`orderId`),
  CONSTRAINT `FK_orders_ibfk_1`
    FOREIGN KEY (`customerId`)
    REFERENCES `customer` (`customerId`),
  CONSTRAINT `FK_order_restaurantId`
    FOREIGN KEY (`restaurantId`)
    REFERENCES `restaurant` (`restaurantId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

CREATE INDEX `customerNumber` ON `order` (`customerId` ASC);

CREATE INDEX `restaurantId_idx` ON `order` (`restaurantId` ASC);


-- -----------------------------------------------------
-- Table `product`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `product` ;

CREATE TABLE IF NOT EXISTS `product` (
  `productId` INT(11) NOT NULL AUTO_INCREMENT,
  `productName` VARCHAR(70) NOT NULL,
  `productVendor` VARCHAR(50) NOT NULL,
  `productDescription` TEXT NOT NULL,
  `productDeleted` BINARY NOT NULL DEFAULT 0,
  PRIMARY KEY (`productId`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `orderdetail`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `orderdetail` ;

CREATE TABLE IF NOT EXISTS `orderdetail` (
  `orderdetailId` INT(11) NOT NULL AUTO_INCREMENT,
  `orderId` INT(11) NOT NULL,
  `productId` INT(11) NOT NULL,
  `orderdetailQuantity` INT(11) NOT NULL,
  `orderdetailPrice` DOUBLE NOT NULL,
  `orderdetailChair` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`orderdetailId`),
  CONSTRAINT `FK_orderdetail_orderdetails_ibfk`
    FOREIGN KEY (`orderId`)
    REFERENCES `order` (`orderId`),
  CONSTRAINT `FK_orderdetail_orderdetails_ibfk_2`
    FOREIGN KEY (`productId`)
    REFERENCES `product` (`productId`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

CREATE INDEX `FK_orderdetail_orderdetails_ibfk1` ON `orderdetail` (`orderId` ASC);

CREATE INDEX `productCode` ON `orderdetail` (`productId` ASC);


-- -----------------------------------------------------
-- Table `stock`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stock` ;

CREATE TABLE IF NOT EXISTS `stock` (
  `stockId` INT(11) NOT NULL AUTO_INCREMENT,
  `productId` INT(11) NOT NULL,
  `restaurantId` INT(11) NOT NULL,
  `stockQuantity` INT(11) NOT NULL DEFAULT 0,
  `stockSaleTaxRate` DECIMAL(10,2) NOT NULL,
  `stockProductBuyPrice` DECIMAL(10,2) NOT NULL,
  `stockProductPrice` DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (`stockId`, `restaurantId`, `productId`),
  CONSTRAINT `FK_stock_productId`
    FOREIGN KEY (`productId`)
    REFERENCES `product` (`productId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_stock_restaurantId`
    FOREIGN KEY (`restaurantId`)
    REFERENCES `restaurant` (`restaurantId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

CREATE INDEX `productId_idx` ON `stock` (`productId` ASC);

CREATE INDEX `restaurantId_idx` ON `stock` (`restaurantId` ASC);

USE `roussef` ;

-- -----------------------------------------------------
-- Placeholder table for view `vwRestaurant`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `vwRestaurant` (`restaurantId` INT, `restaurantName` INT, `restaurantPhone` INT, `restaurantAddressLine1` INT, `restaurantAddressLine2` INT, `restaurantCity` INT, `restaurantState` INT, `restaurantCountry` INT, `restaurantPostalCode` INT, `restaurantDeleted` INT);

-- -----------------------------------------------------
-- Placeholder table for view `vwProduct`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `vwProduct` (`productId` INT, `productName` INT, `productVendor` INT, `productDescription` INT, `productDeleted` INT);

-- -----------------------------------------------------
-- Placeholder table for view `vwEmployee`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `vwEmployee` (`employeeId` INT, `employeeSSN` INT, `employeeLastName` INT, `employeeFirstName` INT, `employeeEmail` INT, `restaurantId` INT, `employeeReportsTo` INT, `employeeJobTitle` INT, `employeeUserName` INT, `employeePassword` INT, `roleId` INT, `employeeDeleted` INT);

-- -----------------------------------------------------
-- Placeholder table for view `vwCustomer`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `vwCustomer` (`customerId` INT, `customerName` INT, `customerPhone` INT, `customerAddressLine1` INT, `customerAddressLine2` INT, `customerCity` INT, `customerState` INT, `customerCountry` INT, `customerPostalCode` INT, `customerDeleted` INT);

-- -----------------------------------------------------
-- Placeholder table for view `vwOrder`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `vwOrder` (`orderId` INT, `orderDate` INT, `customerId` INT, `orderTableNumber` INT, `employeeId` INT, `restaurantId` INT, `orderDeleted` INT);

-- -----------------------------------------------------
-- View `vwRestaurant`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `vwRestaurant` ;
DROP TABLE IF EXISTS `vwRestaurant`;
USE `roussef`;
CREATE  OR REPLACE VIEW `vwRestaurant` AS
    SELECT 
        *
    FROM
        `restaurant`
    WHERE
        `restaurant`.`restaurantDeleted` = 0;


-- -----------------------------------------------------
-- View `vwProduct`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `vwProduct` ;
DROP TABLE IF EXISTS `vwProduct`;
USE `roussef`;
CREATE  OR REPLACE VIEW `vwProduct` AS
    SELECT 
        *
    FROM
        `product`
    WHERE
        `product`.`productDeleted` = 0;


-- -----------------------------------------------------
-- View `vwEmployee`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `vwEmployee` ;
DROP TABLE IF EXISTS `vwEmployee`;
USE `roussef`;
CREATE  OR REPLACE VIEW `vwEmployee` AS
    SELECT 
        *
    FROM
        `employee`
    WHERE
        `employee`.`employeeDeleted` = 0;


-- -----------------------------------------------------
-- View `vwCustomer`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `vwCustomer` ;
DROP TABLE IF EXISTS `vwCustomer`;
USE `roussef`;
CREATE  OR REPLACE VIEW `vwCustomer` AS
    SELECT 
        *
    FROM
        `customer`
    WHERE
        `customer`.`customerDeleted` = 0;


-- -----------------------------------------------------
-- View `vwOrder`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `vwOrder` ;
DROP TABLE IF EXISTS `vwOrder`;
USE `roussef`;
CREATE  OR REPLACE VIEW `vwOrder` AS
    SELECT 
        *
    FROM
        `order`
    WHERE
        `order`.`orderDeleted` = 0;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

DELIMITER //
CREATE TRIGGER ins_order BEFORE INSERT ON `order`
FOR EACH ROW
BEGIN
    SET NEW.orderDate = NOW();
END;//
DELIMITER ;
