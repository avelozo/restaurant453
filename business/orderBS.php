<?php

	include_once DIR_BASE . "mapper/orderMapper.php";
	include_once DIR_BASE . "model/model.order.php";
	include_once DIR_BASE . "model/model.orderdetail.php";
	include_once DIR_BASE . "model/model.employee.php";
	include_once DIR_BASE . "business/customerBS.php";
	include_once DIR_BASE . "business/employeeBS.php";
	include_once DIR_BASE . "business/restaurantBS.php";
	include_once DIR_BASE . "business/productBS.php";

	class OrderBS
	{
		private $orderMapper;
		private $customerBS;
		private $employeeBS;
		private $restaurantBS;
		private $productBS;

		function OrderBS()
		{
			$this->orderMapper = new OrderMapper();
			$this->customerBS = new CustomerBS();
			$this->employeeBS = new EmployeeBS();
			$this->restaurantBS = new RestaurantBS();
			$this->productBS = new ProductBS();
		}

		public function getOrders($orderId = null, $restaurantId = null, $employeeId = null)
 		{
 			return $this->orderMapper->getOrders($orderId, $restaurantId, $employeeId);
 		}
		
		public function getOrderStats($initialDate, $endDate)
		{
			$time = strtotime($initialDate);
			$initialDate = date('Y-m-d',$time);

			$time = strtotime($endDate);
			$endDate = date('Y-m-d',$time);
			
			return $this->orderMapper->getOrderStats($initialDate, $endDate);
		}

		public function addOrder($order)
		{
			return $this->orderMapper->addOrder($order);
		}
		
		public function addOrderDetail($orderDetail)
		{
			$connection = $this->orderMapper->getConnection();



			try
			{
				$connection->exec('LOCK TABLES `stock` WRITE, 
											   `orderDetail` WRITE, 
											   `vwproduct` WRITE, 
											   `vwrestaurant` WRITE ');

				$connection->beginTransaction();

				$product = $this->productBS->getProducts($orderDetail->product->restaurant->id, $orderDetail->product->id, false, $connection)[0];

				$this->orderMapper->addOrderDetail($orderDetail, $connection);


				if($product->quantityInStock < $orderDetail->quantityOrdered)
				{
					throw new Exception('Insufficient stock. Cannot sell this quantity.');
				}
				
				$product->quantityInStock -= $orderDetail->quantityOrdered;

				$this->productBS->updateProductStock($product, $connection);	

			    $connection->commit();
				$connection->exec('UNLOCK TABLES');
				
				return true;
			}
			catch(Exception $e)
			{
				$connection->rollBack();
				$connection->exec('UNLOCK TABLES');
 				
 				return array('message' => $e->getMessage(),
					'errorCode' => 'HTTP/1.1 409 Conflict');
			} 
		}

		public function updateOrder($order)
		{
			return $this->orderMapper->updateOrder($order);
		}
		
		public function deleteOrder($id)
		{
			return $this->orderMapper->deleteOrder($id);
		}

		public function payOrder($orderId)
		{
			$order = $this->getOrders($orderId)[0];

			$order->endDate = date("Y-m-d H:i:s");
			
			$this->updateOrder($order);
		}

		public function addCustomer($orderId, $customerId)
		{
			$order = $this->getOrders($orderId)[0];

			$customer = $this->customerBS->getCustomers($customerId);

			if(count($customer) > 0)
			{
				$order->customer = $customer[0];
				$this->updateOrder($order);
				return $order;
			}
			else
			{
				return array('message' => 'Customer ' . $customerId . ' not found.',
					'errorCode' => 'HTTP/1.1 409 Conflict');
			}
		}

		public function addTable($employeeId, $tableNumber)
		{
			$employee = $this->employeeBS->getEmployees($employeeId)[0];

			$orders = $this->orderMapper->getOrders(null, $employee->restaurant->id, null);

			$neededOrder = null; 

			foreach($orders as $or)
			{
				if($or->tableNumber == $tableNumber)
				{
					$neededOrder = $or;
					break;
				}
			}

			if($neededOrder != null)
			{
				return array('message' => 'Table ' . $tableNumber . ' already being served.',
					'errorCode' => 'HTTP/1.1 409 Conflict');
			}
			else
			{
				$order = new Order();
				$order->employee = $this->employeeBS->getEmployees($employeeId)[0];
				$order->date = date("Y-m-d H:i:s");
				$order->restaurant = $order->employee->restaurant;
				$order->tableNumber = $tableNumber;

				$this->addOrder($order);
			}
		}
	}