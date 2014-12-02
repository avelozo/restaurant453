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
  `employeePassword` VARCHAR(45) NULL DEFAULT NULL,
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
  `orderDate` DATE NOT NULL,
  `customerId` INT(11) NULL DEFAULT NULL,
  `orderTableNumber` INT(11) NOT NULL,
  `employeeId` INT(11) NULL DEFAULT NULL,
  `restaurantId` INT(11) NULL DEFAULT NULL,
  `orderDeleted` BINARY NOT NULL DEFAULT 0,
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


-- -----------------------------------------------------
-- Table `customer` Content
-- -----------------------------------------------------
INSERT INTO `customer` VALUES (0, 'John'	, '493-798-2568', '3254 W Wilson'	, NULL, 'Chicago', 'IL', 'USA', '63255', 0);
INSERT INTO `customer` VALUES (0, 'Sam'		, '312-852-6321', '2111 N Lincoln'	, NULL, 'Chicago', 'IL', 'USA', '62152', 0);
INSERT INTO `customer` VALUES (0, 'Peter'	, '493-963-1528', '3254 W Addison'	, NULL, 'Chicago', 'IL', 'USA', '62851', 0);
INSERT INTO `customer` VALUES (0, 'Sue'		, '312-741-4582', '1774 S Michigan'	, NULL, 'Chicago', 'IL', 'USA', '61485', 0);
INSERT INTO `customer` VALUES (0, 'Bob'		, '493-302-1125', '6485 N Clark'	, NULL, 'Chicago', 'IL', 'USA', '65789', 0);


-- -----------------------------------------------------
-- Table `restaurant` Content
-- -----------------------------------------------------
INSERT INTO `restaurant` VALUES (0, 'Rogers Park'	, '321-789-8585', '7484 N Sheridan'	, NULL, 'Chicago', 'IL', 'USA', '65655', 0); 
INSERT INTO `restaurant` VALUES (0, 'Edgewater'		, '312-555-6464', '6520 N Broadway'	, NULL, 'Chicago', 'IL', 'USA', '65120', 0); 
INSERT INTO `restaurant` VALUES (0, 'Uptown'		, '425-858-7413', '1250 W Foster'	, NULL, 'Chicago', 'IL', 'USA', '64780', 0); 


-- -----------------------------------------------------
-- Table `role` Content
-- -----------------------------------------------------
INSERT INTO `role` VALUES (0, 'Administrator'	, 0);
INSERT INTO `role` VALUES (0, 'Operator'		, 0);


-- -----------------------------------------------------
-- Table `employee` Content
-- -----------------------------------------------------
INSERT INTO `employee` VALUES (0, '123-45-6789', 'Tuttle'	, 'Dennis'	, 'dennis@gmail.com'	, 1, NULL	, 'IT Manager'	, 'dennis'	, NULL, 1, 0);
INSERT INTO `employee` VALUES (0, '234-56-7891', 'Hruby'	, 'Marylin'	, 'marylin@hotmail.com'	, 1, NULL	, 'Manager'		, 'marylin'	, NULL, 2, 0);
INSERT INTO `employee` VALUES (0, '321-54-9876', 'Defranco'	, 'Juana'	, 'juana@gmail.com'		, 1, 2		, 'Waitress'	, 'juana'	, NULL, 2, 0);
INSERT INTO `employee` VALUES (0, '456-78-9123', 'Kimery'	, 'Lewis'	, 'lewis@hotmail.com'	, 1, 2		, 'Waiter'		, 'lewis'	, NULL, 2, 0);
INSERT INTO `employee` VALUES (0, '555-55-6666', 'Driggers'	, 'Frank'	, 'frank@gmail.com'		, 2, NULL	, 'Manager'		, 'frank'	, NULL, 2, 0);
INSERT INTO `employee` VALUES (0, '888-45-9852', 'Disla'	, 'Scarlett', 'scarlett@gmail.com'	, 2, 5		, 'Waitress'	, 'scarlett', NULL, 2, 0);
INSERT INTO `employee` VALUES (0, '852-14-3698', 'Haga'		, 'Joseph'	, 'joseph@gmail.com'	, 2, 5		, 'Waiter'		, 'joseph'	, NULL, 2, 0);
INSERT INTO `employee` VALUES (0, '487-55-6666', 'Feemster'	, 'Arlen'	, 'arlen@hotmail.com'	, 3, NULL	, 'Manager'		, 'arlen'	, NULL, 2, 0);
INSERT INTO `employee` VALUES (0, '215-45-9852', 'Haus'		, 'Johanna'	, 'johanna@gmail.com'	, 3, 8		, 'Waitress'	, 'johanna'	, NULL, 2, 0);
INSERT INTO `employee` VALUES (0, '654-14-3698', 'Hance'	, 'Diego'	, 'diego@hotmail.com'	, 3, 8		, 'Waiter'		, 'diego'	, NULL, 2, 0);


-- -----------------------------------------------------
-- Table `order` Content
-- -----------------------------------------------------
INSERT INTO `order` VALUES (0, '2014-12-02', NULL, 1, 3, 1, 0);
INSERT INTO `order` VALUES (0, '2014-12-02', NULL, 2, 4, 1, 0);
INSERT INTO `order` VALUES (0, '2014-12-02', NULL, 3, 3, 1, 0);


-- -----------------------------------------------------
-- Table `product` Content
-- -----------------------------------------------------
INSERT INTO `product` VALUES (0, 'Cheese Burger', 'Fries Inc'	, 'Burger with cheese'	, 0);
INSERT INTO `product` VALUES (0, 'Chicken Wings', 'Fries Inc'	, 'Wings with BBQ sauce', 0);
INSERT INTO `product` VALUES (0, 'Beef Burrito'	, 'Mex Inc'		, 'Burrito with beef'	, 0);
INSERT INTO `product` VALUES (0, 'Coca Cola'	, 'Drinks Inc'	, 'Regular Coca Cola'	, 0);
INSERT INTO `product` VALUES (0, 'Heineken'		, 'Drinks Inc'	, 'Beer'				, 0);


-- -----------------------------------------------------
-- Table `orderdetail` Content
-- -----------------------------------------------------
INSERT INTO `orderdetail` VALUES (0, 1, 1, 2, 10.00, '1');
INSERT INTO `orderdetail` VALUES (0, 1, 2, 1, 9.00 , '2');
INSERT INTO `orderdetail` VALUES (0, 1, 5, 1, 6.00 , '1');
INSERT INTO `orderdetail` VALUES (0, 1, 4, 1, 3.00 , '2');
INSERT INTO `orderdetail` VALUES (0, 2, 3, 1, 8.00 , '1');
INSERT INTO `orderdetail` VALUES (0, 2, 4, 1, 3.00 , '1');
INSERT INTO `orderdetail` VALUES (0, 3, 1, 1, 9.00 , '1');
INSERT INTO `orderdetail` VALUES (0, 3, 5, 1, 6.00 , '1');


-- -----------------------------------------------------
-- Table `stock` Content
-- -----------------------------------------------------
INSERT INTO `stock` VALUES (0, 1, 1, 30, 2.50, 1.50, 5.00);
INSERT INTO `stock` VALUES (0, 2, 1, 15, 2.50, 3.50, 9.00);
INSERT INTO `stock` VALUES (0, 3, 1, 20, 2.50, 2.75, 8.00);
INSERT INTO `stock` VALUES (0, 4, 1, 50, 9.25, 0.50, 3.00);
INSERT INTO `stock` VALUES (0, 5, 1, 80, 9.25, 1.00, 6.00);
INSERT INTO `stock` VALUES (0, 1, 2, 40, 2.50, 1.50, 5.00);
INSERT INTO `stock` VALUES (0, 2, 2, 25, 2.50, 3.50, 9.00);
INSERT INTO `stock` VALUES (0, 3, 2, 30, 2.50, 2.75, 8.00);
INSERT INTO `stock` VALUES (0, 4, 2, 60, 9.25, 0.50, 3.00);
INSERT INTO `stock` VALUES (0, 5, 2, 90, 9.25, 1.00, 6.00);
INSERT INTO `stock` VALUES (0, 1, 3, 35, 2.50, 1.50, 5.00);
INSERT INTO `stock` VALUES (0, 2, 3, 20, 2.50, 3.50, 9.00);
INSERT INTO `stock` VALUES (0, 3, 3, 25, 2.50, 2.75, 8.00);
INSERT INTO `stock` VALUES (0, 4, 3, 55, 9.25, 0.50, 3.00);
INSERT INTO `stock` VALUES (0, 5, 3, 85, 9.25, 1.00, 6.00);
