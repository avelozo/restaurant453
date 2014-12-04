<?php
	include_once DIR_BASE . "dataaccess/db.inc.php";

	class OrderDA extends BaseDB
	{
		private $conn;

		function OrderDA()
		{
			$this->conn = parent::connectDatabase();
		}

		public function getOrders($orderId = null, $restaurantId = null, $employeeId = null, $connection = null)
		{
			if($connection == null)
				$connection = $this->conn;

			try
			{
			  	$sql = 'SELECT 
							`order`.*,
							`customer`.*,
							`employee`.*,
							`restaurant`.*,
							`product`.*,
							`stock`.*,
							`orderdetail`.`orderdetailId`,
						    `orderdetail`.`productId`,
						    `orderdetail`.`orderdetailQuantity`,
						    `orderdetail`.`orderdetailPrice`,
						    `orderdetail`.`orderdetailChair`
						FROM 
							`order`
							LEFT JOIN
							`customer`
							ON `order`.`customerId` = `customer`.`customerId`
							LEFT JOIN
							`employee`
							ON `order`.`employeeId` = `employee`.`employeeId`
							LEFT JOIN
							`restaurant`
							ON `order`.`restaurantId` = `restaurant`.`restaurantId`
							LEFT JOIN
							`orderdetail`
							ON `order`.`orderId` = `orderdetail`.`orderId`
							LEFT JOIN
							`product`
							ON `orderdetail`.`productId` = `product`.`productId` 
							LEFT JOIN
							`stock`
							ON `stock`.`productId` = `product`.`productId` 
								AND `stock`.`restaurantId` = `restaurant`.`restaurantId` ';


				if($orderId != null)
				{
					$sql .= " WHERE `order`.`orderId` = :id ";
				}
				elseif($restaurantId != null)
				{
					$sql .= " WHERE `order`.`restaurantId` = :id  AND `order`.`orderEndDate` IS NULL ";
				}
				elseif($employeeId != null)
				{
					$sql .= " WHERE `order`.`employeeId` = :id AND `order`.`orderEndDate` IS NULL ";
				}

				$sql .= " ORDER BY `order`.`orderId` ; ";

			    $prep = $connection->prepare($sql);
			    
			    if($orderId != null)
			    {
		    		$prep->bindValue(':id', $orderId);
		    	}
				elseif($restaurantId != null)
				{
		    		$prep->bindValue(':id', $restaurantId);
		    	}
				elseif($employeeId != null)
				{
		    		$prep->bindValue(':id', $employeeId);
		    	}

			    $prep->execute();
			    return $prep->fetchAll();
			}
			catch (PDOException $e)
			{
			    $error = 'Error fetching orders: ' . $e->getMessage();
			    die($error);
			    exit();
			}	
		}

		public function getOrderStats($initialDate, $endDate, $connection = null)
		{
			if($connection == null)
				$connection = $this->conn;

			try
			{
			  	$sql = 'SELECT
							T4.orderDate AS orderDate,
							T4.orderQuantity AS orderQuantity,
							T4.orderPriceTotal AS orderPriceTotal,
							T4.averageTicket AS averageTicket,
							T3.averagePriceTotal AS averagePriceTotal,
							T3.averageAverageTicket AS averageAverageTicket,
							T4.orderPriceTotal > T3.averagePriceTotal AS priceTotalAboveAverage,
							T4.averageTicket > T3.averageAverageTicket AS averageTicketAboveAverage
						FROM
							(
							SELECT
								AVG(T2.orderPriceTotal) AS averagePriceTotal,
								AVG(T2.averageTicket) AS averageAverageTicket
							FROM
								(
								SELECT
									DATE(O1.orderDate) AS orderDate,
									COUNT(*) AS orderQuantity,
									SUM(T1.orderPriceSum) AS orderPriceTotal,
									SUM(T1.orderPriceSum) / COUNT(*) AS averageTicket
								FROM
									(
									SELECT
										O1.orderId,
										SUM(O2.orderdetailPrice) AS orderPriceSum
									FROM
										`order` AS O1
									JOIN
										orderdetail AS O2 USING (orderId)
									WHERE
										O1.orderDate > :initialDate
										AND	O1.orderDate < :endDate
									GROUP BY
										O1.orderId
									) AS T1
								JOIN
									`order` AS O1 USING (orderID)
								GROUP BY
									DATE(O1.orderDate)
								) AS T2
							) AS T3
						JOIN
							(
							SELECT
								DATE(O1.orderDate) AS orderDate,
								COUNT(*) AS orderQuantity,
								SUM(T1.orderPriceSum) AS orderPriceTotal,
								SUM(T1.orderPriceSum) / COUNT(*) AS averageTicket
							FROM
								(
								SELECT
									O1.orderId,
									SUM(O2.orderdetailPrice) AS orderPriceSum
								FROM
									`order` AS O1
								JOIN
									orderdetail AS O2 USING (orderId)
								WHERE
									O1.orderDate > :initialDate
								AND	O1.orderDate < :endDate
								GROUP BY
									O1.orderId
								) AS T1
							JOIN
								`order` AS O1 USING (orderID)
							GROUP BY
								DATE(O1.orderDate)
							) AS T4
						ORDER BY
							T4.orderDate';

			    $prep = $connection->prepare($sql);
			    
		    	$prep->bindValue(':initialDate', $initialDate);
	    		$prep->bindValue(':endDate', $endDate);

			    $prep->execute();
			    return $prep->fetchAll();
			}
			catch (PDOException $e)
			{
			    $error = 'Error fetching orders statistics: ' . $e->getMessage();
			    die($error);
			}	
		}

		public function addOrder($order, $connection = null)
		{
			if($connection == null)
				$connection = $this->conn;

			try
			{
				$connection->beginTransaction();

				$sql = 'INSERT INTO `order`
						(`orderDate`,
						`customerId`,
						`orderTableNumber`,
						`employeeId`,
						`restaurantId`)
						VALUES
						(:orderDate,
						:customerId,
						:orderTableNumber,
						:employeeId,
						:restaurantId)';

			    $prep = $connection->prepare($sql);
			    $prep->bindValue(':orderDate', $order->date);
			    if(isset($order->customer->id))
			    {
			    	$prep->bindValue(':customerId', $order->customer->id);
			    }
			    else
			    {
			    	$prep->bindValue(':customerId', null);
			    }
			    $prep->bindValue(':orderTableNumber', $order->tableNumber);
				$prep->bindValue(':employeeId', $order->employee->id);
			    $prep->bindValue(':restaurantId', $order->restaurant->id);
			   
			    $prep->execute();

			    $order->id = $connection->lastInsertId();

			    if(isset($order->orderDetails) && is_array($order->orderDetails))
			    {
				    foreach($order->orderDetails as $od)
					{
						$od->order = $order;
				    	$this->addOrderDetail($od, $connection);
				    }	
			    }
			    
			    $connection->commit();

			    return true;
		    }
			catch (PDOException $e)
			{
				$connection->rollBack();

				$error = 'Error inserting product: ' . $e->getMessage();
				die($error);
				exit();
			}
		}
		
		public function addOrderDetail($orderDetail, $connection = null)
		{
			if($connection == null)
				$connection = $this->conn;
			
			try
			{
				$sql = 'INSERT INTO `orderdetail`
						(`orderId`,
						`productId`,
						`orderdetailQuantity`,
						`orderdetailPrice`,
						`orderdetailChair`)
						VALUES
						(:orderId,
						:productId,
						:orderdetailQuantity,
						:orderdetailPrice,
						:orderdetailChair)';

			    $prep = $connection->prepare($sql);
			    $prep->bindValue(':orderId', $orderDetail->order->id);
			    $prep->bindValue(':productId', $orderDetail->product->id);
			    $prep->bindValue(':orderdetailQuantity', $orderDetail->quantityOrdered);
				$prep->bindValue(':orderdetailPrice', $orderDetail->priceEach);
			    $prep->bindValue(':orderdetailChair', $orderDetail->chair);
			   
			    $prep->execute();

			    $orderDetail->id = $connection->lastInsertId();

			    return true;
		    }
			catch (PDOException $e)
			{
				$error = 'Error inserting product: ' . $e->getMessage();
				die($error);
				exit();
			}
		}	

		public function updateOrderDetail($orderDetail, $connection = null)
		{
			if($connection == null)
			{
				$connection = $this->conn;
			}

			try
			{
				$sql = 'UPDATE `orderdetail` SET 
						`orderId` = :orderId,
						`productId` = :productId,
						`orderdetailQuantity` = :orderdetailQuantity,
						`orderdetailPrice` = :orderdetailPrice,
						`orderdetailChair` = :orderdetailChair
						WHERE `orderDetailId` = :id';

			    $prep = $connection->prepare($sql);
			    $prep->bindValue(':orderId', $orderDetail->order->id);
			    $prep->bindValue(':productId', $orderDetail->product->id);
			    $prep->bindValue(':orderdetailQuantity', $orderDetail->quantityOrdered);
				$prep->bindValue(':orderdetailPrice', $orderDetail->priceEach);
			    $prep->bindValue(':orderdetailChair', $orderDetail->chair);
			    $prep->bindValue(':orderdetailChair', $orderDetail->chair);
			    $prep->bindValue(':id', $orderDetail->id);
			   
			    $prep->execute();
			 
			    return true;
		    }
			catch (PDOException $e)
			{
				$error = 'Error inserting product: ' . $e->getMessage();
				die($error);
				exit();
			}
		}	

		public function updateOrder($order, $connection = null)
		{
			if($connection == null)
				$connection = $this->conn;

			try
			{
				$sql = 'UPDATE `order` SET 
						`orderDate` = :orderDate,
						`customerId` = :customerId,
						`orderTableNumber` = :orderTableNumber,
						`employeeId` = :employeeId,
						`restaurantId` = :restaurantId,
						`orderEndDate` = :orderEndDate
						WHERE `orderId` = :id';

			    $prep = $connection->prepare($sql);
			    $prep->bindValue(':orderDate', $order->date);
			    $prep->bindValue(':customerId', $order->customer->id);
			    $prep->bindValue(':orderTableNumber', $order->tableNumber);
				$prep->bindValue(':employeeId', $order->employee->id);
			    $prep->bindValue(':restaurantId', $order->restaurant->id);
			    $prep->bindValue(':orderEndDate', $order->endDate);
			    $prep->bindValue(':id', $order->id);
			   
			    $prep->execute();

			    return true;
		    }
			catch (PDOException $e)
			{
				$error = 'Error updating product: ' . $e->getMessage();
				die($error);
				exit();
			}
		}
	}