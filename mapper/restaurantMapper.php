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

		public function addRestaurant($restaurant)
		{
			$this->restaurantDAO->addRestaurant($restaurant);
		}

		public function updateRestaurant($restaurant)
		{
			$this->restaurantDAO->updateRestaurant($restaurant);
		}

		public function getRestaurants()
		{
			$restaurantsRet = [];

			$restaurants = $this->restaurantDAO->getRestaurants();

			foreach ($restaurants as $restaurant)
			{
				array_push($restaurantsRet, $this->createRestaurant($restaurant));
			}

			return $restaurantsRet;
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