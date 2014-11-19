<?php
	include_once "mapper/customerMapper.php";
	include_once "model/model.customer.php";
	
	include_once "mapper/productMapper.php";
	include_once "model/model.product.php";

	include_once "model/model.restaurant.php";

	//addCustomer();
	//getCustomer();

	//addProduct();
	getProduct();
	//updateProduct();


	function addProduct()
	{
		showInfo("Begin - Add Product");

		$pm = new ProductMapper();

		$product = new Product();
		$product->name = "Bud Light";
		$product->vendor =  "anheuser-busch";
		$product->description = "Bottle of Bud Light";
		$product->buyPrice = 0.5;
		$product->price = 1;
		$product->restaurant = createStubRestaurant();
		$product->quantityInStock = 100;

		$pm->addProduct($product);

		showInfo("End - Add Product");
	}

	function getProduct()
	{
		showInfo("Begin - Get Product");

		$c = new ProductMapper();

		$prod = $c->getProducts();

		foreach($prod as $product)
		{
			echo $product->id . "<br />";
			echo $product->name . "<br />";
			echo $product->vendor . "<br />";
			echo $product->description . "<br />";
			echo $product->buyPrice . "<br />";
			echo $product->price . "<br />";
			echo $product->restaurant->name . "<br />";
			echo $product->quantityInStock . "<br />";

			showInfo("");
		}

		showInfo("End - Get Product");
	}

	function updateProduct()
	{
		showInfo("Begin - Update Product");

		$pm = new ProductMapper();

		$product = new Product();
		$product->id = 2;
		$product->name = "Bud Light Bottle";
		$product->vendor =  "Anheuser Busch";
		$product->description = "New Bottle of Bud Light";
		$product->buyPrice = 0.6;
		$product->price = 2;
		$product->restaurant = createStubRestaurant();
		$product->quantityInStock = 1000;

		$pm->updateProduct($product);

		showInfo("End - Update Product");
	}

	function createStubRestaurant()
	{
		$restaurant = new Restaurant();
		$restaurant->id = 2;
		return $restaurant;
	}

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

		showCustomerInfo($customer);

		showInfo("End - Add Customer");
	}

	function getCustomer()
	{
		showInfo("Begin - Get Customer");

		$c = new CustomerMapper();

		$cust = $c->getCustomers(5);

		foreach($cust as $customer)
		{
			showCustomerInfo($customer);

			$customer->name = "Astolfo";

			$c->updateCustomer($customer);

			showInfo("");
		}

		showInfo("End - Get Customer");
	}

	function showCustomerInfo($customer)
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
	}

	function showInfo($info)
	{
		echo str_repeat('-', 20) . "<br/>";
		echo $info . "<br/>";
		echo str_repeat('-', 20) . "<br/>";
	}
	