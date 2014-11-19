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
			$cust->phone = $customer['customerPhone'];
			$cust->addressLine1 = $customer['customerAddressLine1'];
			$cust->addressLine2 = $customer['customerAddressLine2'];
			$cust->city = $customer['customerCity'];
			$cust->state = $customer['customerState'];
			$cust->country = $customer['customerCountry'];
			$cust->postalCode = $customer['customerPostalCode'];

			return $cust;
		}
	}

