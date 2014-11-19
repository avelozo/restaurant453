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
  `customerId` INT(11) NOT NULL,
  `customerName` VARCHAR(50) NOT NULL,
  `phone` VARCHAR(50) NOT NULL,
  `addressLine1` VARCHAR(50) NOT NULL,
  `addressLine2` VARCHAR(50) NULL DEFAULT NULL,
  `city` VARCHAR(50) NOT NULL,
  `state` VARCHAR(50) NULL DEFAULT NULL,
  `country` VARCHAR(50) NOT NULL,
  `postalCode` VARCHAR(15) NULL DEFAULT NULL,
  PRIMARY KEY (`customerId`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `restaurant`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `restaurant` ;

CREATE TABLE IF NOT EXISTS `restaurant` (
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
-- Table `employee`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `employee` ;

CREATE TABLE IF NOT EXISTS `employee` (
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
  CONSTRAINT `restaurantId`
    FOREIGN KEY (`restaurantId`)
    REFERENCES `restaurant` (`restaurantId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

ALTER TABLE `employee`
ADD CONSTRAINT `employees_ibfk_1`
FOREIGN KEY (`reportsTo`) REFERENCES employee(employeeId);

CREATE INDEX `reportsTo` ON `employee` (`reportsTo` ASC);

CREATE INDEX `restaurantId_idx` ON `employee` (`restaurantId` ASC);


-- -----------------------------------------------------
-- Table `order`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `order` ;

CREATE TABLE IF NOT EXISTS `order` (
  `orderId` INT(11) NOT NULL,
  `orderDate` DATE NOT NULL,
  `customerId` INT(11) NULL,
  `tableNumber` INT NOT NULL,
  `employeeId` INT NULL,
  `restaurantId` INT NULL,
  PRIMARY KEY (`orderId`),
  CONSTRAINT `orders_ibfk_11`
    FOREIGN KEY (`customerId`)
    REFERENCES `customer` (`customerId`),
  CONSTRAINT `restaurantId_1`
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
  `productId` INT NOT NULL,
  `name` VARCHAR(70) NOT NULL,
  `vendor` VARCHAR(50) NOT NULL,
  `description` TEXT NOT NULL,
  `buyPrice` DOUBLE NOT NULL,
  `price` DOUBLE NOT NULL,
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
  `quantityOrdered` INT(11) NOT NULL,
  `priceEach` DOUBLE NOT NULL,
  `chair` VARCHAR(45) NULL,
  PRIMARY KEY (`orderdetailId`),
  CONSTRAINT `orderdetails_ibfk_1`
    FOREIGN KEY (`orderId`)
    REFERENCES `order` (`orderId`),
  CONSTRAINT `orderdetails_ibfk_2`
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
  `quantityInStock` DECIMAL(4,2) NOT NULL DEFAULT 0,
  PRIMARY KEY (`stockId`, `restaurantId`, `productId`),
  CONSTRAINT `FK_productId_1`
    FOREIGN KEY (`productId`)
    REFERENCES `product` (`productId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_restaurantId_1`
    FOREIGN KEY (`restaurantId`)
    REFERENCES `restaurant` (`restaurantId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `productId_idx` ON `stock` (`productId` ASC);

CREATE INDEX `restaurantId_idx` ON `stock` (`restaurantId` ASC);


-- -----------------------------------------------------
-- Table `role`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `role` ;

CREATE TABLE IF NOT EXISTS `role` (
  `roleId` INT NOT NULL AUTO_INCREMENT,
  `roleName` VARCHAR(45) NULL,
  PRIMARY KEY (`roleId`),
  CONSTRAINT `roleId`
    FOREIGN KEY (`roleId`)
    REFERENCES `employee` (`employeeId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
