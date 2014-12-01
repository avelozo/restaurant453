<?php

	include_once DIR_BASE . "mapper/restaurantMapper.php";
	include_once DIR_BASE . "model/model.restaurant.php";

	class RestaurantBS
	{
		private $restaurantMapper = null;

		function RestaurantBS()
		{
			$this->restaurantMapper = new RestaurantMapper();
		}

		public function getRestaurants($id = null)
		{
			return $this->restaurantMapper->getRestaurants($id);
		}

		public function addRestaurant($restaurant)
		{
			if (!$this->validateName($restaurant->name))
				return 'Invalid name';
			
			return $this->restaurantMapper->addRestaurant($restaurant);
		}
		
		public function updateRestaurant($restaurant)
		{
			if (!$this->validateName($restaurant->name))
				return 'Invalid name';

			return $this->restaurantMapper->updateRestaurant($restaurant);
		}
		
		public function deleteRestaurant($id)
		{
			return $this->restaurantMapper->deleteRestaurant($id);
		}
		
		private function validateName($name)
		{
			return (strlen($name) > 0) && (strlen($name) <= 45);
		}
	}