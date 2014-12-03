<?php

	include_once DIR_BASE . "dataaccess/restaurantDA.php";
	include_once DIR_BASE . "model/model.restaurant.php";

	class RestaurantMapper
	{
		private $restaurantDAO = null;

		function RestaurantMapper()
		{
			$this->restaurantDAO = new RestaurantDA();
		}

		public function getRestaurants($id = null)
		{
			$restaurantsRet = [];

			$restaurants = $this->restaurantDAO->getRestaurants($id);

			foreach ($restaurants as $restaurant)
			{
				array_push($restaurantsRet, $this->createRestaurant($restaurant));
			}

			return $restaurantsRet;
		}

		public function addRestaurant($restaurant)
		{
			return $this->restaurantDAO->addRestaurant($restaurant);
		}

		public function updateRestaurant($restaurant)
		{
			return $this->restaurantDAO->updateRestaurant($restaurant);
		}

		public function deleteRestaurant($id)
		{
			$employees = $this->restaurantDAO->countEmployees($id);
			
			if ($employees > 0)
				return "Not possible to delete. The restaurant is associated to at least 1 employee.";
		
			$orders = $this->restaurantDAO->countOrders($id);
			
			if ($orders > 0)
				return "Not possible to delete. The restaurant is associated to at least 1 order.";
		
			$stocks = $this->restaurantDAO->countStocks($id);
			
			if ($stocks > 0)
				return "Not possible to delete. The restaurant is associated to at least 1 stock.";
		
			return $this->restaurantDAO->deleteRestaurant($id);
		}

		public function createRestaurant($restaurant)
		{
			$rest = new Restaurant();

			$rest->id = $restaurant['restaurantId'];
			$rest->name = $restaurant['restaurantName'];
			$rest->phone = $restaurant['restaurantPhone'];
			$rest->addressLine1 = $restaurant['restaurantAddressLine1'];
			$rest->addressLine2 = $restaurant['restaurantAddressLine2'];
			$rest->city = $restaurant['restaurantCity'];
			$rest->state = $restaurant['restaurantState'];
			$rest->country = $restaurant['restaurantCountry'];
			$rest->postalCode = $restaurant['restaurantPostalCode'];

			return $rest;
		}
	}