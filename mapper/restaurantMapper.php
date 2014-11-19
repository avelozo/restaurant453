<?php

	include_once "restaurantDA.php";
	include_once "../model/model.restaurant.php";

	public class RestaurantMapper()
	{
		private $restaurantDAO;

		public RestaurantMapper()
		{
			$restaurantDAO = new RestautantDA();
		}

		public getRestaurants()
		{
			$restaurantsRet = array();

			$restaurants = $restaurantDAO->getRestaurants();

			foreach ($restaurants as $restaurant)
			{
				$restaurantRet.push(createRestaurant($restaurant));
			}

			returnt $restaurantRet;
		}

		private createRestaurant($restaurant)
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