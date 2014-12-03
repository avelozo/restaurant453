<?php
	include_once DIR_BASE . "dataaccess/db.inc.php";

	class OrderDA extends BaseDB
	{
		private $conn;

		function OrderDA()
		{
			$this->conn = parent::connectDatabase();
		}

		public function getOrders($id = null, $connection = null)
		{
			if($connection == null)
				$connection = $this->conn;

			try
			{
			  	$sql = 'SELECT 
							*
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
						ORDER BY `order`.`orderId`';

				if($id != null)
				{
					$sql .= " WHERE `order`.`orderId` = :id";
				}

			    $prep = $connection->prepare($sql);
			    
			    if($id != null)
			    {
		    		$prep->bindValue(':id', $id);
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
			    $prep->bindValue(':orderDate', $order->orderDate);
			    $prep->bindValue(':customerId', $order->customer->id);
			    $prep->bindValue(':orderTableNumber', $order->tableNumber);
				$prep->bindValue(':employeeId', $order->employee->id);
			    $prep->bindValue(':restaurantId', $order->restaurant->id);
			   
			    $prep->execute();

			    $order->id = $connection->lastInsertId();

			    for($order->orderDetails as $od)
				{
					$od->order = $order;
			    	$this->addOrderDetail($od, $connection);
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
			{
				$connection = $this->conn;
			}

			if($localConnection)
				$connection->beginTransaction();

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
						`restaurantId` = :restaurantId
						WHERE `orderId` = :id';

			    $prep = $connection->prepare($sql);
			    $prep->bindValue(':orderDate', $order->orderDate);
			    $prep->bindValue(':customerId', $order->customer->id);
			    $prep->bindValue(':orderTableNumber', $order->tableNumber);
				$prep->bindValue(':employeeId', $order->employee->id);
			    $prep->bindValue(':restaurantId', $order->restaurant->id);
			    $prep->bindValue(':id', $order->id);
			   
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
	}