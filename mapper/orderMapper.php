<?php

	include_once DIR_BASE . "dataaccess/orderDA.php";
	include_once DIR_BASE . "model/model.order.php";
	include_once DIR_BASE . "model/model.orderdetail.php";
	include_once DIR_BASE . "model/model.orderstats.php";
	include_once DIR_BASE . "mapper/customerMapper.php";
	include_once DIR_BASE . "mapper/employeeMapper.php";
	include_once DIR_BASE . "mapper/restaurantMapper.php";
	include_once DIR_BASE . "mapper/productMapper.php";

	class OrderMapper
	{
		private $orderDAO;
		private $customerMapper;
		private $employeeMapper;
		private $restaurantMapper;
		private $productMapper;

		function OrderMapper()
		{
			$this->orderDAO = new OrderDA();
			$this->customerMapper = new CustomerMapper();
			$this->employeeMapper = new EmployeeMapper();
			$this->restaurantMapper = new RestaurantMapper();
			$this->productMapper = new ProductMapper();
		}

		public function getConnection()
		{
			return $this->orderDAO->connectDatabase();
		}

		public function getOrders($orderId = null, $restaurantId = null, $employeeId = null)
		{
			$ordersRet = [];

			$orders = $this->orderDAO->getOrders($orderId, $restaurantId, $employeeId);

			$currentOrder = null;
			

			foreach ($orders as $order)
			{
				if($currentOrder == null || $currentOrder->id != $order['orderId'])
				{
					array_push($ordersRet, $this->createOrder($order));
					$currentOrder = $ordersRet[count($ordersRet) - 1];
					$currentOrder->orderDetails = [];
				}

				if(isset($order['orderdetailId']))
				{
					array_push($currentOrder->orderDetails, $this->createOrderDetail($order));
				}
			}

			return $ordersRet;
		}

		public function getOrderStats($initialDate, $endDate)
		{
			$ordersRet = [];

			$orders = $this->orderDAO->getOrderStats($initialDate, $endDate);

			foreach ($orders as $order)
			{
				array_push($ordersRet, $this->createOrderStats($order));
			}

			return $ordersRet;
		}

		public function addOrder($order)
		{
			$this->orderDAO->addOrder($order);
		}

		public function addOrderDetail($orderDetail, $connection = null)
		{
			$this->orderDAO->addOrderDetail($orderDetail, $connection);
		}

		public function updateOrder($order)
		{
			$this->orderDAO->updateOrder($order);
		}

		public function updateOrderDetail($orderDetail)
		{
			$this->orderDAO->updateOrderDetail($orderDetail);
		}

		public function createOrder($order)
		{
			$ord = new Order();

			$ord->id = $order['orderId'];
			$ord->date = $order['orderDate'];
			if(isset($order['customerId']))
			{
				$ord->customer = $this->customerMapper->createCustomer($order);
			}
			$ord->tableNumber = $order['orderTableNumber'];
			$ord->employee = $this->employeeMapper->createEmployee($order);
			$ord->restaurant = $this->restaurantMapper->createRestaurant($order);
			$ord->endDate = $order['orderEndDate'];

			return $ord;
		}

		public function createOrderDetail($orderDetail)
		{
			$ordDet = new OrderDetail();

			$ordDet->orderId = $orderDetail['orderdetailId'];
			$ordDet->order = $this->createOrder($orderDetail);
			$ordDet->product = $this->productMapper->createProduct($orderDetail);
			$ordDet->quantityOrdered = $orderDetail['orderdetailQuantity'];
			$ordDet->priceEach = $orderDetail['orderdetailPrice'];
			$ordDet->chair = $orderDetail['orderdetailChair'];
			
			return $ordDet;
		}

		public function createOrderStats($order)
		{
			$ord = new OrderStats();

			$ord->orderDate = $order['orderDate'];
			$ord->orderQuantity = $order['orderQuantity'];
			$ord->orderPriceTotal = $order['orderPriceTotal'];
			$ord->averageTicket = $order['averageTicket'];
			$ord->averagePriceTotal = $order['averagePriceTotal'];
			$ord->averageAverageTicket = $order['averageAverageTicket'];
			$ord->priceTotalAboveAverage = $order['priceTotalAboveAverage'];
			$ord->averageTicketAboveAverage = $order['averageTicketAboveAverage'];

			return $ord;
		}

	}

