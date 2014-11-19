SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema roussef
-- -----------------------------------------------------
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
  PRIMARY KEY (`customerId`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `restaurant`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `restaurant` ;

CREATE TABLE IF NOT EXISTS `restaurant` (
  `restaurantId` INT NOT NULL AUTO_INCREMENT,
  `restaurantName` VARCHAR(45) NOT NULL,
  `restaurantPhone` VARCHAR(50) NOT NULL,
  `restaurantAddressLine1` VARCHAR(50) NULL,
  `restaurantAddressLine2` VARCHAR(50) NULL DEFAULT NULL,
  `restaurantCity` VARCHAR(50) NOT NULL,
  `restaurantState` VARCHAR(50) NULL DEFAULT NULL,
  `restaurantCountry` VARCHAR(50) NOT NULL,
  `restaurantPostalCode` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`restaurantId`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `role`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `role` ;

CREATE TABLE IF NOT EXISTS `role` (
  `roleId` INT NOT NULL AUTO_INCREMENT,
  `roleName` VARCHAR(45) NULL,
  PRIMARY KEY (`roleId`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `employee`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `employee` ;

CREATE TABLE IF NOT EXISTS `employee` (
  `employeeId` INT(11) NOT NULL AUTO_INCREMENT,
  `employeeLastName` VARCHAR(50) NOT NULL,
  `employeeFirstName` VARCHAR(50) NOT NULL,
  `employeeEmail` VARCHAR(100) NOT NULL,
  `restaurantId` INT NOT NULL,
  `employeeReportsTo` INT(11) NULL DEFAULT NULL,
  `employeeJobTitle` VARCHAR(50) NOT NULL,
  `employeeUserName` VARCHAR(45) NOT NULL,
  `employeePassword` VARCHAR(45) NULL,
  `roleId` INT NOT NULL,
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

CREATE INDEX `reportsTo` ON `employee` (`employeeReportsTo` ASC);

CREATE INDEX `restaurantId_idx` ON `employee` (`restaurantId` ASC);

CREATE INDEX `roleId_idx` ON `employee` (`roleId` ASC);


-- -----------------------------------------------------
-- Table `order`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `order` ;

CREATE TABLE IF NOT EXISTS `order` (
  `orderId` INT(11) NOT NULL AUTO_INCREMENT,
  `orderDate` DATE NOT NULL,
  `customerId` INT(11) NULL,
  `orderTableNumber` INT NOT NULL,
  `employeeId` INT NULL,
  `restaurantId` INT NULL,
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
  `productId` INT NOT NULL AUTO_INCREMENT,
  `productName` VARCHAR(70) NOT NULL,
  `productVendor` VARCHAR(50) NOT NULL,
  `productDescription` TEXT NOT NULL,
  `productBuyPrice` DOUBLE NOT NULL,
  `productPrice` DOUBLE NOT NULL,
  PRIMARY KEY (`productId`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `orderdetail`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `orderdetail` ;

CREATE TABLE IF NOT EXISTS `orderdetail` (
  `orderdetailId` INT NOT NULL AUTO_INCREMENT,
  `orderId` INT(11) NOT NULL,
  `productId` INT NOT NULL,
  `orderdetailQuantity` INT(11) NOT NULL,
  `orderdetailPrice` DOUBLE NOT NULL,
  `orderdetailChair` VARCHAR(45) NULL,
  PRIMARY KEY (`orderdetailId`),
  CONSTRAINT `FK_orderdetail_orderdetails_ibfk`
    FOREIGN KEY (`orderId`)
    REFERENCES `order` (`orderId`),
  CONSTRAINT `FK_orderdetail_orderdetails_ibfk_2`
    FOREIGN KEY (`productId`)
    REFERENCES `product` (`productId`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

CREATE INDEX `productCode` ON `orderdetail` (`productId` ASC);


-- -----------------------------------------------------
-- Table `stock`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stock` ;

CREATE TABLE IF NOT EXISTS `stock` (
  `stockId` INT NOT NULL AUTO_INCREMENT,
  `productId` INT NOT NULL,
  `restaurantId` INT NOT NULL,
  `stockQuantity` DECIMAL(4,2) NOT NULL DEFAULT 0,
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
ENGINE = InnoDB;

CREATE INDEX `productId_idx` ON `stock` (`productId` ASC);

CREATE INDEX `restaurantId_idx` ON `stock` (`restaurantId` ASC);


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
