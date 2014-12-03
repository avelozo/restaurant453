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

		public function getOrders($id = null)
		{
			return $this->orderMapper->getOrders($id);
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
	}