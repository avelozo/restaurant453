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
			return $this->customerMapper->deleteCustomer($id);
		}
	}