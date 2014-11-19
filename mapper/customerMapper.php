<?php

	include_once "dataaccess/customerDA.php";
	include_once "model/model.customer.php";

	class CustomerMapper
	{
		private $customerDAO = null;

		function CustomerMapper()
		{
			$this->customerDAO = new CustomerDA();
		}

		public function getCustomers($id = null)
		{
			$customerRet = [];

			$customers = $this->customerDAO->getCustomers($id);

			foreach ($customers as $customer)
			{
				array_push($customerRet, $this->createCustomer($customer));
			}

			return $customerRet;
		}

		public function addCustomer($customer)
		{
			$this->customerDAO->addCustomer($customer);
		}

		public function updateCustomer($customer)
		{
			$this->customerDAO->updateCustomer($customer);
		}

		private function createCustomer($customer)
		{
			$cust = new Customer();

			$cust->id = $customer['customerId'];
			$cust->name = $customer['customerName'];
			$cust->phone = $customer['phone'];
			$cust->addressLine1 = $customer['addressLine1'];
			$cust->addressLine2 = $customer['addressLine2'];
			$cust->city = $customer['city'];
			$cust->state = $customer['state'];
			$cust->country = $customer['country'];
			$cust->postalCode = $customer['postalCode'];

			return $cust;
		}
	}

