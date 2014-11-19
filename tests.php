<?php
	include_once "mapper/customerMapper.php";
	include_once "model/model.customer.php";
	
	addCustomer();
	getCustomer();


	function addCustomer()
	{
		showInfo("Begin - Add Customer");

		$c = new CustomerMapper();

		$customer = new Customer();
		$customer->name = "Customer 1" . date('Y-m-d H:i:s');
		$customer->phone = "3128889999";
		$customer->addressLine1 = "950 W Webster";
		$customer->addressLine2 = "Table 7";
		$customer->city = "Chicago";
		$customer->state = "IL";
		$customer->country = "United States";
		$customer->postalCode = "60655";

		$c->addCustomer($customer);

		showInfo("End - Add Customer");
	}

	function getCustomer()
	{
		showInfo("Begin - Get Customer");

		$c = new CustomerMapper();

		$cust = $c->getCustomers();

		foreach($cust as $customer)
		{
			echo $customer->id . '<br/>' ;
			echo $customer->name . '<br/>';
			echo $customer->phone. '<br/>' ;
			echo $customer->addressLine1 . '<br/>';
			echo $customer->addressLine2 . '<br/>' ;
			echo $customer->city . '<br/>';
			echo $customer->state . '<br/>' ;
			echo $customer->country . '<br/>';
			echo $customer->postalCode . '<br/>';

			showInfo("");
		}

		showInfo("End - Get Customer");
	}

	function showInfo($info)
	{
		echo str_repeat('-', 20) . "<br/>";
		echo $info . "<br/>";
		echo str_repeat('-', 20) . "<br/>";
	}
	