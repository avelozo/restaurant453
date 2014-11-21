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


		public function addRestaurant()
		{
			$this->restaurantMapper->addRestaurant(getPostData());
		}
		
		public function updateRestaurant()
		{
			$this->restaurantMapper->updateRestaurant(getPostData());
		}
		
		public function deleteRestaurant()
		{
			$this->restaurantMapper->deleteRestaurant($_POST['id']);
		}
		
		private function getPostData()
		{
			$restaurant = new restaurant();
			
			$restaurant->id = $_POST['id'];
			$restaurant->name = $_POST['name'];
			$restaurant->phone = $_POST['phone'];
			$restaurant->addressLine1 = $_POST['addressLine1'];
			$restaurant->addressLine2 = $_POST['addressLine2'];
			$restaurant->city = $_POST['city'];
			$restaurant->state = $_POST['state'];
			$restaurant->country = $_POST['country'];
			$restaurant->postalCode = $_POST['postalCode'];
			
			return $restaurant;
		}
	}