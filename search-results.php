<?php
session_start();
include_once 'bootstrap.php';

$data = array(
	'page'	=>	'search-page',
	'title'	=>	'Search page',
	'description'	=>	'Displays all search results',
	'keywords'		=>	'search results products',
	'baseDir'		=> dirname(__FILE__)
);

$regex = "/^[a-zA-Z\s\d\.]+$/";

if (isset($_GET)) {

	if(preg_match($regex,$_GET['search'])){

		$search = $_GET['search'];
		$connect = new Classes\Connect();
		$productManager = new Classes\ProductManager($connect->getBdd()); 
 		$toLowerSearch = strtolower($search);
		$searchResult = $productManager -> searchProducts($toLowerSearch);
		
	}else{

		$searchResult=[];
	}
}

$obj = array (
	'user'		=> serialize($user),
	'searchResult' => serialize($searchResult)
);

try {
	$page = new Classes\Controller($data);
	echo $page->getPage($obj);
} catch (Exception $e) {
	echo $e->getMessage();
}

