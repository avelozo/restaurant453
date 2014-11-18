SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema roussef
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `roussef` DEFAULT CHARACTER SET latin1 ;
USE `roussef` ;

-- -----------------------------------------------------
-- Table `roussef`.`roles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `roussef`.`roles` ;

CREATE TABLE IF NOT EXISTS `mydb`.`roles` (
  `roleId` INT NOT NULL AUTO_INCREMENT,
  `roleName` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`roleId`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `roussef`.`customers`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `roussef`.`customers` ;

CREATE TABLE IF NOT EXISTS `roussef`.`customers` (
  `customerId` INT(11) NOT NULL,
  `customerName` VARCHAR(50) NOT NULL,
  `phone` VARCHAR(50) NOT NULL,
  `addressLine1` VARCHAR(50) NOT NULL,
  `addressLine2` VARCHAR(50) NULL DEFAULT NULL,
  `city` VARCHAR(50) NOT NULL,
  `state` VARCHAR(50) NULL DEFAULT NULL,
  `postalCode` VARCHAR(15) NULL DEFAULT NULL,
  `country` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`customerId`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `roussef`.`restaurant`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `roussef`.`restaurant` ;

CREATE TABLE IF NOT EXISTS `roussef`.`restaurant` (
  `restaurantId` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `phone` VARCHAR(50) NOT NULL,
  `addressLine1` VARCHAR(50) NULL,
  `addressLine2` VARCHAR(50) NULL DEFAULT NULL,
  `city` VARCHAR(50) NOT NULL,
  `state` VARCHAR(50) NULL DEFAULT NULL,
  `country` VARCHAR(50) NOT NULL,
  `postalCode` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`restaurantId`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `roussef`.`employees`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `roussef`.`employees` ;

CREATE TABLE IF NOT EXISTS `roussef`.`employees` (
  `employeeId` INT(11) NOT NULL,
  `lastName` VARCHAR(50) NOT NULL,
  `firstName` VARCHAR(50) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `restaurantId` INT NOT NULL,
  `reportsTo` INT(11) NULL DEFAULT NULL,
  `jobTitle` VARCHAR(50) NOT NULL,
  `userName` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NULL,
  `roleId` INT NOT NULL,
  PRIMARY KEY (`employeeId`),
  INDEX `reportsTo` (`reportsTo` ASC),
  INDEX `employees_ibfk_2_idx` (`roleId` ASC),
  INDEX `restaurantId_idx` (`restaurantId` ASC),
  CONSTRAINT `employees_ibfk_1`
    FOREIGN KEY (`reportsTo`)
    REFERENCES `roussef`.`employees` (`employeeId`),
  CONSTRAINT `employees_ibfk_2`
    FOREIGN KEY (`roleId`)
    REFERENCES `mydb`.`roles` (`roleId`),
  CONSTRAINT `restaurantId`
    FOREIGN KEY (`restaurantId`)
    REFERENCES `roussef`.`restaurant` (`restaurantId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `roussef`.`orders`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `roussef`.`orders` ;

CREATE TABLE IF NOT EXISTS `roussef`.`orders` (
  `orderId` INT(11) NOT NULL,
  `orderDate` DATE NOT NULL,
  `customerId` INT(11) NULL,
  `tableNumber` INT NOT NULL,
  `employeeId` INT NULL,
  `restaurantId` INT NULL,
  PRIMARY KEY (`orderId`),
  INDEX `customerNumber` (`customerId` ASC),
  INDEX `restaurantId_idx` (`restaurantId` ASC),
  CONSTRAINT `orders_ibfk_1`
    FOREIGN KEY (`customerId`)
    REFERENCES `roussef`.`customers` (`customerId`),
  CONSTRAINT `restaurantId`
    FOREIGN KEY (`restaurantId`)
    REFERENCES `roussef`.`restaurant` (`restaurantId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `roussef`.`products`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `roussef`.`products` ;

CREATE TABLE IF NOT EXISTS `roussef`.`products` (
  `productId` INT NOT NULL,
  `productName` VARCHAR(70) NOT NULL,
  `productVendor` VARCHAR(50) NOT NULL,
  `productDescription` TEXT NOT NULL,
  `quantityInStock` SMALLINT(6) NOT NULL,
  `buyPrice` DOUBLE NOT NULL,
  `price` DOUBLE NOT NULL,
  PRIMARY KEY (`productId`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `roussef`.`orderdetails`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `roussef`.`orderdetails` ;

CREATE TABLE IF NOT EXISTS `roussef`.`orderdetails` (
  `orderId` INT(11) NOT NULL,
  `productId` VARCHAR(15) NOT NULL,
  `quantityOrdered` INT(11) NOT NULL,
  `priceEach` DOUBLE NOT NULL,
  `chair` VARCHAR(45) NULL,
  PRIMARY KEY (`orderId`),
  INDEX `productCode` (`productId` ASC),
  CONSTRAINT `orderdetails_ibfk_1`
    FOREIGN KEY (`orderId`)
    REFERENCES `roussef`.`orders` (`orderId`),
  CONSTRAINT `orderdetails_ibfk_2`
    FOREIGN KEY (`productId`)
    REFERENCES `roussef`.`products` (`productId`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `roussef`.`stock`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `roussef`.`stock` ;

CREATE TABLE IF NOT EXISTS `roussef`.`stock` (
  `stockId` INT NOT NULL AUTO_INCREMENT,
  `productId` INT NOT NULL,
  `restaurantId` INT NOT NULL,
  `quantityInStock` DECIMAL(4,2) NOT NULL DEFAULT 0,
  PRIMARY KEY (`stockId`, `restaurantId`, `productId`),
  INDEX `productId_idx` (`productId` ASC),
  INDEX `restaurantId_idx` (`restaurantId` ASC),
  CONSTRAINT `productId`
    FOREIGN KEY (`productId`)
    REFERENCES `roussef`.`products` (`productId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `restaurantId`
    FOREIGN KEY (`restaurantId`)
    REFERENCES `roussef`.`restaurant` (`restaurantId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `roussef` ;
