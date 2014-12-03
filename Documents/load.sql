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