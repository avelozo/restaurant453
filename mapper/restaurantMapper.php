<?php

	include_once "dataaccess/restaurantDA.php";
	include_once "model/model.restaurant.php";

	class RestaurantMapper
	{
		private $restaurantDAO = null;

		public function getRestaurants()
		{
			if($this->restaurantDAO == null)
				$this->restaurantDAO = new RestaurantDA();

			$restaurantsRet = [];

			$da = $this->restaurantDAO;
			$restaurants = $da->getRestaurants(null);

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