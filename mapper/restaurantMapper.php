<?php

	include_once "dataaccess/restaurantDA.php";
	include_once "model/model.restaurant.php";

	class RestaurantMapper
	{
		private $restaurantDAO = null;

		function RestaurantMapper()
		{
			$this->restaurantDAO = new RestaurantDA();
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

		private function createRestaurant($restaurant)
		{
			$rest = new Restaurant();

			$rest->id = $restaurant['restaurantId'];
			$rest->name = $restaurant['name'];
			$rest->phone = $restaurant['phone'];
			$rest->addressLine1 = $restaurant['addressLine1'];
			$rest->addressLine2 = $restaurant['addressLine2'];
			$rest->city = $restaurant['city'];
			$rest->state = $restaurant['state'];
			$rest->country = $restaurant['country'];
			$rest->postalCode = $restaurant['postalCode'];

			return $rest;
		}
	}