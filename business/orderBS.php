<?php

	include_once DIR_BASE . "mapper/orderMapper.php";
	include_once DIR_BASE . "model/model.order.php";
	include_once DIR_BASE . "model/model.orderdetail.php";
	include_once DIR_BASE . "business/customerBS.php";

	class OrderBS
	{
		private $orderMapper;
		private $customerBS;

		function OrderBS()
		{
			$this->orderMapper = new OrderMapper();
			$this->customerBS = new CustomerBS();
		}

		public function getOrders($orderId = null, $restaurantId = null, $employeeId = null)
 		{
			return $this->orderMapper->getOrders($orderId, $restaurantId, $employeeId);
 		}
		
		public function getOrderStats()
		{
			return $this->orderMapper->getOrderStats($initialDate, $endDate);
		}

		public function addOrder($order)
		{
			return $this->orderMapper->addOrder($order);
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
	}