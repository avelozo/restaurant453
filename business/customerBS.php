<?php

	include_once DIR_BASE . "mapper/customerMapper.php";
	include_once DIR_BASE . "model/model.customer.php";

	class CustomerBS
	{
		private $customerMapper = null;

		function CustomerBS()
		{
			$this->customerMapper = new customerMapper();
		}

		public function getCustomers($id = null)
		{
			return $this->customerMapper->getCustomers($id);
		}

		public function addCustomer($customer)
		{
			$this->customerMapper->addCustomer($customer);
		}
		
		public function updateCustomer($customer)
		{
			$this->customerMapper->updateCustomer($customer);
		}
		
		public function deleteCustomer($id)
		{
			$this->customerMapper->deleteCustomer($id);
		}
		
		private function getPostData()
		{
			$customer = new customer();
			
			$customer->id = $_POST['id'];
			$customer->name = $_POST['name'];
			$customer->phone = $_POST['phone'];
			$customer->addressLine1 = $_POST['addressLine1'];
			$customer->addressLine2 = $_POST['addressLine2'];
			$customer->city = $_POST['city'];
			$customer->state = $_POST['state'];
			$customer->country = $_POST['country'];
			$customer->postalCode = $_POST['postalCode'];
			
			return $customer;
		}
	}