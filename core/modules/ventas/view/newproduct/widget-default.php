<?php

if(count($_POST)>0){
	echo "ok";
	$product = new ProductData();
	$product->name = $_POST["name"];
	$product->category_id = $_POST["category_id"];
	$product->price_out = $_POST["price_out"];
	$product->unit = $_POST["unit"];
	$product->user_id = Session::getUID();
	$product->add();
	print "<script>window.location='index.php?view=products';</script>";


}


?>