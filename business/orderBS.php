<?php

	include_once DIR_BASE . "mapper/orderMapper.php";
	include_once DIR_BASE . "model/model.order.php";
	include_once DIR_BASE . "model/model.orderdetail.php";

	class OrderBS
	{
		private $orderMapper = null;

		function OrderBS()
		{
			$this->orderMapper = new OrderMapper();
		}

		public function getOrders($orderId = null, $restaurantId = null, $employeeId = null)
		{
			return $this->orderMapper->getOrders($orderId, $restaurantId, $employeeId);
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
	}