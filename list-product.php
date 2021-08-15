<?php
include_once 'bootstrap.php';

$data = array(
	'page'	=>	'list-products',
	'title'	=>	'Products',
	'description'	=>	'Here you can see our products',
	'keywords'		=>	'connexion user shop vente ligne commerce',
	'baseDir'		=> dirname(__FILE__)
);


	

 	
	
$connect = new Classes\Connect();
$productManager = new Classes\ProductManager($connect->getBdd());

if($_GET['page']){
 	$products = $productManager->getList($_GET['page']);
	}else{
	$products = $productManager->getList(1);
}


$obj = array(
	'user' => serialize($user),
	'products' => serialize($products)
);

try {
	$page = new Classes\Controller($data);
	echo $page->getPage($obj);
} catch (Exception $e) {
	echo $e->getMessage();
}
